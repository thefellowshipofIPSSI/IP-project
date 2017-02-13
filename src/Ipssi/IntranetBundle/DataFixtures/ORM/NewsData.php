<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\IntranetBundle\Entity\News;

class NewsData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $news = new News();
        $news->setName('CÉRÉMONIE DE REMISE DES DIPLÔMES');
        $news->setTitle('CÉRÉMONIE DE REMISE DES DIPLÔMES DU 3 JUILLET 2015');
        $news->setResume('LES ÉTUDIANTS DE MASTÈRE 1 ET MASTÈRE 2 DIPLÔMÉS');
        $news->setContent('<p> La cérémonie de remise des diplômes a eu lieu le 3 juillet dans les locaux d’IPSSI. Cet événement tant attendu par les étudiants de Mastère 1 et Mastère 2, a marqué l’aboutissement de 1 à 5 ans d’études à l’Ecole IPSSI du Groupe IP-Formation.</p>
                            
                            <h2>Une cérémonie de remise des diplômes dans la bonne humeur !</h2>
                            <p>Les étudiants, vêtus de leurs toges et de leurs coiffes, ont reçu leurs diplômes de Mastère 1 (bac+ 4) et Mastère 2 (bac+5), sous les applaudissements de leurs accompagnants et de leurs formateurs. Les majors de promo ont reçu l’écharpe de graduation ainsi qu’un cadeau de la part de l’école. Plusieurs membres de jury de soutenance étaient également de la partie.</p>
                            
                            <h2>Les photos</h2>
                            <p>Après une séance photo, les participants ont pu profiter d’un apéritif dînatoire sous l’animation musicale de Jérôme Monneraye, qui s’est vu lui aussi, remettre son diplôme.</p>
                            
                            <h2>La cérémonie</h2>
                            <p>La cérémonie a été présidée par le directeur des relations entreprises, Raphaël Ingigliardi, et s’est vue offrir les allocutions de Myriam Fabres, coordinatrice pédagogique, Erwan Letort, ancien directeur pédagogique, Catherine Cardoso, responsable des admissions, Stéphane Halimi, directeur pédagogique de la filière développement.</p>
                            
                            <h2>Merci</h2>
                            <p>L’école IPSSI tient à remercier les participants et à féliciter encore une fois ses diplômés en leur souhaitant une très bonne continuation et en espérant les revoir très bientôt pour des collaborations professionnelles avec nos étudiants actuels.</p>
                            ');
        $news->setSlug('ceremonie');
        $news->setStatus(1);
        $news->setMetaDescription('cérémonie diplôme');
        $news->setMetaTitle('cérémonie diplôme');
        $news->setUser($this->getReference('redacteur-user'));


        $news2 = new News();
        $news2->setName('Semaine du Challenge projet Intersession');
        $news2->setTitle('Semaine du Challenge projet Intersession');
        $news2->setResume('10 iPad offerts à l’équipe gagnante !');
        $news2->setContent('<p class="description">
                                                    Félicitations à nos étudiants des sessions administrateurs réseau, webdesigner et développeur, dont les 10 équipes avaient pour mission de concevoir un site de vente en ligne en une semaine chrono. L’équipe gagnante a été récompensée par la remise de 10 IPAD, soit 1 IPAD par étudiant ! <strong>Encore Bravo</strong> à tous pour votre implication, votre créativité et votre professionnalisme. A très vite pour le prochain challenge ! 
                            </p>
                            ');
        $news2->setSlug('challenge');
        $news2->setStatus(1);
        $news2->setMetaDescription('challenge');
        $news2->setMetaTitle('challenge');
        $news2->setUser($this->getReference('redacteur-user'));


        $news3 = new News();
        $news3->setName('Conférence sur le développement Windows Phone 8 ');
        $news3->setTitle('Conférence sur le développement Windows Phone 8 ');
        $news3->setResume('L\'école ipssi faisant partie du programme Campus de Microsoft');
        $news3->setContent('<p>L\'école ipssi faisant partie du programme Campus de Microsoft, nous avons été conviés à une conférence sur le développement sur les plateformes Windows 8 et Windows Phone 8. Une matinée en compagnie de l’équipe Soat et Microsoft pour mieux comprendre les technologies Microsoft et son intérêt pour la mobilité.
                                                </p>
                            ');
        $news3->setSlug('microsoft');
        $news3->setStatus(1);
        $news3->setMetaDescription('microsoft');
        $news3->setMetaTitle('microsoft');
        $news3->setUser($this->getReference('redacteur-user'));
        
        
        $manager->persist($news);
        $manager->persist($news2);
        $manager->persist($news3);

        $manager->flush();

    }

    public function getOrder()
    {
        return 4;
    }
}