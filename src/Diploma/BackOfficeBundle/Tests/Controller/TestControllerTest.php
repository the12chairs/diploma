<?php

namespace Diploma\BackOfficeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestControllerTest extends WebTestCase
{
    public function testResults()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'test/1/run');

        $form = $crawler->selectButton('Проверить себя')->form();

        $crawler = $client->submit($form);

        $this->assertTrue($crawler->filter('html:contains("Ваш результат: 0")')->count() > 0);
    }
}
