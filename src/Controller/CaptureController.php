<?php

namespace App\Controller;

use App\Entity\Payment;
use App\Form\CapturePaymentFormType;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\VarDumper\Cloner\Data;

class CaptureController extends AbstractController
{
    /**
     * @Route("/capture", name="capture_payment", methods={"POST"})
     */
    public function captureAction(Request $request)
    {
        $payment = new Payment();

        $form = $this->createForm(CapturePaymentFormType::class, $payment, ['csrf_protection' => false]);

        $form->submit($request->request->all(), false);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Payment */
            $payment = $form->getData();
            $payment->setCreatedAt(new DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($payment);
            $entityManager->flush();

            //success!
            return $this->redirectToRoute('handle_payment', ['id' => $payment->getId()]);
        }

        //failure!
        $errors = $this->getErrorsFromForm($form);
        return new JsonResponse(['success' => 'failure', 'errors' => $errors], Response::HTTP_BAD_REQUEST);
    }

    private function getErrorsFromForm(FormInterface $form)
    {
        $errors = array();

        foreach ($form->getErrors() as $error) {
            $errors['error'] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }

        return $errors;
    }
}
