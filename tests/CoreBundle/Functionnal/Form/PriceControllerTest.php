<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 10/06/16
 * Time: 14:31
 */

namespace tests\CoreBundle\Functionnal\Form;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;

class PriceControllerTest extends WebTestCase
{

    protected $client = null;


    public function setUp()
    {
        $this->client = $this->createAuthorizedClient();
    }

    public function testSubmitFormPriceEditWithValidData()
    {
        $crawler = $this->client->request('POST', "admin/tarifs");

        $form = $crawler->filter('input[type="submit"]')->form(array(
            'id' => 163,
            'price' => 0,
        ));

        $this->client->submit($form);

        $this->assertTrue($this->client->getResponse()->isRedirect('/admin/tarifs'));
    }

    public function testSubmitFormPriceEditWithInvalidData()
    {
        $crawler = $this->client->request('POST', "admin/tarifs");

        $form = $crawler->filter('input[type="submit"]')->form(array(
            'id' => 0,
            'price' => 'abc',
        ));

        $this->client->submit($form);


        $this->assertFalse($this->client->getResponse()->isRedirect('/admin/tarifs'));
    }

    /**
     * @return Client
     */
    protected function createAuthorizedClient()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $session = $container->get('session');
        /** @var $userManager \FOS\UserBundle\Doctrine\UserManager */
        $userManager = $container->get('fos_user.user_manager');
        /** @var $loginManager \FOS\UserBundle\Security\LoginManager */
        $loginManager = $container->get('fos_user.security.login_manager');
        $firewallName = $container->getParameter('fos_user.firewall_name');

        $user = $userManager->findUserBy(array('username' => 'tabodino'));
        $loginManager->loginUser($firewallName, $user);

        // save the login token into the session and put it in a cookie
        $container->get('session')->set('_security_' . $firewallName,
            serialize($container->get('security.token_storage')->getToken()));
        $container->get('session')->save();
        $client->getCookieJar()->set(new Cookie($session->getName(), $session->getId()));

        return $client;
    }
}