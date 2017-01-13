<?php

namespace UserBundle\Form;

use UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

use IpssiBundle\Entity\File;


class SwitchAvatarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if($options['data']->getAvatar() === null) {
            $choices = [
                '0' => true,
            ];
        } else {
            $choices = [
                '0' => true,
                '1' => false
            ];
        }


        $builder
            ->add('gravatar', ChoiceType::class, [
                'choices' => $choices,
                'expanded' => true,
                'multiple' => false,
                'data' => $options['data']->getGravatar()
            ])
            ->add('submit', SubmitType::class)
            ->getForm();
    }
}