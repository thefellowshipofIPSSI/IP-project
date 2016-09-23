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


class JobOfferType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('job', EntityType::class, [
                'class' => 'IntranetBundle:Job',
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control']])
            ->add('duration', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('location', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('salary', TextAreaType::class, ['attr' => ['class' => 'form-control']])
            ->add('description', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('skill', EntityType::class, [
                'class' => 'IntranetBundle:Skill',
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control']])
            ->add('society', EntityType::class, [
                'class' => 'IntranetBundle:Society',
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
            'data_class' => 'Ipssi\IntranetBundle\Entity\JobOffer'
        ));
    }
}
