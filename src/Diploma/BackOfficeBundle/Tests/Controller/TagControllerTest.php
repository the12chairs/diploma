<?php

namespace Diploma\BackOfficeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TagControllerTest extends WebTestCase
{
    public function testTag()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'tag/');

        $sum = 0;
        $sum += $crawler->filter('html:contains("Вычмат")')->count();
        $sum += $crawler->filter('html:contains("СЛАУ")')->count();
        $sum += $crawler->filter('html:contains("Матрицы")')->count();
        $sum += $crawler->filter('html:contains("Диффуры")')->count();
        $this->assertTrue($sum == 4);
    }
}
