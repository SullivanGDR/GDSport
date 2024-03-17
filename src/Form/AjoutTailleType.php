<?php

namespace App\Form;

use App\Entity\ArticleTaille;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Entity\Taille;
use App\Entity\Article;

class AjoutTailleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taille', ChoiceType::class, [
                'choices' => [
                    'Vêtements' => [
                        'XXS' => 'XXS',
                        'XS' => 'XS',
                        'S' => 'S',
                        'M' => 'M',
                        'L' => 'L',
                        'XL' => 'XL',
                        'XXL' => 'XXL',
                        'XXXL' => 'XXXL',
                    ],
                    'Chaussures' => [
                        'EU 18' => 'EU 18',
                        'EU 19' => 'EU 19',
                        'EU 20' => 'EU 20',
                        'EU 21' => 'EU 21',
                        'EU 22' => 'EU 22',
                        'EU 23' => 'EU 23',
                        'EU 24' => 'EU 24',
                        'EU 25' => 'EU 25',
                        'EU 26' => 'EU 26',
                        'EU 27' => 'EU 27',
                        'EU 28' => 'EU 28',
                        'EU 29' => 'EU 29',
                        'EU 30' => 'EU 30',
                        'EU 31' => 'EU 31',
                        'EU 32' => 'EU 32',
                        'EU 33' => 'EU 33',
                        'EU 34' => 'EU 34',
                        'EU 35' => 'EU 35',
                        'EU 36' => 'EU 36',
                        'EU 37' => 'EU 37',
                        'EU 38' => 'EU 38',
                        'EU 39' => 'EU 39',
                        'EU 40' => 'EU 40',
                        'EU 41' => 'EU 41',
                        'EU 42' => 'EU 42',
                        'EU 43' => 'EU 43',
                        'EU 44' => 'EU 44',
                        'EU 45' => 'EU 45',
                        'EU 46' => 'EU 46',
                        'EU 47' => 'EU 47',
                        'EU 48' => 'EU 48',

                    ]
                ], 'attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold']
            ])
            ->add('quantite', IntegerType::class, ['attr' => ['class'=> 'form-control border border-dark bg-white'], 'label_attr' => ['class'=> 'fw-bold']])
            ->add('suivant', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ], 'row_attr' => ['class' => 'text-center'],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleTaille::class,
        ]);
    }
}
