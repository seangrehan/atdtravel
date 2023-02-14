<?php

namespace App\Controller;

use App\Controller\Search\ApiController;
use App\Form\SearchFormType;
use App\Service\Pagination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    public function __construct(private ApiController $api)
    {
    }

    #[Route('/search', name: 'app_search')]
    public function index(Request $request, Pagination $pagination): Response
    {
        // fetch query params.
        $geo    = $request->query->get('geo') ?? 'en';
        $page   = (int) $request->query->get('page') ?? 1;
        $title  = $request->query->get('title') ?? '';
        $offset = ($page - 1) * 10;

        // get form
        $form = $this->createForm(SearchFormType::class);

        // make search api request.
        $products = $this->api->fetchProducts($geo, $title, $offset);

        // get totals
        $from        = $products['meta']['offset'] ?? 0;
        $to          = ($products['meta']['offset'] ?? 0) + ($products['meta']['count'] ?? 0);
        $total       = $products['meta']['total_count'] ?? 0;
        $limit       = $products['meta']['limit'] ?? 0;
        $currentPage = $from > 0 ? $to / $limit : 1;
        $totalPages  = $total > 0 ? ceil($total / $limit) : 0;

        $pagination = $pagination->paginate($currentPage, $totalPages);

        // render search page
        return $this->render('search/index.html.twig', [
            'form'       => $form,
            'products'   => $products['data'] ?? [],
            'from'       => $from ? $from + 1 : 0,
            'to'         => $to,
            'total'      => $total,
            'pagination' => $pagination,
        ]);
    }
}