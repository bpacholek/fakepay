<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="integer")
     */
    private $merchantId;

    /**
     * @ORM\Column(type="string", length=48)
     * @Assert\NotBlank
     */
    private $merchantKey;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     */
    private $amount;

    /**
     * @ORM\Column(type="string", length=4)
     * @Assert\NotBlank
     */
    private $currency;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Url
     */
    private $notifyUrl;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     * @Assert\Url
     */
    private $returnUrl;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     * @Assert\Url
     */
    private $cancelUrl;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=128)
     * @Assert\Email
     */
    private $clientEmail;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank
     */
    private $paymentId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMerchantId(): ?int
    {
        return $this->merchantId;
    }

    public function setMerchantId(int $merchantId): self
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    public function getMerchantKey(): ?string
    {
        return $this->merchantKey;
    }

    public function setMerchantKey(string $merchantKey): self
    {
        $this->merchantKey = $merchantKey;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNotifyUrl(): ?string
    {
        return $this->notifyUrl;
    }

    public function setNotifyUrl(string $notifyUrl): self
    {
        $this->notifyUrl = $notifyUrl;

        return $this;
    }

    public function getReturnUrl(): ?string
    {
        return $this->returnUrl;
    }

    public function setReturnUrl(string $returnUrl): self
    {
        $this->returnUrl = $returnUrl;

        return $this;
    }

    public function getCancelUrl(): ?string
    {
        return $this->cancelUrl;
    }

    public function setCancelUrl(string $cancelUrl): self
    {
        $this->cancelUrl = $cancelUrl;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(string $clientEmail): self
    {
        $this->clientEmail = $clientEmail;

        return $this;
    }

    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }

    public function setPaymentId(string $paymentId): self
    {
        $this->paymentId = $paymentId;

        return $this;
    }
}
