<?php
namespace Ipssi\IntranetBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuBuilder extends Controller
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createUserMenu( array $options)
    {
        //var_dump($this->get('fos_userbundle'));
        //$user = $this->get('security.token_storage')->getToken()->getUser();

//      $user = $this->get('fos_userbundle')->getToken()->getUser();
        $menu = $this->factory->createItem('user');
        $menu->setChildrenAttribute('class', 'nav navbar-right top-nav');


        $menu->addChild('User', array('label' => 'Bonjour'))
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'user');
            $menu['User']->addChild('Profile', array('uri' => '#'))
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



    public function createSidebarMenu(array $options)
    {
        $menu = $this->factory->createItem('sidebar');

        $menu->setChildrenAttribute('class', 'nav navbar-nav side-nav');

        $menu->addChild('News', array('label' => 'Actualités', 'route' => 'intranet_news_homepage'))
        ->setAttribute('icon', 'newspaper-o');

        $menu->addChild('RH', array('label' => 'Ressources Humaines '))
            ->setAttribute('icon', 'group')
            ->setAttribute('icon2', 'caret-down')
            ->setAttribute('target', 'rh');
        $menu['RH']->addChild('Compte rendu d\'activité', array('route' => 'intranet_cra_homepage'));
            $menu['RH']->addChild('Note de frais', array('route' => 'intranet_expense_homepage'));
            $menu['RH']->addChild('Demande de congés', array('route' => 'intranet_vacation_homepage'));
            $menu['RH']->addChild('CVthèque', array('route' => 'intranet_cv_homepage'));
            $menu['RH']->addChild('Offres de poste', array('route' => 'intranet_job_offer_homepage'));
            $menu['RH']->addChild('Candidatures', array('route' => 'intranet_candidacy_homepage'));
            $menu['RH']->addChild('Collaborateurs', array('route' => 'intranet_user_homepage'));

        $menu->addChild('ToolBox', array('label' => 'Boite à outils '))
            ->setAttribute('icon', 'wrench')
            ->setAttribute('icon2', 'caret-down')
            ->setAttribute('target', 'toolbox');
            $menu['ToolBox']->addChild('Compte rendu d\'activité', array('route' => 'intranet_cra_homepage'));
            $menu['ToolBox']->addChild('Note de frais', array('route' => 'intranet_expense_homepage'));

        $menu->addChild('Admin', array('label' => 'Administration '))
            ->setAttribute('icon', 'cog')
            ->setAttribute('icon2', 'caret-down')
            ->setAttribute('target', 'admin');
        $menu['Admin']->addChild('Compte rendu d\'activité', array('route' => 'intranet_cra_homepage'));
            $menu['Admin']->addChild('Note de frais', array('route' => 'intranet_expense_homepage'));
            $menu['Admin']->addChild('Demande de congés', array('route' => 'intranet_vacation_homepage'));
            $menu['Admin']->addChild('CVthèque', array('route' => 'intranet_cv_homepage'));

        return $menu;
    }
}