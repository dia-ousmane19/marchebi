<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('prix',NumberType::class,[
              'required'=>false,

              'attr' =>[
                'placeholder'=>'Si vous ne mettez pas de prix, nous allons afficher "sur commande" (optionel)'
              ]
            ])
            ->add('description')
            ->add('prix_negociable')
            ->add('possibilite_echange')
            //->add('users')
            ->add('categorie')
            ->add('images',FileType::class,[
                'label'=> false,
                'mapped'=>false,
                'multiple'=> true,
                'required' =>true,

              ])
            ->add('etat')
            ->add('region')
            ->add('quartier')
            ->add('zone')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
