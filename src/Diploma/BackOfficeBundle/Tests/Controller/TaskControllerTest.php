<?php

namespace Diploma\BackOfficeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testTask()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'post/');
    }
}
