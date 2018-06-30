<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileTest extends WebTestCase
{
    public function test_it_loads_a_profile_for_username()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/profile/testuser');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('h1:contains("Hello testuser!")')->count());
        $this->assertSame(1, $crawler->filter('.test:contains("This is big test")')->count());
    }
}
