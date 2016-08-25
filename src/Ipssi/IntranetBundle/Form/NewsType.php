<?php

namespace Ipssi\IntranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class NewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['class' => 'form-group']])
            ->add('title', TextType::class, ['attr' => ['class' => 'form-group']])
            ->add('resume', TextAreaType::class, ['attr' => ['class' => 'form-group']])
            ->add('content', TextAreaType::class, ['attr' => ['class' => 'form-group']])
            ->add('slug', TextType::class, ['attr' => ['class' => 'form-group']])
            ->add('metaDescription', TextAreaType::class, ['attr' => ['class' => 'form-group']])
            ->add('metaTitle', TextType::class, ['attr' => ['class' => 'form-group']])
            

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipssi\IntranetBundle\Entity\News'
        ));
    }
}
