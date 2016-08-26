<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom'
            ])
            ->add('username', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Login'
            ])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mot de passe', 'attr' => ['class' => 'form-control']),
                'second_options' => array('label' => 'Confirmez le mot de passe', 'attr' => ['class' => 'form-control']),
                'attr' => array('class' => 'password-field')
            ))
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('address', TextType::class, [
                'attr' => ['class' => 'form-control', 'required' => false],
                'label' => 'Adresse du collaborateur (facultatif)',
                'required' => false
            ])
            ->add('phone', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Téléphone (facultatif)',
                'required' => false
            ])
            ->add('birthDate', DateType::class, [
                'attr' => ['class' => 'form-control js-datepicker'],
                'label' => 'Date de naissance (facultatif)',
                'widget' => 'single_text',
                'html5' => false,
                'required' => false

            ])
            ->add('enabled', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Activer le compte ?',
                'choices' => [
                    'Actif' => 1,
                    'Inactif' => 0
                ],
                'data' => 0
            ]);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }
}
