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

    public function testHasSearchBar(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/search');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('form', 'Title');
        $this->assertSelectorTextContains('form', 'Search');
    }

    public function testHasTotal(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/search');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('section', 'Showing 1 to 10 of 10 products.');
    }

    public function testNoResults(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/search?title=test');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('section', 'Found 0 products.');
    }
}
