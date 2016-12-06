<?php
namespace UserBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\User;

class UserVoter extends Voter
{
    const CREATE = 'create';
    const EDIT   = 'edit';

    /**
     * @var AccessDecisionManagerInterface
     */
    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, array(self::CREATE, self::EDIT))) {
            return false;
        }

        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user_current = $token->getUser();
        /** @var user */
        $user = $subject; // $subject must be a user instance

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::CREATE:
                // if the user is an admin, allow him to create new news
                if ($this->decisionManager->decide($token, array('ROLE_REDACTEUR'))) {
                    return true;
                }

                break;
            case self::EDIT:
                // if the user is the current user, allow him to edit his account or if ROLE_RH
                if ($user_current->getId() === $user->getUser()->getId() OR $this->decisionManager->decide($token, array('ROLE_RH'))) {
                    return true;
                }

                break;
        }

        return false;
    }
}