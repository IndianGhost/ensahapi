<?php

namespace EnsahBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ActualiteControllerTest extends WebTestCase
{
    public function testActualite()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/actualite');
    }

}
