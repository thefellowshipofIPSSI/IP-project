<?php


namespace Ipssi\JobBundle\Transformer;



use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;

use Ipssi\JobBundle\Entity\Skill;

class ArrayToSkillTransformer implements DataTransformerInterface
{

    public function transform($skillCollection)
    {
        $skills = array();

        foreach ($skillCollection as $skill)
        {
            $skills[] = $skill->getName();
        }

        return implode(',', $skills);
    }

    public function reverseTransform($skills)
    {
        $skillCollection = new ArrayCollection();

        foreach (explode(',', $skills) as $skill)
        {
            $skillObject = new Skill();
            $skillObject->setName($skill);
            $skillCollection->add($skillObject);
        }

        return $skillCollection;
    }

}