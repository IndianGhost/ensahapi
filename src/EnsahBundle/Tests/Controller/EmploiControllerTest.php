<?php

namespace EnsahBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmploiControllerTest extends WebTestCase
{
    public function testEmploistemps()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'emplois-temps');
    }

}
