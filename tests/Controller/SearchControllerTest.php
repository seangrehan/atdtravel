<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SearchControllerTest extends WebTestCase
{
    public function testHasTitle(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/search');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Product Search');
    }

    public function testHasTableWithColumns(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/search');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('thead', 'Image');
        $this->assertSelectorTextContains('thead', 'Title');
        $this->assertSelectorTextContains('thead', 'Destination');
    }

    // public function test
}
