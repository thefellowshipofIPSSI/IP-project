<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Sg\DatatablesBundle\SgDatatablesBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),

            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SerializerBundle\JMSSerializerBundle(),
//            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),



            // Project Bundles
            new Ipssi\JobBundle\JobBundle(),
            new Ipssi\IpssiBundle\IpssiBundle(),
            new Ipssi\IntranetBundle\IntranetBundle(),
            new UserBundle\UserBundle(),

            new FOS\UserBundle\FOSUserBundle(),
            new \Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle()



        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
        //Override the cache Directory to improve vagrant speed
        //return dirname(__DIR__).'/../IP-project_var/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
        //Override the log Directory to improve vagrant speed
        //return dirname(__DIR__).'/../IP-project_var/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
