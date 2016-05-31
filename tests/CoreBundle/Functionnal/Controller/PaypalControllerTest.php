<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 30/05/16
 * Time: 11:33
 */

namespace tests\CoreBundle\Functionnal\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaypalControllerTest extends WebTestCase
{
    
    public function testExpressCheckoutErrorPageIsStatus200()
    {
        $client = static::createClient();

        $client->request('GET', '/paypal/error');

        $responseCode = $client->getResponse()->getStatusCode();

        $this->assertEquals(200, $responseCode);
    }


}