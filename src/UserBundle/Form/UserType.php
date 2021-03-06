<?php

namespace UserBundle\Form;

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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Login'
            ])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mot de passe', 'attr' => ['class' => 'form-control']),
                'second_options' => array('label' => 'Confirmez le mot de passe', 'attr' => ['class' => 'form-control']),
                'options' => array('attr' => array('class' => 'password-field form-group form-control')),
                'required' => false,
                'mapped' => false
            ))
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('groups', EntityType::class, [
                'class' => 'UserBundle:Group',
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'multiple' => "true"])
            ->add('profile', ProfileType::class)
            ->add('enabled', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Activer le compte ?',
                'choices' => [
                    'Actif' => 1,
                    'Inactif' => 0
                ],
            ])
            ->add('save', SubmitType::class);
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
