<?php
/**
 * Created by PhpStorm.
 * User: jm
 * Date: 09/06/16
 * Time: 14:34
 */

namespace tests\BackBundle\Functionnal\Controller;


use FOS\UserBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;


class AdminControllerTest extends WebTestCase
{
    protected $client = null;


    public function setUp()
    {
        $this->client = $this->createAuthorizedClient();
    }

    public function testAdminPageAfterLoginIsStatus200()
    {

        $crawler = $this->client->request('GET', '/admin/');
        
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $title = $crawler->filter('h3')->text();

        $responseCode = $this->client->getResponse()->getStatusCode();

        $this->assertEquals('Tableau de bord', $title);

        $this->assertEquals(200, $responseCode);
    }

    public function testAdminProfilPageAfterLoginIsStatus200()
    {

        $crawler = $this->client->request('GET', '/admin/profil/');

        $responseCode = $this->client->getResponse()->getStatusCode();

        $this->assertEquals(1, $crawler->filter('h2:contains("Profil")')->count());

        $this->assertEquals(200, $responseCode);
    }

    public function testAdminPricelistPageAfterLoginIsStatus200()
    {
        $crawler = $this->client->request('GET', '/admin/tarifs');

        $responseCode = $this->client->getResponse()->getStatusCode();

        $this->assertGreaterThanOrEqual(1, $crawler->filter('html:contains("LISTE DES TARIFS")')->count());

        $this->assertEquals(200, $responseCode);
    }

    public function testAdminUsersPageAfterLoginIsStatus200()
    {
        $crawler = $this->client->request('GET', '/admin/utilisateurs/');

        $responseCode = $this->client->getResponse()->getStatusCode();

        $this->assertGreaterThanOrEqual(1, $crawler->filter('html:contains("Liste des utilisateurs")')->count());

        $this->assertEquals(200, $responseCode);
    }

    public function testAdminStatsPageAfterLoginIsStatus200()
    {
        $crawler = $this->client->request('GET', '/admin/statistiques');

        $responseCode = $this->client->getResponse()->getStatusCode();

        $this->assertGreaterThanOrEqual(1, $crawler->filter('html:contains("Statistiques")')->count());

        $this->assertEquals(200, $responseCode);
    }

    public function testAdminCalendarPageAfterLoginIsStatus200()
    {
        $crawler = $this->client->request('GET', '/admin/calendrier');

        $responseCode = $this->client->getResponse()->getStatusCode();

        $this->assertGreaterThanOrEqual(1, $crawler->filter('html:contains("Calendrier")')->count());

        $this->assertEquals(200, $responseCode);
    }

    public function testAdminHelpPageAfterLoginIsStatus200()
    {
        $crawler = $this->client->request('GET', '/admin/aide');

        $responseCode = $this->client->getResponse()->getStatusCode();

        $this->assertGreaterThanOrEqual(1, $crawler->filter('html:contains("Aide")')->count());

        $this->assertEquals(200, $responseCode);
    }

    public function testAdminAddUserPageAfterLoginIsStatus200()
    {
        $crawler = $this->client->request('GET', '/admin/utilisateur/ajout');

        $responseCode = $this->client->getResponse()->getStatusCode();

        $this->assertGreaterThanOrEqual(1, $crawler->filter('html:contains("Ajouter un utilisateur")')->count());

        $this->assertEquals(200, $responseCode);
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