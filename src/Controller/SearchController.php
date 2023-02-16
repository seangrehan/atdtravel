<?php

namespace App\Controller;

use App\Form\SearchFormType;
use App\Service\Pagination;
use App\Utility\SearchApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    public function __construct(private SearchApi $searchApi)
    {
    }

    #[Route('/search', name: 'app_search')]
    public function index(Request $request, Pagination $pagination): Response
    {
        // fetch query params.
        $geo    = $request->query->get('geo') ?? 'en';
        $title  = $request->query->get('title') ?? '';
        $page   = (int) $request->query->get('page') ?? 1;
        $offset = ($page * 10) - 10;

        // get form
        $form = $this->createForm(SearchFormType::class);

        // make search api request.
        $products = $this->searchApi->fetchProducts($geo, $title, $offset);

        // get totals
        $from        = $products['meta']['offset'] ?? 0;
        $to          = $from + ($products['meta']['count'] ?? 0);
        $total       = $products['meta']['total_count'] ?? 0;
        $limit       = $products['meta']['limit'] ?? 0;
        $totalPages  = $total > 0 ? ceil($total / $limit) : 0;

        $pagination = $pagination->paginate($page, $totalPages);

        // render search page
        return $this->render('search/index.html.twig', [
            'form'       => $form,
            'products'   => $products['data'] ?? [],
            'from'       => $from ? $from + 1 : 1,
            'to'         => $to,
            'total'      => $total,
            'pagination' => $pagination,
        ]);
    }
}
