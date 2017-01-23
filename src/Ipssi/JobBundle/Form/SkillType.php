<?php

namespace Ipssi\JobBundle\Form;

use Doctrine\ORM\EntityManager;
use Ipssi\IpssiBundle\Form\FileType;
use Ipssi\JobBundle\Repository\SkillRepository;
use Ipssi\JobBundle\Transformer\ArrayToSkillTransformer;
use Ipssi\JobBundle\Transformer\SkillTagsTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use UserBundle\Form\ImageType;

class SkillType extends AbstractType
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
            ->add('description', TextAreaType::class, array(
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('type', EntityType::class, array(
                'class' => 'Ipssi\JobBundle\Entity\SkillType',
                'choice_label' => 'name',
                'placeholder' => 'Choisissez un type...',
                'attr' => array(
                    'class' => 'form-control'
                )
            ));




    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipssi\JobBundle\Entity\Skill',
            'allow_extra_fields' => true,
            'manager' => null
        ));
    }




}
