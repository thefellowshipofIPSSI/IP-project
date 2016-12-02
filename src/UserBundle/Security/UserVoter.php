<?php

namespace UserBundle\Security;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserVoter extends Voter
{
    protected function supports($attribute, $object)
    {
        if ($attribute != 'USER_VIEW') {
            return false;
        }
        if (!$object instanceof User) {
            return false;
        }
        return true;
    }
    protected function voteOnAttribute($attribute, $object, TokenInterface $token)
    {

    }

}