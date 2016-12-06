<?php
namespace Ipssi\IntranetBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\DependencyInjection\ContainerInterface;
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
            $menu['User']->addChild('Messages', array('uri' => '#'))
                ->setAttribute('icon', 'envelope');
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

        $menu->addChild('RH', array('label' => 'Ressources Humaines '))
            ->setAttribute('icon', 'group')
            ->setAttribute('icon2', 'caret-down')
            ->setAttribute('target', 'rh');
            if ($authorizationChecker->isGranted('ROLE_CREATE_CRA')
                or $authorizationChecker->isGranted('ROLE_EDIT_CRA')
                or $authorizationChecker->isGranted('ROLE_RH')) {
                $menu['RH']->addChild('Compte rendu d\'activité', array('route' => 'intranet_cra_homepage'));
            }
            $menu['RH']->addChild('Note de frais', array('route' => 'intranet_expense_homepage'));
            $menu['RH']->addChild('Demande de congés', array('route' => 'intranet_vacation_homepage'));
//            $menu['RH']->addChild('CVthèque', array('route' => 'intranet_cv_homepage'));
            $menu['RH']->addChild('Offres de poste', array('route' => 'intranet_job_offer_homepage'));
//            $menu['RH']->addChild('Candidatures', array('route' => 'intranet_candidacy_homepage'));
            if ($authorizationChecker->isGranted('ROLE_RH') or $authorizationChecker->isGranted('ROLE_VIEW_USER')) {
                $menu['RH']->addChild('Collaborateurs', array('route' => 'intranet_user_homepage'));
            }
        $menu->addChild('ToolBox', array('label' => 'Boite à outils '))
            ->setAttribute('icon', 'wrench')
            ->setAttribute('icon2', 'caret-down')
            ->setAttribute('target', 'toolbox');
            $menu['ToolBox']->addChild('Outil 1', array('route' => 'intranet_homepage'));
            $menu['ToolBox']->addChild('Outil 2', array('route' => 'intranet_homepage'));

        $menu->addChild('Admin', array('label' => 'Administration '))
            ->setAttribute('icon', 'cog')
            ->setAttribute('icon2', 'caret-down')
            ->setAttribute('target', 'admin');
            $menu['Admin']->addChild('Compte rendu d\'activité', array('route' => 'intranet_cra_homepage'));
            $menu['Admin']->addChild('Note de frais', array('route' => 'intranet_expense_homepage'));
            $menu['Admin']->addChild('Demande de congés', array('route' => 'intranet_vacation_homepage'));
//            $menu['Admin']->addChild('CVthèque', array('route' => 'intranet_cv_homepage'));
            $menu['Admin']->addChild('Postes', array('route' => 'intranet_job_homepage'));
            $menu['Admin']->addChild('Compétences', array('route' => 'intranet_skill_homepage'));

        return $menu;
    }
}
