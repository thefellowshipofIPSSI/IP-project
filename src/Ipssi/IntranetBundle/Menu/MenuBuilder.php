<?php
namespace Ipssi\IntranetBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\DependencyInjection\ContainerInterface;
use JMS\SecurityExtraBundle\Metadata\Driver\AnnotationDriver;

use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class MenuBuilder
{
    /** @var FactoryInterface */
    private $factory;

    /**
     * @param FactoryInterface $factory, ContainerInterface $container
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createUserMenu(TokenStorage $requestStack)
    {

        $user = $requestStack->getToken()->getUser();


        $menu = $this->factory->createItem('user');
        $menu->setChildrenAttribute('class', 'nav navbar-right top-nav');


        $menu->addChild('User', array('label' => 'Bonjour ' . $user->getUsername()))
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'user');
            //$menu['User']->addChild('Profile', array('route' => 'intranet_user_profile', 'routeParameters' => array('user_id' => $user->getId())))
            $menu['User']->addChild('Profile', array('route' => 'user_profile'))
                ->setAttribute('icon', 'user');
            $menu['User']->addChild('Contacts', array('route' => 'user_contacts'))
                ->setAttribute('icon', 'group');
            $menu['User']->addChild('Retour au site', array('route' => 'ipssi_homepage'))
                ->setAttribute('icon', 'arrow-left');
            $menu['User']->addChild('')
                ->setAttribute('class', 'divider');
            $menu['User']->addChild('Déconnexion', array('route' => 'fos_user_security_logout'))
                ->setAttribute('icon', 'power-off');

        return $menu;
    }



    public function createSidebarMenu(AuthorizationChecker $authorizationChecker)
    {
        $menu = $this->factory->createItem('sidebar');

        $menu->setChildrenAttribute('class', 'nav navbar-nav side-nav');

        if ($authorizationChecker->isGranted('ROLE_REDACTEUR')){
            $menu->addChild('News', array('label' => 'Actualités', 'route' => 'intranet_news_homepage'))
                ->setAttribute('icon', 'newspaper-o');
        }

        if ($authorizationChecker->isGranted('ROLE_REDACTEUR')) {
            $menu->addChild('Pages', array('label' => 'Pages', 'route' => 'intranet_page_homepage'))
                ->setAttribute('icon', 'file-text-o');
        }

        if ($authorizationChecker->isGranted('ROLE_CREATE_CRA')
            || $authorizationChecker->isGranted('ROLE_EDIT_CRA')
            || $authorizationChecker->isGranted('ROLE_CREATE_VACATION')
            || $authorizationChecker->isGranted('ROLE_EDIT_VACATION')
            || $authorizationChecker->isGranted('ROLE_CREATE_EXPENSE')
            || $authorizationChecker->isGranted('ROLE_EDIT_CV')
            || $authorizationChecker->isGranted('ROLE_VIEW_JOBOFFER')
            || $authorizationChecker->isGranted('ROLE_EDIT_CANDIDACY')
            || $authorizationChecker->isGranted('ROLE_VIEW_USER')
            || $authorizationChecker->isGranted('ROLE_RH')) {
            $menu->addChild('RH', array('label' => 'Ressources Humaines '))
                ->setAttribute('icon', 'group')
                ->setAttribute('icon2', 'caret-down')
                ->setAttribute('target', 'rh');
            if ($authorizationChecker->isGranted('ROLE_CREATE_CRA')
                || $authorizationChecker->isGranted('ROLE_EDIT_CRA')
                || $authorizationChecker->isGranted('ROLE_RH')
            ) {
                $menu['RH']->addChild('Compte rendu d\'activité', array('route' => 'intranet_cra_homepage'));
            }
            if ($authorizationChecker->isGranted('ROLE_CREATE_EXPENSE')
                || $authorizationChecker->isGranted('ROLE_RH')
            ) {
                $menu['RH']->addChild('Note de frais', array('route' => 'intranet_expense_homepage'));
            }

            if ($authorizationChecker->isGranted('ROLE_CREATE_VACATION')
                || $authorizationChecker->isGranted('ROLE_EDIT_VACATION')
                || $authorizationChecker->isGranted('ROLE_RH')
            ) {
                $menu['RH']->addChild('Demande de congés', array('route' => 'intranet_vacation_homepage'));
            }

            if ($authorizationChecker->isGranted('ROLE_EDIT_CV')
                || $authorizationChecker->isGranted('ROLE_RH')
            ) {
                $menu['RH']->addChild('CVthèque', array('route' => 'cv_index'));
            }

            if ($authorizationChecker->isGranted('ROLE_VIEW_JOBOFFER')
                || $authorizationChecker->isGranted('ROLE_RH')
            ) {
                $menu['RH']->addChild('Offres de poste', array('route' => 'intranet_offers'));
            }

            if ($authorizationChecker->isGranted('ROLE_EDIT_CANDIDACY')
                || $authorizationChecker->isGranted('ROLE_RH')
            ) {
                $menu['RH']->addChild('Entreprises partenaires', array('route' => 'intranet_societies'));
                $menu['RH']->addChild('Candidatures', array('route' => 'intranet_candidacies'));
            }

            if ($authorizationChecker->isGranted('ROLE_RH')
                || $authorizationChecker->isGranted('ROLE_VIEW_USER')
            ) {
                $menu['RH']->addChild('Collaborateurs', array('route' => 'intranet_user_homepage'));
            }
        }

        $menu->addChild('ToolBox', array('label' => 'Boite à outils '))
            ->setAttribute('icon', 'wrench')
            ->setAttribute('icon2', 'caret-down')
            ->setAttribute('target', 'toolbox');
        $menu['ToolBox']->addChild('Google Drive', array('uri' => 'https://drive.google.com/drive/my-drive'));
        $menu['ToolBox']->addChild('Google Calendar', array('uri' => 'https://calendar.google.com/calendar/'));

        if ($authorizationChecker->isGranted('ROLE_SUPERVISEUR')){

            $menu->addChild('Admin', array('label' => 'Administration '))
                ->setAttribute('icon', 'cog')
                ->setAttribute('icon2', 'caret-down')
                ->setAttribute('target', 'admin');
            $menu['Admin']->addChild('Gestion des utilisateurs', array('route' => 'intranet_user_homepage'));
            $menu['Admin']->addChild('Application', array('route' => 'intranet_homepage'));
        }
        return $menu;
    }
}
