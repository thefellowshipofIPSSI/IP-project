<?php
namespace Ipssi\IntranetBundle\Security;

use Ipssi\IntranetBundle\Entity\News;
use UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class NewsVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        // only vote on News objects inside this voter
        if (!$subject instanceof News) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // ROLE_SUPER_ADMIN can do anything! The power!
        if ($this->decisionManager->decide($token, array('ROLE_SUPER_ADMIN'))) {
            return true;
        }

        // you know $subject is a News object, thanks to supports
        /** @var News $news */
        $news = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($news, $user);
            case self::EDIT:
                return $this->canEdit($news, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(News $news, User $user)
    {
        // if they can edit, they can view
        if ($this->canEdit($news, $user)) {
            return true;
        }

        // the News object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        return !$news->isPrivate();
    }

    private function canEdit(News $news, User $user)
    {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return $user === $news->getOwner();
    }
}