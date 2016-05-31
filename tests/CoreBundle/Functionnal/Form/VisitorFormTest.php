<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 30/05/16
 * Time: 11:08
 */

namespace tests\CoreBundle\Functionnal\Form;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VisitorFormTest extends WebTestCase
{
    public function testSubmitVisitorFormWithValidData()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', "/reservation");
        $form = $crawler->selectButton("submit")->form();

        $client->submit($form, array(
            "visitor[ticket][dateReservation]" => "2020-01-02",
            "visitor[ticket][fullDay]" => 0,
            "visitor[firstname]" => "John",
            "visitor[lastname]" => "Doe",
            "visitor[birthday]" => "1990-01-01",
            "visitor[country]" => "France",

        ));

        $client->followRedirect();

        $lastContent = $client->getResponse()->getContent();

        $this->assertContains("panier", $lastContent);

    }

    public function testSubmitVisitorFormWithInvalidData()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', "/reservation");
        $form = $crawler->selectButton("submit")->form();

        $client->submit($form, array(
            "visitor[ticket][dateReservation]" => "2010-05-05",
            "visitor[ticket][fullDay]" => 0,
            "visitor[firstname]" => "",
            "visitor[lastname]" => "",
            "visitor[birthday]" => "2000-01-01",
            "visitor[country]" => "",

        ));

        $this->assertFalse($client->getResponse()->isRedirect('/panier'));

    }

}