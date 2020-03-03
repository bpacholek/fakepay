<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Repository\PaymentRepository;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleController extends AbstractController
{
    /**
     * @Route("/handle/{id}", name="handle_payment", methods={"GET"})
     */
    public function handleAction(Request $request, PaymentRepository $paymentRepository, int $id)
    {
        $payment = $paymentRepository->findOneBy(['id' => $id]);
        if ($payment === null) {
            return $this->render("notfound.html.twig", [ 'id' => $id]);
        }

        return $this->render("found.html.twig", [ 'payment' => $payment]);
    }

    /**
     * @Route("/send/{id}/{type}", name="send_notification", methods={"GET"})
     */
    public function sendNotification(Request $request, PaymentRepository $paymentRepository, string $type, int $id)
    {
        $payment = $paymentRepository->findOneBy(['id' => $id]);
        if ($payment === null) {
            return $this->render("notfound.html.twig", [ 'id' => $id]);
        }

        $client = HttpClient::create(['http_version' => '1.1']);

        $formFields = [
            'status' => $type,
            'amount' => $payment->getAmount(),
            'currency' => $payment->getCurrency(),
            'payment_id' => $payment->getPaymentId(),
            'fakepay_id' => $payment->getId(),
            'client_email' => $payment->getClientEmail(),
        ];

        $response = null;
        try {
            /** @var Response */
            $response = $client->request('POST', $payment->getNotifyUrl(), [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'body' => $formFields
            ]);
        } catch (Exception $e) {
            $this->addFlash(
                'danger',
                $e->getMessage()
            );

            return $this->redirectToRoute('handle_payment', ['id' => $payment->getId()]);
        }

        $contents = $response->getContent(false);
        $this->addFlash(
            'info',
            'Sent, response below.',
        );

        if (empty($contents)) {
            $contents = "(empty contents returned)";
        }

        $this->addFlash(
            'response',
            $contents
        );

        return $this->redirectToRoute('handle_payment', ['id' => $payment->getId()]);
    }
}
