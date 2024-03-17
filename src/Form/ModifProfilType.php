<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('prenom', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('adresse', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('pays', CountryType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('ville', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('codePostal', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('confirmer', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
