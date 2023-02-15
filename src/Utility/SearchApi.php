<?php

namespace App\Utility;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SearchApi extends AbstractController
{
    public function __construct(private HttpClientInterface $searchApiClient)
    {
    }

    public function fetchProducts(string $geo, string $title = '', int $offset = 0): array
    {
        $response = $this->searchApiClient->request(
            'GET',
            '/api/products',
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
