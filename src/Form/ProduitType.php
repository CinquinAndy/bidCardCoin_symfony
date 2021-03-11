<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomArtiste')
            ->add('nomStyle')
            ->add('nomProduit')
            ->add('prixReserve')
            ->add('referenceCatalogue')
            ->add('description')
            ->add('estEnvoyer')
            ->add('lotProduit')
            ->add('UserProduit')
            ->add('enchereGagnante')
            ->add('categorieProduit')
            ->add('stockProduit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
