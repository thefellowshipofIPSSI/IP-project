<?php
namespace Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
    * @dataProvider urlProvider
    */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/'),

            array('/intranet'),
            array('/intranet/page'),
            array('/intranet/page/create'),
            array('/intranet/page/{page_id}/update'),
            array('/intranet/page/{page_id}/delete'),
            array('/intranet/page/{page_id}/view'),
            array('/intranet/page/{page_id}/online'),
            array('/intranet/page/{page_id}/offline'),
            array('/intranet/news'),
            array('/intranet/news/create'),
            array('/intranet/news/{news_id}/update'),
            array('/intranet/news/{news_id}/delete'),
            array('/intranet/news/{news_id}/view'),
            array('/intranet/news/{news_id}/online'),
            array('/intranet/news/{news_id}/offline'),
            array('/intranet/users'),
            array('/intranet/users/create'),
            array('/intranet/user/{user_id}/update'),
            array('/intranet/user/{user_id}/delete'),
            array('/intranet/user/{user_id}/view'),
            array('/intranet/user/{user_id}/online'),
            array('/intranet/user/{user_id}/offline'),

        );
    }
}