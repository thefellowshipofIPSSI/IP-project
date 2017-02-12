<?php

namespace Ipssi\JobBundle\Form;

use Ipssi\JobBundle\Transformer\SkillTagsTransformer;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Form\ProfileType;


class CandidacyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('content', CKEditorType::class, array(
                'config_name' => 'default'
            ))
            ->add('cv', CVType::class, array(
                'attr' => array(
                    'required' => true
                )
            ));

        // User informations
        $builder
            ->add('profile', ProfileType::class, array(
                'candidacy' => true,
                'mapped' => false
            ))

        ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipssi\JobBundle\Entity\Candidacy',
            'allow_extra_fields' => true,
            'manager' => null
        ));
    }



}
