<?php

namespace App\Form;

use App\Entity\InfoCommande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InfoCommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'], 'required' => true])
            ->add('prenom', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'], 'required' => true])
            ->add('email', EmailType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'], 'required' => true])
            ->add('adresse', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'd-none'], 'required' => true])
            ->add('ville', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'd-none'], 'required' => true])
            ->add('pays', CountryType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'd-none'], 'required' => true])
            ->add('codePostal', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'd-none'], 'required' => true])
            ->add('livraison', ChoiceType::class, [
                'choices' => [
                    'Livraison Express' => 'express',
                    'Livraison Standard' => 'standard'
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Choisissez votre mode de livraison',
                'required' => true,
                'attr' => [
                    'class' => 'form-control border border-dark bg-white'
                ],
                'label_attr' => [
                    'class' => 'fw-bold'
                ]
            ])
            ->add('suivant', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InfoCommande::class,
        ]);
    }
}
