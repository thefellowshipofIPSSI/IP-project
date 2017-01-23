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
use UserBundle\Form\ProfileType;

class CVType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('file', FileType::class, array(
                'attr' => array(
                    'required' => true
                )
            ));


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipssi\JobBundle\Entity\CV',
        ));
    }



}
