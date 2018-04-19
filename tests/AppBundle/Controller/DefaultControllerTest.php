<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    private function logIn()
    {
        $this->setUp();
        $session = $this->client->getContainer()->get('session');

        // the firewall context (defaults to the firewall name)
        $firewall = 'main';

        $token = new UsernamePasswordToken('admin', null, $firewall, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    public function testLogin()
    {
        $this->setUp();
        $crawler = $this->client->request('GET', '/login');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Authentification', $crawler->filter('h2')->text());
    }

    public function testListEmployees()
    {
        $this->setUp();
        $this->logIn();
        $crawler = $this->client->request('GET', '/list');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('h2:contains("Liste des employés")')->count());
    }

    public function testAddEmployee()
    {
        $this->setUp();
        $this->logIn();
        $crawler = $this->client->request('GET', '/add');

        $form = $crawler->selectButton('Ajouter')->form();

        // set some values
        $form['appbundle_employee[lastname]'] = 'Lastname';
        $form['appbundle_employee[firstname]'] = 'Firstname';
        $form['appbundle_employee[age]'] = 25;
        $form['appbundle_employee[job]'] = 'Job';
        $form['appbundle_employee[phone]'] = '0670689578';
        $form['appbundle_employee[dateDebut][day]'] = '01';
        $form['appbundle_employee[dateDebut][month]'] = '01';
        $form['appbundle_employee[dateDebut][year]'] = '2013';
        $form['appbundle_employee[dateFin][day]'] = '01';
        $form['appbundle_employee[dateFin][month]'] = '01';
        $form['appbundle_employee[dateFin][year]'] = '2020';
        $form['appbundle_employee[environment][building]'] = 'Bâtiment';
        $form['appbundle_employee[environment][postalCode]'] = 22000;
        $form['appbundle_employee[environment][deskroom]'] = 'Bureau';
        // submit the form
        $crawler = $this->client->submit($form);
        
        if ($this->client->getResponse()->isRedirection()) {
            $this->client->followRedirect();
        }
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }
}
