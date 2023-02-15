<?php

namespace App\Tests\Mock;

use App\Tests\Faker\Products;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Component\HttpFoundation\Response;

final class SearchApiMock extends MockHttpClient
{
    private string $baseUri = 'https://global.atdtravel.com';

    public function __construct()
    {
        $callback = \Closure::fromCallable([$this, 'handleRequests']);

        parent::__construct($callback, $this->baseUri);
    }

    private function handleRequests(string $method, string $url): MockResponse
    {
        $faker = \Faker\Factory::create();

        if ($method === 'GET' && str_starts_with($url, $this->baseUri.'/api/products')) {
            if (str_contains($url, 'title=test')) {
                return $this->getEmptyApiProductsMock($faker);
            }

            return $this->getApiProductsMock($faker);
        }

        throw new \UnexpectedValueException("Mock not implemented: $method/$url");
    }

    /**
     * "/api/products" endpoint.
     */
    private function getApiProductsMock(\Faker\Generator $faker): MockResponse
    {
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'id' => $faker->randomNumber(5, true),
                'title' => $faker->words(3, true),
                'dest' => 'London',
                'img_sml' => 'https:\/\/global.atdtravel.com\/sites\/default\/files\/imagecache\/atd_list_thumb\/ticket_description\/go_london_explorer_pass\/146.jpg',
            ];
        }

        $mock = [
            'meta' => [
                'count' => 10,
                'total_count' => 10,
                'limit' => 10,
                'offset' => 0,
                'sale_cur' => 'GBP',
            ],
            'data' => $data,
        ];

        return new MockResponse(
            json_encode($mock, JSON_THROW_ON_ERROR),
            ['http_code' => Response::HTTP_OK]
        );
    }

    private function getEmptyApiProductsMock(\Faker\Generator $faker): MockResponse
    {
        $mock = [['err_desc' => 'No products found.']];

        return new MockResponse(
            json_encode($mock, JSON_THROW_ON_ERROR),
            ['http_code' => Response::HTTP_OK]
        );
    }

}
