<?php

namespace Diploma\BackOfficeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'post/1/show');

        $this->assertTrue($crawler->filter('html:contains("Test")')->count() > 0);
    }
}
