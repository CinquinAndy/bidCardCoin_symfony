<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id')
            ->add('pays')
            ->add('ville')
            ->add('codePostal')
            ->add('rue')
//            ->add('user')
//            ->add('stock')
//            ->add('vente')
        ;
    }
//->add('pays')
//->add('ville')
//->add('codePostal')
//->add('rue')
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
