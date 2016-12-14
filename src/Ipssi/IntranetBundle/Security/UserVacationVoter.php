<?php
namespace Ipssi\IntranetBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Ipssi\IntranetBundle\Entity\UserVacation;

class UserVacationVoter extends Voter
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

        if (!$subject instanceof UserVacation) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        /** @var userVacation */
        $userVacation = $subject;

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::CREATE:
                if ($this->decisionManager->decide($token, array('ROLE_RH', 'ROLE_CREATE_VACATION', 'ROLE_EDIT_VACATION'))) {
                    return true;
                }

                break;
            case self::EDIT:
                if ($user->getId() === $userVacation->getUser()->getId() || $this->decisionManager->decide($token, array('ROLE_RH', 'ROLE_EDIT_VACATION'))) {
                    return true;
                }

                break;
        }

        return false;
    }
}