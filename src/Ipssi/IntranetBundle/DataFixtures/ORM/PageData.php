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
        $pageAccueil->setTitle('Ippsi - Accueil');
        $pageAccueil->setContent('<div class="row">
            <div class="col-sm-8">
                <h2>What We Do</h2>
                <p>Introduce the visitor to the business using clear, informative text. Use well-targeted keywords within your sentences to make sure search engines can find the business.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et molestiae similique eligendi reiciendis sunt distinctio odit? Quia, neque, ipsa, adipisci quisquam ullam deserunt accusantium illo iste exercitationem nemo voluptates asperiores.</p>
                <p>
                    <a class="btn btn-default btn-lg" href="#">Call to Action &raquo;</a>
                </p>
            </div>
            <div class="col-sm-4">
                <h2>Contact Us</h2>
                <address>
                    <strong>Start Bootstrap</strong>
                    <br>3481 Melrose Place
                    <br>Beverly Hills, CA 90210
                    <br>
                </address>
                <address>
                    <abbr title="Phone">P:</abbr>(123) 456-7890
                    <br>
                    <abbr title="Email">E:</abbr> <a href="mailto:#">name@example.com</a>
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
        $pageAccueil->setMetaDescription('Ippsi - Accueil');
        $pageAccueil->setMetaKeywords('Ippsi - Accueil');
        $pageAccueil->setSlug('accueil');
        $pageAccueil->setStatus(1);
        $pageAccueil->setUser($this->getReference('redacteur-user'));
        $pageAccueil->setPageCategory($this->getReference('accueil'));
        $pageAccueil->setPageTemplate($this->getReference('accueilT'));

        $pageActus = new Page();
        $pageActus->setName('Actualités');
        $pageActus->setTitle('Ippsi - Actualités');
        $pageActus->setContent('test');
        $pageActus->setMetaDescription('Ippsi - Actualités');
        $pageActus->setMetaKeywords('Ippsi - Actualités');
        $pageActus->setSlug('actus');
        $pageActus->setStatus(1);
        $pageActus->setUser($this->getReference('redacteur-user'));
        $pageActus->setPageCategory($this->getReference('actus'));
        $pageActus->setPageTemplate($this->getReference('actualitesT'));


        $pagePresentation = new Page();
        $pagePresentation->setName('Présentation');
        $pagePresentation->setTitle('Ippsi - Présentation');
        $pagePresentation->setContent('test');
        $pagePresentation->setMetaDescription('Ippsi - Présentation');
        $pagePresentation->setMetaKeywords('Ippsi - Présentation');
        $pagePresentation->setSlug('presentation');
        $pagePresentation->setStatus(1);
        $pagePresentation->setUser($this->getReference('redacteur-user'));
        $pagePresentation->setPageCategory($this->getReference('presentation'));
        $pagePresentation->setPageTemplate($this->getReference('pageSimpleT'));

        $pageChiffres = new Page();
        $pageChiffres->setName('Chiffres Clés');
        $pageChiffres->setTitle('Ippsi - Chiffres Clés');
        $pageChiffres->setContent('test');
        $pageChiffres->setMetaDescription('Ippsi - Chiffres Clés');
        $pageChiffres->setMetaKeywords('Ippsi - Chiffres Clés');
        $pageChiffres->setSlug('chiffres');
        $pageChiffres->setStatus(1);
        $pageChiffres->setUser($this->getReference('redacteur-user'));
        $pageChiffres->setPageCategory($this->getReference('chiffres'));
        $pageChiffres->setPageTemplate($this->getReference('pageSimpleT'));

        $pageExpertise = new Page();
        $pageExpertise->setName('Expertise');
        $pageExpertise->setTitle('Ippsi - Expertise');
        $pageExpertise->setContent('test');
        $pageExpertise->setMetaDescription('Ippsi - Expertise');
        $pageExpertise->setMetaKeywords('Ippsi - Expertise');
        $pageExpertise->setSlug('expertise');
        $pageExpertise->setStatus(1);
        $pageExpertise->setUser($this->getReference('redacteur-user'));
        $pageExpertise->setPageCategory($this->getReference('expertise'));
        $pageExpertise->setPageTemplate($this->getReference('pageSimpleT'));

        $pageValeurs = new Page();
        $pageValeurs->setName('Valeurs');
        $pageValeurs->setTitle('Ippsi - Valeurs');
        $pageValeurs->setContent('test');
        $pageValeurs->setMetaDescription('Ippsi - Valeurs');
        $pageValeurs->setMetaKeywords('Ippsi - Valeurs');
        $pageValeurs->setSlug('valeurs');
        $pageValeurs->setStatus(1);
        $pageValeurs->setUser($this->getReference('redacteur-user'));
        $pageValeurs->setPageCategory($this->getReference('valeurs'));
        $pageValeurs->setPageTemplate($this->getReference('pageSimpleT'));



        $pageMetiers = new Page();
        $pageMetiers->setName('Nos métiers');
        $pageMetiers->setTitle('Ippsi - Nos métiers');
        $pageMetiers->setContent('test');
        $pageMetiers->setMetaDescription('Ippsi - Nos métierss');
        $pageMetiers->setMetaKeywords('Ippsi - Nos métiers');
        $pageMetiers->setSlug('metiers');
        $pageMetiers->setStatus(1);
        $pageMetiers->setUser($this->getReference('redacteur-user'));
        $pageMetiers->setPageCategory($this->getReference('metiers'));
        $pageMetiers->setPageTemplate($this->getReference('pageSimpleT'));

        $pageSecteurs = new Page();
        $pageSecteurs->setName('Nos secteurs d\'activités');
        $pageSecteurs->setTitle('Ippsi - Nos secteurs d\'activités');
        $pageSecteurs->setContent('test');
        $pageSecteurs->setMetaDescription('Ippsi - Nos secteurs d\'activités');
        $pageSecteurs->setMetaKeywords('Ippsi - Nos secteurs d\'activités');
        $pageSecteurs->setSlug('secteurs');
        $pageSecteurs->setStatus(1);
        $pageSecteurs->setUser($this->getReference('redacteur-user'));
        $pageSecteurs->setPageCategory($this->getReference('secteurs'));
        $pageSecteurs->setPageTemplate($this->getReference('pageSimpleT'));

        $pageConfiance = new Page();
        $pageConfiance->setName('Ils nous font confiance');
        $pageConfiance->setTitle('Ippsi - Ils nous font confiance');
        $pageConfiance->setContent('test');
        $pageConfiance->setMetaDescription('Ippsi - Ils nous font confiance');
        $pageConfiance->setMetaKeywords('Ippsi - Ils nous font confiance');
        $pageConfiance->setSlug('confiance');
        $pageConfiance->setStatus(1);
        $pageConfiance->setUser($this->getReference('redacteur-user'));
        $pageConfiance->setPageCategory($this->getReference('confiance'));
        $pageConfiance->setPageTemplate($this->getReference('pageSimpleT'));



        $pagePostes = new Page();
        $pagePostes->setName('Les postes à pourvoir');
        $pagePostes->setTitle('Ippsi - Les postes à pourvoir');
        $pagePostes->setContent('test');
        $pagePostes->setMetaDescription('Ippsi - Les postes à pourvoir');
        $pagePostes->setMetaKeywords('Ippsi - Les postes à pourvoir');
        $pagePostes->setSlug('postes');
        $pagePostes->setStatus(1);
        $pagePostes->setUser($this->getReference('redacteur-user'));
        $pagePostes->setPageCategory($this->getReference('postes'));
        $pagePostes->setPageTemplate($this->getReference('pageSimpleT'));

        $pagePostuler = new Page();
        $pagePostuler->setName('Postuler');
        $pagePostuler->setTitle('Ippsi - Postuler');
        $pagePostuler->setContent('test');
        $pagePostuler->setMetaDescription('Ippsi - Postuler');
        $pagePostuler->setMetaKeywords('Ippsi - Postuler');
        $pagePostuler->setSlug('postuler');
        $pagePostuler->setStatus(1);
        $pagePostuler->setUser($this->getReference('redacteur-user'));
        $pagePostuler->setPageCategory($this->getReference('postuler'));
        $pagePostuler->setPageTemplate($this->getReference('pageSimpleT'));



        $pageContact = new Page();
        $pageContact->setName('Contact');
        $pageContact->setTitle('Ippsi - Contact');
        $pageContact->setContent('test');
        $pageContact->setMetaDescription('Ippsi - Contact');
        $pageContact->setMetaKeywords('Ippsi - Contact');
        $pageContact->setSlug('contact');
        $pageContact->setStatus(1);
        $pageContact->setUser($this->getReference('redacteur-user'));
        $pageContact->setPageCategory($this->getReference('contact'));
        $pageContact->setPageTemplate($this->getReference('pageSimpleT'));



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