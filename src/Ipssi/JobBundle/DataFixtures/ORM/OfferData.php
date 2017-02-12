<?php

namespace Ipssi\IntranetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ipssi\JobBundle\Entity\Offer;

class OfferData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $offer = new Offer();
        $offer->setName('Développeur web Symfony 2');
        $offer->setContract('CDI');
        $offer->setDescription("
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet euismod massa. Vestibulum ullamcorper dictum nibh, at sodales urna vestibulum quis. Aenean hendrerit ligula est. Donec ut congue ligula. In mollis sagittis nisi eu volutpat. Vivamus at ullamcorper tellus. Aenean suscipit ac nulla aliquet gravida. Aliquam eu nibh facilisis, varius eros in, dictum massa. Integer ante dolor, sagittis dapibus auctor vitae, sodales at lectus. In rutrum a velit vel mollis. Quisque dignissim lacus sit amet metus lacinia dapibus. Duis vel risus in velit feugiat tincidunt et tempus purus. Morbi suscipit egestas sem eget feugiat. Donec blandit at mi eu tempus. Mauris volutpat elementum ultricies. Morbi non ante vestibulum, consequat felis eu, dapibus lectus.
            </p>
            <p>
            Etiam arcu ex, porttitor sagittis ullamcorper vitae, accumsan porttitor nisi. Nulla porttitor sodales elit, eu tristique quam scelerisque ac. Sed a sapien vel nulla pulvinar dictum in ac odio. Ut cursus dui in pulvinar posuere. Mauris placerat congue tortor eu lacinia. Quisque vel semper elit. Sed varius enim ac laoreet vehicula. Proin id enim tortor. Praesent sodales, turpis eget lobortis commodo, erat dolor tristique turpis, scelerisque dapibus quam quam et turpis. Maecenas congue sollicitudin lectus ut pellentesque. Fusce sollicitudin sollicitudin ipsum. Nam ac ex vitae mi finibus suscipit. Sed blandit diam id suscipit rutrum. Morbi pretium orci dolor, pulvinar molestie metus porttitor vel. In eget velit libero. Donec condimentum id nibh quis pulvinar.
            </p>
            <p>
            Nunc arcu massa, finibus eget ante eu, posuere ultrices purus. Curabitur nec commodo nulla. Aenean dui nunc, sodales et diam id, pellentesque posuere augue. Proin porta metus vitae eros interdum hendrerit. Maecenas ex quam, volutpat eget finibus ac, faucibus ut nisl. Donec eget consectetur mauris. Curabitur justo ipsum, euismod eu tempus ut, semper sit amet lacus. Donec sagittis at ante et ultrices. Sed orci turpis, finibus a sodales ut, sollicitudin quis eros. Sed sit amet ipsum non felis scelerisque rhoncus sed in magna. Donec lacinia, justo eget efficitur auctor, tellus ligula mollis odio, sit amet sodales augue odio ac diam. Aenean ornare vitae nisi vulputate viverra. Praesent ultrices turpis in nibh sollicitudin, id molestie magna mollis. Vestibulum non erat sit amet justo tincidunt imperdiet. Curabitur vestibulum fringilla metus, a accumsan felis dignissim et. Aliquam venenatis molestie magna et viverra.
            </p>
            <p>
            Quisque consequat, enim dignissim imperdiet semper, lacus felis pretium quam, efficitur mollis risus velit vel felis. Vestibulum varius cursus velit ultrices auctor. Aliquam mauris risus, ultricies eu bibendum nec, eleifend nec leo. Nam rutrum ipsum et congue varius. Vivamus dictum neque elit, sed mollis velit dapibus ut. Fusce augue felis, dictum nec urna ut, fringilla auctor augue. Ut eu accumsan enim, id consequat sapien.
            </p>
            <p>
            Proin faucibus massa erat, vel imperdiet nulla euismod vel. Nunc ornare, mauris in tristique suscipit, sapien magna laoreet magna, vel iaculis diam nulla non purus. Nunc consequat tincidunt mauris sed rhoncus. Vivamus fringilla ultrices risus vitae tincidunt. Aliquam venenatis pharetra dui ut commodo. Suspendisse potenti. Maecenas purus mauris, egestas non fringilla luctus, dapibus ut erat. Donec tellus risus, volutpat sit amet lorem non, facilisis condimentum diam. Morbi accumsan consectetur facilisis. Phasellus auctor purus sit amet maximus vehicula. Nam vel condimentum ex, sed fringilla mauris. Suspendisse imperdiet in massa interdum congue. Proin dictum, tortor eget ullamcorper rhoncus, sem nisl semper quam, sed mollis enim massa in turpis. Integer interdum efficitur felis, sed molestie magna auctor nec.
            </p>
        ");
        $offer->setLocation('Paris');
        $offer->setSalary(2000);
        $offer->setCurrency('€');
        $offer->setBeginDate('Dès que possible');
        $offer->setStatus(1);
        $offer->setCreatedBy($this->getReference('manager-user'));
        $offer->setSociety($this->getReference('google-society'));
        $offer->setType($this->getReference('web-dev-job'));
        $offer->addSkill($this->getReference('php-skill'));
        $offer->addSkill($this->getReference('symfony-skill'));

        $offer2 = new Offer();
        $offer2->setName('Data Scientist');
        $offer2->setContract('CDI');
        $offer2->setDescription("
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet euismod massa. Vestibulum ullamcorper dictum nibh, at sodales urna vestibulum quis. Aenean hendrerit ligula est. Donec ut congue ligula. In mollis sagittis nisi eu volutpat. Vivamus at ullamcorper tellus. Aenean suscipit ac nulla aliquet gravida. Aliquam eu nibh facilisis, varius eros in, dictum massa. Integer ante dolor, sagittis dapibus auctor vitae, sodales at lectus. In rutrum a velit vel mollis. Quisque dignissim lacus sit amet metus lacinia dapibus. Duis vel risus in velit feugiat tincidunt et tempus purus. Morbi suscipit egestas sem eget feugiat. Donec blandit at mi eu tempus. Mauris volutpat elementum ultricies. Morbi non ante vestibulum, consequat felis eu, dapibus lectus.
            </p>
            <p>
            Etiam arcu ex, porttitor sagittis ullamcorper vitae, accumsan porttitor nisi. Nulla porttitor sodales elit, eu tristique quam scelerisque ac. Sed a sapien vel nulla pulvinar dictum in ac odio. Ut cursus dui in pulvinar posuere. Mauris placerat congue tortor eu lacinia. Quisque vel semper elit. Sed varius enim ac laoreet vehicula. Proin id enim tortor. Praesent sodales, turpis eget lobortis commodo, erat dolor tristique turpis, scelerisque dapibus quam quam et turpis. Maecenas congue sollicitudin lectus ut pellentesque. Fusce sollicitudin sollicitudin ipsum. Nam ac ex vitae mi finibus suscipit. Sed blandit diam id suscipit rutrum. Morbi pretium orci dolor, pulvinar molestie metus porttitor vel. In eget velit libero. Donec condimentum id nibh quis pulvinar.
            </p>
            <p>
            Nunc arcu massa, finibus eget ante eu, posuere ultrices purus. Curabitur nec commodo nulla. Aenean dui nunc, sodales et diam id, pellentesque posuere augue. Proin porta metus vitae eros interdum hendrerit. Maecenas ex quam, volutpat eget finibus ac, faucibus ut nisl. Donec eget consectetur mauris. Curabitur justo ipsum, euismod eu tempus ut, semper sit amet lacus. Donec sagittis at ante et ultrices. Sed orci turpis, finibus a sodales ut, sollicitudin quis eros. Sed sit amet ipsum non felis scelerisque rhoncus sed in magna. Donec lacinia, justo eget efficitur auctor, tellus ligula mollis odio, sit amet sodales augue odio ac diam. Aenean ornare vitae nisi vulputate viverra. Praesent ultrices turpis in nibh sollicitudin, id molestie magna mollis. Vestibulum non erat sit amet justo tincidunt imperdiet. Curabitur vestibulum fringilla metus, a accumsan felis dignissim et. Aliquam venenatis molestie magna et viverra.
            </p>
            <p>
            Quisque consequat, enim dignissim imperdiet semper, lacus felis pretium quam, efficitur mollis risus velit vel felis. Vestibulum varius cursus velit ultrices auctor. Aliquam mauris risus, ultricies eu bibendum nec, eleifend nec leo. Nam rutrum ipsum et congue varius. Vivamus dictum neque elit, sed mollis velit dapibus ut. Fusce augue felis, dictum nec urna ut, fringilla auctor augue. Ut eu accumsan enim, id consequat sapien.
            </p>
            <p>
            Proin faucibus massa erat, vel imperdiet nulla euismod vel. Nunc ornare, mauris in tristique suscipit, sapien magna laoreet magna, vel iaculis diam nulla non purus. Nunc consequat tincidunt mauris sed rhoncus. Vivamus fringilla ultrices risus vitae tincidunt. Aliquam venenatis pharetra dui ut commodo. Suspendisse potenti. Maecenas purus mauris, egestas non fringilla luctus, dapibus ut erat. Donec tellus risus, volutpat sit amet lorem non, facilisis condimentum diam. Morbi accumsan consectetur facilisis. Phasellus auctor purus sit amet maximus vehicula. Nam vel condimentum ex, sed fringilla mauris. Suspendisse imperdiet in massa interdum congue. Proin dictum, tortor eget ullamcorper rhoncus, sem nisl semper quam, sed mollis enim massa in turpis. Integer interdum efficitur felis, sed molestie magna auctor nec.
            </p>
        ");
        $offer2->setLocation('New York');
        $offer2->setSalary(2500);
        $offer2->setCurrency('USD');
        $offer2->setBeginDate('Dès que possible');
        $offer2->setStatus(0);
        $offer2->setCreatedBy($this->getReference('manager-user'));
        $offer2->setSociety($this->getReference('facebook-society'));
        $offer2->setType($this->getReference('data-scientist-job'));
        $offer2->addSkill($this->getReference('sql-skill'));
        $offer2->addSkill($this->getReference('data-mining-skill'));




        $manager->persist($offer);
        $manager->persist($offer2);

        $manager->flush();

        $this->setReference('dev-symfony-offer', $offer);
        $this->setReference('data-scientist-offer', $offer2);

    }

    public function getOrder()
    {
        return 10;
    }
}