<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 29/05/16
 * Time: 13:14
 */

namespace tests\CoreBundle\Functionnal\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartControllerTest extends WebTestCase
{

    public function testCartPageIsStatus200()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/panier');

        $title = $crawler->filter('h4')->text();

        $responseCode = $client->getResponse()->getStatusCode();

        $this->assertEquals('DETAIL DE VOTRE PANIER', $title);

        $this->assertEquals(200, $responseCode);

    }

    public function testAddCartPageIsStatus302()
    {
        $client = static::createClient();

        $client->request('GET', '/panier/ajout/1');

        $client->followRedirects();

        $responseCode = $client->getResponse()->getStatusCode();

        $finalUrl = $client->getResponse()->headers->get('location');

        $this->assertEquals(302, $responseCode);

        $this->assertEquals('/panier', $finalUrl);

    }

    public function testRemoveCartPageIsStatus302()
    {
        $client = static::createClient();

        $client->request('GET', '/panier/supprime/1');

        $client->followRedirects();

        $responseCode = $client->getResponse()->getStatusCode();

        $finalUrl = $client->getResponse()->headers->get('location');

        $this->assertEquals(302, $responseCode);

        $this->assertEquals('/panier', $finalUrl);

    }

    public function testValidatedCartPageIsStatus200()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/remerciement');

        $title = $crawler->filter('h4')->text();

        $responseCode = $client->getResponse()->getStatusCode();

        $this->assertEquals('VOTRE PAIEMENT A ETE VALIDE', $title);

        $this->assertEquals(200, $responseCode);
    }
}