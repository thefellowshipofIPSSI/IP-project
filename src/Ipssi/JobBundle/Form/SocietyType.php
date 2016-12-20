<?php

namespace Ipssi\JobBundle\Form;

use Ipssi\IpssiBundle\Form\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use UserBundle\Form\ImageType;

class SocietyType extends AbstractType
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
            ->add('address', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('zipcode', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('city', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('country', TextType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('presentation', TextAreaType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))

            ->add('logo', FileType::class, array(
                'attr' => array(
                    'id' => 'input-file'
                )
            ));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipssi\JobBundle\Entity\Society'
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
