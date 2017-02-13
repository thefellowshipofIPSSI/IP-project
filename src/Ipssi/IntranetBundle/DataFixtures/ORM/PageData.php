<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\Page;

class LoadPageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pageAccueil = new Page();
        $pageAccueil->setName('accueil');
        $pageAccueil->setTitle('Ipssi - Accueil');
        $pageAccueil->setContent('<div class="row">
            <div class="col-sm-8">
                <h2>L\'école IPSSI</h2>
                <p>L’IT-Akademy est, depuis sa création, spécialisée dans le domaine de l’ingénierie informatique professionnalisante et délivre des certifications, diplômes ou titres professionnels inscrits au RNCP jusqu’au niveau 1.
            Les cursus sont suivis dans le cadre de l’alternance, de la formation initiale, de parcours de professionnalisation ou VAE. Les différentes filières conduisent principalement aux métiers de <a href="">Développeur Full Stack</a>, d\'<a href="">Administrateur Système et Réseau</a> ou encore de <a href="">Chef de Projets Informatiques</a> et <a href="">Manager du Système d\'Information</a>.</p>
            Les formations préparent également aux certifications techniques d\'éditeurs reconnus sur le marché (Microsoft, Zend PHP, Oracle MySQL...).</p>

                <p>
                    <a class="btn btn-default btn-lg" href="#">En savoir plus &raquo;</a>
                </p>
            </div>
            <div class="col-sm-4">
                <h2>Contactez nous</h2>
                <address>
                    <strong>IPSSI</strong>
                    <br>6 Place Charles Hernu<br>69100 Villeurbanne
                    <br>
                </address>
                <address>
                    <abbr title="Phone">T:</abbr> 04 82 53 73 75
                    <br>
                    <abbr title="Email">E:</abbr> <a href="mailto:contact@ipssi.com">contact@ipssi.com</a>
                </address>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <div class="row">
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="https://placehold.it/300x300" alt="">
                <h2>Marketing Box #1</h2>
                <p>These marketing boxes are a great place to put some information. These can contain summaries of what the company does, promotional information, or anything else that is relevant to the company. These will usually be below-the-fold.</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="https://placehold.it/300x300" alt="">
                <h2>Marketing Box #2</h2>
                <p>The images are set to be circular and responsive. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="https://placehold.it/300x300" alt="">
                <h2>Marketing Box #3</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>
            </div>
        </div>
        <!-- /.row -->');
        $pageAccueil->setMetaDescription('Ipssi - Accueil');
        $pageAccueil->setMetaKeywords('Ipssi - Accueil');
        $pageAccueil->setSlug('accueil');
        $pageAccueil->setStatus(1);
        $pageAccueil->setUser($this->getReference('redacteur-user'));
        $pageAccueil->setPageCategory($this->getReference('accueil'));
        $pageAccueil->setPageTemplate($this->getReference('accueilT'));

        $pageActus = new Page();
        $pageActus->setName('Actualités');
        $pageActus->setTitle('Ipssi - Actualités');
        $pageActus->setContent('test');
        $pageActus->setMetaDescription('Ipssi - Actualités');
        $pageActus->setMetaKeywords('Ipssi - Actualités');
        $pageActus->setSlug('actus');
        $pageActus->setStatus(1);
        $pageActus->setUser($this->getReference('redacteur-user'));
        $pageActus->setPageCategory($this->getReference('actus'));
        $pageActus->setPageTemplate($this->getReference('actualitesT'));


        $pagePresentation = new Page();
        $pagePresentation->setName('Présentation');
        $pagePresentation->setTitle('Ipssi - Présentation');
        $pagePresentation->setContent('test');
        $pagePresentation->setMetaDescription('Ipssi - Présentation');
        $pagePresentation->setMetaKeywords('Ipssi - Présentation');
        $pagePresentation->setSlug('presentation');
        $pagePresentation->setStatus(1);
        $pagePresentation->setUser($this->getReference('redacteur-user'));
        $pagePresentation->setPageCategory($this->getReference('presentation'));
        $pagePresentation->setPageTemplate($this->getReference('pageSimpleT'));

        $pageChiffres = new Page();
        $pageChiffres->setName('Chiffres Clés');
        $pageChiffres->setTitle('Ipssi - Chiffres Clés');
        $pageChiffres->setContent('test');
        $pageChiffres->setMetaDescription('Ipssi - Chiffres Clés');
        $pageChiffres->setMetaKeywords('Ipssi - Chiffres Clés');
        $pageChiffres->setSlug('chiffres');
        $pageChiffres->setStatus(1);
        $pageChiffres->setUser($this->getReference('redacteur-user'));
        $pageChiffres->setPageCategory($this->getReference('chiffres'));
        $pageChiffres->setPageTemplate($this->getReference('pageSimpleT'));

        $pageExpertise = new Page();
        $pageExpertise->setName('Expertise');
        $pageExpertise->setTitle('Ipssi - Expertise');
        $pageExpertise->setContent('test');
        $pageExpertise->setMetaDescription('Ipssi - Expertise');
        $pageExpertise->setMetaKeywords('Ipssi - Expertise');
        $pageExpertise->setSlug('expertise');
        $pageExpertise->setStatus(1);
        $pageExpertise->setUser($this->getReference('redacteur-user'));
        $pageExpertise->setPageCategory($this->getReference('expertise'));
        $pageExpertise->setPageTemplate($this->getReference('pageSimpleT'));

        $pageValeurs = new Page();
        $pageValeurs->setName('Valeurs');
        $pageValeurs->setTitle('Ipssi - Valeurs');
        $pageValeurs->setContent('test');
        $pageValeurs->setMetaDescription('Ipssi - Valeurs');
        $pageValeurs->setMetaKeywords('Ipssi - Valeurs');
        $pageValeurs->setSlug('valeurs');
        $pageValeurs->setStatus(1);
        $pageValeurs->setUser($this->getReference('redacteur-user'));
        $pageValeurs->setPageCategory($this->getReference('valeurs'));
        $pageValeurs->setPageTemplate($this->getReference('pageSimpleT'));



        $pageMetiers = new Page();
        $pageMetiers->setName('Nos métiers');
        $pageMetiers->setTitle('Ipssi - Nos métiers');
        $pageMetiers->setContent('test');
        $pageMetiers->setMetaDescription('Ipssi - Nos métierss');
        $pageMetiers->setMetaKeywords('Ipssi - Nos métiers');
        $pageMetiers->setSlug('metiers');
        $pageMetiers->setStatus(1);
        $pageMetiers->setUser($this->getReference('redacteur-user'));
        $pageMetiers->setPageCategory($this->getReference('metiers'));
        $pageMetiers->setPageTemplate($this->getReference('pageSimpleT'));

        $pageSecteurs = new Page();
        $pageSecteurs->setName('Nos secteurs d\'activités');
        $pageSecteurs->setTitle('Ipssi - Nos secteurs d\'activités');
        $pageSecteurs->setContent('test');
        $pageSecteurs->setMetaDescription('Ipssi - Nos secteurs d\'activités');
        $pageSecteurs->setMetaKeywords('Ipssi - Nos secteurs d\'activités');
        $pageSecteurs->setSlug('secteurs');
        $pageSecteurs->setStatus(1);
        $pageSecteurs->setUser($this->getReference('redacteur-user'));
        $pageSecteurs->setPageCategory($this->getReference('secteurs'));
        $pageSecteurs->setPageTemplate($this->getReference('pageSimpleT'));

        $pageConfiance = new Page();
        $pageConfiance->setName('Ils nous font confiance');
        $pageConfiance->setTitle('Ipssi - Ils nous font confiance');
        $pageConfiance->setContent('test');
        $pageConfiance->setMetaDescription('Ipssi - Ils nous font confiance');
        $pageConfiance->setMetaKeywords('Ipssi - Ils nous font confiance');
        $pageConfiance->setSlug('confiance');
        $pageConfiance->setStatus(1);
        $pageConfiance->setUser($this->getReference('redacteur-user'));
        $pageConfiance->setPageCategory($this->getReference('confiance'));
        $pageConfiance->setPageTemplate($this->getReference('pageSimpleT'));



        $pagePostes = new Page();
        $pagePostes->setName('Les postes à pourvoir');
        $pagePostes->setTitle('Ipssi - Les postes à pourvoir');
        $pagePostes->setContent('test');
        $pagePostes->setMetaDescription('Ipssi - Les postes à pourvoir');
        $pagePostes->setMetaKeywords('Ipssi - Les postes à pourvoir');
        $pagePostes->setSlug('postes');
        $pagePostes->setStatus(1);
        $pagePostes->setUser($this->getReference('redacteur-user'));
        $pagePostes->setPageCategory($this->getReference('postes'));
        $pagePostes->setPageTemplate($this->getReference('pageSimpleT'));

        $pagePostuler = new Page();
        $pagePostuler->setName('Postuler');
        $pagePostuler->setTitle('Ipssi - Postuler');
        $pagePostuler->setContent('test');
        $pagePostuler->setMetaDescription('Ipssi - Postuler');
        $pagePostuler->setMetaKeywords('Ipssi - Postuler');
        $pagePostuler->setSlug('postuler');
        $pagePostuler->setStatus(1);
        $pagePostuler->setUser($this->getReference('redacteur-user'));
        $pagePostuler->setPageCategory($this->getReference('postuler'));
        $pagePostuler->setPageTemplate($this->getReference('pageSimpleT'));



        $pageContact = new Page();
        $pageContact->setName('Contact');
        $pageContact->setTitle('Ipssi - Contact');
        $pageContact->setContent('test');
        $pageContact->setMetaDescription('Ipssi - Contact');
        $pageContact->setMetaKeywords('Ipssi - Contact');
        $pageContact->setSlug('contact');
        $pageContact->setStatus(1);
        $pageContact->setUser($this->getReference('redacteur-user'));
        $pageContact->setPageCategory($this->getReference('contact'));
        $pageContact->setPageTemplate($this->getReference('contactT'));



        $manager->persist($pageAccueil);
        $manager->persist($pageActus);
        $manager->persist($pagePresentation);
        $manager->persist($pageChiffres);
        $manager->persist($pageExpertise);
        $manager->persist($pageValeurs);

        $manager->persist($pageMetiers);
        $manager->persist($pageSecteurs);
        $manager->persist($pageConfiance);

        $manager->persist($pagePostes);
        $manager->persist($pagePostuler);

        $manager->persist($pageContact);


        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}