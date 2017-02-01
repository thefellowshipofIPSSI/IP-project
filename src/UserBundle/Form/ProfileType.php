<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if(!$options['candidacy']) {
            $builder->add('pseudo', TextType::class, array(
                'required' => false
            ));
        }

        $builder
            ->add('firstname', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom'
            ])
            ->add('address', TextType::class, [
                'attr' => ['class' => 'form-control', 'required' => false],
                'label' => 'Adresse du collaborateur (facultatif)',
                'required' => false
            ])
            ->add('zipcode', TextType::class, [
                'attr' => ['class' => 'form-control', 'required' => false],
                'label' => 'Code postal (facultatif)',
                'required' => false
            ])
            ->add('city', TextType::class, [
                'attr' => ['class' => 'form-control', 'required' => false],
                'label' => 'Ville (facultatif)',
                'required' => false
            ])
            ->add('country', TextType::class, [
                'attr' => ['class' => 'form-control', 'required' => false],
                'label' => 'Pays (facultatif)',
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

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Profile',
            'candidacy' => false
        ));
    }
}