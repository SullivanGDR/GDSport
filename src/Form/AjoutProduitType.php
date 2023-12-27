<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Article;
use App\Entity\Genre;
use App\Entity\Tendance;
use App\Entity\Type;

class AjoutProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prix', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('designation', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('marque', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('description', TextareaType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('genre', TextType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold'],])
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'libelle',
                'attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold']
            ])
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'libelle',
                'attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold']
            ])
            ->add('tendance', EntityType::class, [
                'class' => Tendance::class,
                'choice_label' => 'yesorno',
                'attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold']
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'libelle',
                'attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold']
            ])
            ->add('images', FileType::class, [
                'label' => 'Image(s) à télécharger (minimum : 1)',
                'multiple' => true,
                'mapped' => false,
                'required' => false, 
                'attr' => ['class'=> 'form-control border border-dark bg-white', 'placeholder' => 'Choose file'], 'label_attr' => ['class'=> 'fw-bold']])
            ->add('suivant', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
