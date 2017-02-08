<?php

namespace Ipssi\JobBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CVType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cvFile', VichFileType::class, [
                'label' => false,
                'required' => true,
                'allow_delete' => false,
                'download_link' => true,
                'attr' => [
                    'accept'=>'application/pdf',
                    'data-buttonText'=>"Selectionner votre fichier"]
            ])
        ->add('save', SubmitType::class);

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ipssi\JobBundle\Entity\CV'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ipssi_jobbundle_cv';
    }


}
