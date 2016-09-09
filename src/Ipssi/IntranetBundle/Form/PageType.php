<?php

namespace Ipssi\IntranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('title', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('content', TextAreaType::class, ['attr' => ['class' => 'form-control']])
            ->add('slug', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('metaDescription', TextAreaType::class, ['attr' => ['class' => 'form-control']])
            ->add('metaKeywords', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('pageCategory', EntityType::class, [
                'class' => 'IntranetBundle:PageCategory',
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control']])
            ->add('pageTemplate', EntityType::class, [
                'class' => 'IntranetBundle:PageTemplate',
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control']]);
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipssi\IntranetBundle\Entity\Page'
        ));
    }
}
