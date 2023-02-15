<?php

namespace App\Tests\Utility;

use App\Tests\Mock\SearchApiMock;
use App\Utility\SearchApi;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class SearchApiTest extends WebTestCase
{
    // public function testSearchApi(): void
    // {
    //     $response = static::createClient()->request('GET', '/api/products');

    //     $this->assertResponseIsSuccessful();
    //     // $this->assertJsonContains(['@id' => '/']);
    // }

    // public function testSearchApi(): void
    // {
    //     $expected = [
    //         'meta' => [
    //             'count' => 10,
    //             'total_count' => 10,
    //             'limit' => 10,
    //             'offset' => 0,
    //             'sale_cur' => 'GBP'
    //         ],
    //         'data' => [
    //             [
                    
    //             ]
    //         ],
    //     ];

    //     $responses = ['/api/products' => new MockResponse(json_encode($expected))];

    //     $searchApi = new SearchApi(new SearchApiMock($responses));

    //     $actual = $searchApi->fetchProducts('en');

    //     $this->assertEquals($expected, $actual);
    // }
}
