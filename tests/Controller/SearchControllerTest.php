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
        $this->assertSelectorTextContains('table', 'Image');
        $this->assertSelectorTextContains('table', 'Title');
        $this->assertSelectorTextContains('table', 'Destination');
    }
}
