<?php
namespace Ipssi\IntranetBundle\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Ipssi\IntranetBundle\Entity\Page;

class PageVoter extends Voter
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

        if (!$subject instanceof Page) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        /** @var page */
        $page = $subject; // $subject must be a page instance, thanks to the supports method

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::CREATE:
                // if the user is a redacteur, allow him to create new page
                if ($this->decisionManager->decide($token, array('ROLE_REDACTEUR'))) {
                    return true;
                }

                break;
            case self::EDIT:
                // if the user is the page's author, allow him to edit the page
                if ($user->getId() === $page->getUser()->getId()) {
                    return true;
                }

                break;
        }

        return false;
    }
}