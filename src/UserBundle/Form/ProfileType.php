<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, array(
                'required' => false
            ))
            ->add('genre', TextType::class, array(
                'required' => false
            ))
            ->add('age', TextType::class, array(
                'required' => false
            ))
            ->add('past', TextareaType::class, array(
                'required' => false
            ))
            ->add('present', TextareaType::class, array(
                'required' => false
            ))
            ->add('future', TextareaType::class, array(
                'required' => false
            ))
            ->add('whyRegister', TextareaType::class, array(
                'required' => false
            ))
            ->add('skills', TextareaType::class, array(
                'required' => false
            ))
            ->add('interests', TextareaType::class, array(
                'required' => false
            ))
            ->add('other', TextareaType::class, array(
                'required' => false
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Profile',
        ));
    }
}