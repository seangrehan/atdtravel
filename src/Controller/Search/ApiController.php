<?php

namespace App\Controller\Search;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiController extends AbstractController
{
    public function __construct(private HttpClientInterface $client)
    {
    }

    public function fetchProducts(string $geo, string $title = '', int $offset = 0): array
    {
        $response = $this->client->request(
            'GET',
            'https://global.atdtravel.com/api/products',
            [
                'query' => [
                    'geo'    => $geo,
                    'title'  => $title,
                    'offset' => $offset,
                ],
            ],
        );

        $content = $response->getContent(false);
        $content = $response->toArray(false);

        return $content;
    }
}
