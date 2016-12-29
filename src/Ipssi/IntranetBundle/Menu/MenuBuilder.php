<?php
namespace Ipssi\IntranetBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\DependencyInjection\ContainerInterface;
use JMS\SecurityExtraBundle\Metadata\Driver\AnnotationDriver;



class MenuBuilder
{
    /** @var FactoryInterface */
    private $factory;

    /** @var ContainerInterface */
    private $container;

    /** @var Router */
    private $router;

    /**
     * @var SecurityContext
     */
    private $securityContext;

    /**
     * @var \JMS\SecurityExtraBundle\Metadata\Driver\AnnotationDriver
     */
    private $metadataReader;


    /**
     * @param FactoryInterface $factory, ContainerInterface $container
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, ContainerInterface $container)
    {
        $this->factory = $factory;
        $this->container = $container;
        $this->router = $this->container->get('router');
        $this->securityContext = $this->container->get('security.authorization_checker');
        $this->metadataReader = new AnnotationDriver(new \Doctrine\Common\Annotations\AnnotationReader());
    }

    public function filterMenu(ItemInterface $menu)
    {
        foreach ($menu->getChildren() as $child) {
            /** @var \Knp\Menu\MenuItem $child */
            list($route) = $child->getExtra('routes');

            if ($route && !$this->hasRouteAccess($route)) {
                $menu->removeChild($child);
            }
            $this->filterMenu($child);
        }

        return $menu;
    }

    /**
     * @param $class
     * @return \JMS\SecurityExtraBundle\Metadata\ClassMetadata
     */
    public function getMetadata($class)
    {
        return $this->metadataReader->loadMetadataForClass(new \ReflectionClass($class));
    }

    public function hasRouteAccess($routeName)
    {
        if ($this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

            $route = $this->router->getRouteCollection()->get($routeName["route"]);

            $controller = $route->getDefault('_controller');

            list($class, $method) = explode('::', $controller, 2);

            $metadata = $this->getMetadata($class);

            if (!isset($metadata->methodMetadata[$method])) {
                return false;
            }

            foreach ($metadata->methodMetadata[$method]->roles as $role) {
                if ($this->securityContext->isGranted($role)) {
                    return true;
                }
            }
        }
        return false;
    }


    public function createUserMenu(TokenStorage $requestStack)
    {

        $user = $requestStack->getToken()->getUser();


        //var_dump($this->get('security.authorization_checker'));


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



    public function createSidebarMenu()
    {
        $menu = $this->factory->createItem('sidebar');

        $menu->setChildrenAttribute('class', 'nav navbar-nav side-nav');

        $menu->addChild('News', array('label' => 'Actualités', 'route' => 'intranet_news_homepage'))
        ->setAttribute('icon', 'newspaper-o');

        $menu->addChild('Pages', array('label' => 'Pages', 'route' => 'intranet_page_homepage'))
            ->setAttribute('icon', 'file-text-o');

        $menu->addChild('RH', array('label' => 'Ressources Humaines '))
            ->setAttribute('icon', 'group')
            ->setAttribute('icon2', 'caret-down')
            ->setAttribute('target', 'rh');
            //$menu['RH']->addChild('Compte rendu d\'activité', array('route' => 'intranet_cra_homepage'));
            //$menu['RH']->addChild('Note de frais', array('route' => 'intranet_expense_homepage'));
            //$menu['RH']->addChild('Demande de congés', array('route' => 'intranet_vacation_homepage'));
            //$menu['RH']->addChild('CVthèque', array('route' => 'intranet_cv_homepage'));
            $menu['RH']->addChild('Entreprises partenaires', array('route' => 'intranet_societies'));
            $menu['RH']->addChild('Offres de poste', array('route' => 'intranet_offers'));
            $menu['RH']->addChild('Candidatures', array('route' => 'intranet_candidacies'));
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
            $menu['Admin']->addChild('Postes', array('route' => 'intranet_offers'));
            $menu['Admin']->addChild('Compétences', array('route' => 'intranet_skills'));

        //$this->filterMenu($menu);

        return $menu;
    }
}