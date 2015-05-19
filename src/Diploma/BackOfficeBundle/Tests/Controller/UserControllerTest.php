<?php

namespace Diploma\BackOfficeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testRights()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'post/');

        $this->assertFalse($crawler->filter('html:contains("Редактировать")')->count() > 0);
        $this->assertFalse($crawler->filter('html:contains("Код")')->count() > 0);
        $this->assertFalse($crawler->filter('html:contains("Тэги")')->count() > 0);
        $this->assertFalse($crawler->filter('html:contains("Тесты")')->count() > 0);
        $this->assertFalse($crawler->filter('html:contains("Задания")')->count() > 0);
    }

    public function testAnonimous()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'post/');

        $this->assertTrue($crawler->filter('html:contains("Анонимус")')->count() > 0);
    }

    public function testProfile()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'post/');

        $this->assertFalse($crawler->filter('html:contains("Редактировать профиль")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Войти")')->count() > 0);
    }

    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Вход')->form();

        $form['_username'] = 'admin';
        $form['_password'] = 'test';

        $crawler = $client->submit($form);

        $crawler = $client->request('GET', 'post/');
        $this->assertTrue($crawler->filter('html:contains("admin")')->count() > 0);

    }
}
