<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,[
              'label' => false,
              'attr' => [
                'class'=>'form-control',
                'placeholder' =>'Adresse email'
              ]
            ])
            ->add('NumeroDeTel',TextType::class,[
              'label' => false,
              'attr' => [
                'class'=>'form-control',
                'placeholder' =>'Numéro de téléphone'
              ]
            ])
            ->add('NomComplet',TextType::class,[
              'label' => false,
              'attr' => [
                'class'=>'form-control',
                'placeholder' =>'Votre nom complet'
              ]
            ])
            ->add('Password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller

                'mapped' => false,
                  'label' => false,
                'attr' => [
                  'placeholder' => 'Votre mot de passe'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre mot de passe svp!',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe ne doit pas dépasser au moins  {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('add', SubmitType::class, [
               'label' => 'Valider',
               'attr' => [
                   'class' => 'btn waves-effect btn-primary waves-light'
               ]
           ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
