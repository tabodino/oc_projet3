<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 27/05/16
 * Time: 11:30
 */

namespace OC\CoreBundle\Tests\CoreBundle\Functionnal\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoreControllerTest extends WebTestCase
{
    public function testHomePageIsStatus200()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $title = $crawler->filter('h2')->text();

        $responseCode = $client->getResponse()->getStatusCode();

        $this->assertEquals('Réservez vos billets en ligne', $title);

        $this->assertEquals(200, $responseCode);
    }

    public function testPricelistPageIsStatus200()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tarifs');

        $title = $crawler->filter('#dg h4')->text();

        $responseCode = $client->getResponse()->getStatusCode();

        $this->assertEquals('LISTE DES TARIFS', $title);

        $this->assertEquals(200, $responseCode);
    }

    public function testReservationPageIsStatus200()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/reservation');

        $form = $crawler->filter('form')->count();

        $responseCode = $client->getResponse()->getStatusCode();

        $this->assertEquals($form, 1);

        $this->assertEquals(200, $responseCode);
    }


}