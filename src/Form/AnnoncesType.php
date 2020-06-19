<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class,[
              'attr'=>[
                'placeholder'=>'Votre titre ici'
              ]
            ])
            ->add('prix',NumberType::class,[
              'required'=>false,

              'attr' =>[
                'placeholder'=>'(optionel)'
              ]
            ])
            ->add('description',TextareaType::class,[
              'attr'=>[
                'placeholder'=>'Faites une description très détaillée pour faciliter la visibilité de votre annonce dans la recherche.',
                'rows'=>'5'
              ]
            ])
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
