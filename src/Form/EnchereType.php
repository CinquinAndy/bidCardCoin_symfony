<?php

namespace App\Form;

use App\Entity\Enchere;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnchereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prixProposer')
            ->add('estAdjuger')
            ->add('dateHeureVente', DateTimeType::class, [
                'date_widget'=>'choice',
                'with_seconds'=>true,
//                'disabled'=>true
//                'years'=>[
//                    $arrayDateTime['year']
//                ],
//                'months'=>[
//                    $arrayDateTime['month']
//                ],
//                'days'=>[
//                    $arrayDateTime['day']
//                ],
//                'hours'=>[
//                    $arrayDateTime['hour']
//                ],
//                'minutes'=>[
//                    $arrayDateTime['minute']
//                ],
//                'seconds'=>[
//                    $arrayDateTime['second']
//                ]
            ])
            ->add('lot')
            ->add('vente')
//            ->add('user')
            ->add('user')
//            ->add('dateHeureVente', ChoiceType::class, [
//                'choices' => [
//                    'now' => new \DateTime('now')
//                ],
//            ]);
//            ->add('ordre_achat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enchere::class,
        ]);
    }
}
