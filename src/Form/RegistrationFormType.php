<?php

namespace App\Form;

use App\Entity\Personnels;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                "attr" =>[
                    "class" => 'form-control',
                    'placeholder' => 'Entrez votre nom'
                ],
                'label' => 'Votre Nom',
                'label_attr'=>[
                    "class" => 'form-label']   
            ])
            ->add('prenom', TextType::class, [
                "attr" =>[
                    "class" => 'form-control',
                    'placeholder' => 'Entrez votre Prenom'
                ],
                'label' => 'Votre Prenom',
                'label_attr'=>[
                    "class" => 'form-label']   
            ])
            ->add('sexe', ChoiceType::class, [
                'choices' =>[
                    'Masculin'=> 0,
                    'Feminin'=> 1
                ],
                'expanded' => true,
                'multiple' => false   
            ])
            ->add('email', EmailType::class, [
                "attr" =>[
                    "class" => 'form-control',
                    "placeholder" => 'Entrez votre adresse e-mail'
                ],
                'label' => 'Votre e-mail',
                'label_attr'=>[
                    "class" => 'form-label']
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),    
                ],
                'attr' =>[
                    "class" => 'form-check-input me-2'
                ],
                'label' => 'Acceptez les conditions',
                'label_attr' =>[
                    "class" => 'form-check-label']
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],"attr" =>[
                    "class" => 'form-control',
                    "placeholder" => 'Entrez votre mot de passe'
                ],
                'label' => 'Votre mot de passe',
                'label_attr'=>[
                    "class" => 'form-label']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personnels::class,
        ]);
    }
}
