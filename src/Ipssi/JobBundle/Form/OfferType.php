<?php

namespace Ipssi\JobBundle\Form;

use Doctrine\ORM\EntityManager;
use Ipssi\IpssiBundle\Form\FileType;
use Ipssi\JobBundle\Repository\SkillRepository;
use Ipssi\JobBundle\Transformer\ArrayToSkillTransformer;
use Ipssi\JobBundle\Transformer\SkillTagsTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use UserBundle\Form\ImageType;

class OfferType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('contract', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('description', TextAreaType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('duration', TextType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('location', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('salary', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))

            ->add('currency', TextType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))

            ->add('beginDate', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))

            ->add('link', TextType::class, array(
                'required' => false,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))

            ->add('society', EntityType::class, array(

                'class' => 'JobBundle:Society',
                'choice_label' => 'name',

                'attr' => array(
                    'class' => 'form-control'
                )
            ))

            ->add('skills', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->get('skills')->addModelTransformer(new ArrayToSkillTransformer($options['manager']))


        ;





    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipssi\JobBundle\Entity\Offer',
            'allow_extra_fields' => true,
            'manager' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        //return 'ipssi_jobbundle_society';
    }


}
