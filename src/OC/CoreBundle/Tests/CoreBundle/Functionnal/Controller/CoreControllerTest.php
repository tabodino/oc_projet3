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

        $client->request('GET', '/');

        $responseCode = $client->getResponse()->getStatusCode();

        $this->assertEquals(200, $responseCode);
    }
}