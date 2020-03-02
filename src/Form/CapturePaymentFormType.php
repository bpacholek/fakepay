<?php

namespace App\Form;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CapturePaymentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('merchantId')
            ->add('merchantKey')
            ->add('amount')
            ->add('currency')
            ->add('createdAt')
            ->add('notifyUrl')
            ->add('returnUrl')
            ->add('cancelUrl')
            ->add('description')
            ->add('clientEmail')
            ->add('paymentId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }
}
