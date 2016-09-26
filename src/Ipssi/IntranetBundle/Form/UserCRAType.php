<?php

namespace Ipssi\IntranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class UserCRAType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('description', TextAreaType::class, ['attr' => ['class' => 'form-control']])
            ->add('beginDate', DateTimeType::class, ['attr' => ['class' => 'form-control']])
            ->add('endDate', DateTimeType::class, ['attr' => ['class' => 'form-control']])
            ->add('nbLostTimeAccident', IntegerType::class, ['attr' => ['class' => 'form-control']])
            ->add('nbNoneLostTimeAccident', IntegerType::class, ['attr' => ['class' => 'form-control']])
            ->add('nbTravelAccident', IntegerType::class, ['attr' => ['class' => 'form-control']])
            ->add('nbSickDay', IntegerType::class, ['attr' => ['class' => 'form-control']])
            ->add('nbVacancyDay', IntegerType::class, ['attr' => ['class' => 'form-control']])
            ->add('clientSatisfaction', TextareaType::class, ['attr' => ['class' => 'form-control']])
            ->add('consultantSatisfaction', TextareaType::class, ['attr' => ['class' => 'form-control']])
            ->add('ameliorationPoint', TextareaType::class, ['attr' => ['class' => 'form-control']])
            ->add('leftActivity', TextareaType::class, ['attr' => ['class' => 'form-control']])
            ->add('comments', TextareaType::class, ['attr' => ['class' => 'form-control']])
            ->add('client', TextareaType::class, ['attr' => ['class' => 'form-control']])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipssi\IntranetBundle\Entity\UserCRA'
        ));
    }
}
