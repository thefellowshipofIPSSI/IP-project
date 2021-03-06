<?php
namespace UserBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\Profile;


class FOSUBUserProvider extends BaseClass
{
    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();
        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();
        $setter = 'set'.ucfirst($service);
        $setter_id = $setter.'Id';
        $setter_token = $setter.'AccessToken';

        //@TODO Afficher un message si un autre user est déjà lié avec ce compte plutot que de le supprimer
        //Si il existe déjà un user avec ce google_id
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {

            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }
        //we connect current user
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());
        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();
        $firstname = $response->getFirstName();
        $lastname = $response->getLastName();
        $realName = $response->getRealName();
        $email = $response->getEmail();

        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));

        //when the user is registrating
        if (null === $user) {
            $service = $response->getResourceOwner()->getName();
            $rand = rand(0, 9);

            $setter = 'set'.ucfirst($service);
            $setter_id = $setter.'Id';
            $setter_token = $setter.'AccessToken';
            // create new user here
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            //I have set all requested data with the user's username
            //modify here with relevant data
            $user->setUsername($firstname.$lastname.$rand);
            $user->setUsernameCanonical($realName);
            $user->setEmail($email);
            //@TODO encode password
            $user->setPassword($username);
            $user->setEnabled(true);

            $profile = new Profile();
            $profile->setGravatar(1);
            $profile->setFirstname($firstname);
            $profile->setLastname($lastname);
            $profile->setPseudo($firstname.$lastname.$rand);
            $profile->setOther('Comtpte créé avec Google');
            $user->setProfile($profile);

            $profile->setUser($user);

            $this->userManager->updateUser($user);

            return $user;
        }

        //if user exists - go with the HWIOAuth way
        $user = parent::loadUserByOAuthUserResponse($response);
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';
        //update access token
        $user->$setter($response->getAccessToken());
        return $user;
    }
}