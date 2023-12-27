<?php

namespace App\Form;

use App\Entity\Payement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PayementFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'], 'required' => true])
            ->add('prenom', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'], 'required' => true])
            ->add('cardNumber', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'd-none'], 'required' => true])
            ->add('date', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'd-none'], 'required' => true])
            ->add('cvv', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'd-none'], 'required' => true])
            ->add('acheter', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payement::class,
        ]);
    }
}
