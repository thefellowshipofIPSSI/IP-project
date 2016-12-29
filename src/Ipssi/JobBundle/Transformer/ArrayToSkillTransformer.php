<?php


namespace Ipssi\JobBundle\Transformer;



use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;

use Ipssi\JobBundle\Entity\Skill;

class ArrayToSkillTransformer implements DataTransformerInterface
{

    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

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
            if($this->manager->getRepository('JobBundle:Skill')->findOneBy(['name' => $skill])) {
                $skillObject = $this->manager->getRepository('JobBundle:Skill')->findOneBy(['name' => $skill]);
            } else {
                $skillObject = new Skill();
                $skillObject->setName($skill);
            }


            $skillCollection->add($skillObject);
        }

        return $skillCollection;
    }

}