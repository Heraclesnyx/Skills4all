<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\CarRepository;
use App\Service\CallApiService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{

    #[Route('/', name: 'voitures')]
    public function index(Request $request,PaginatorInterface $paginator, CarRepository $repository): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        $pagination = $paginator->paginate(
            $form->isSubmitted() && $form->isValid() ? $repository->findWithSearch($form->getData()) : $repository->paginationQuery(), /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            $request->query->getInt('limit', 20), /* limit per page */
        );

        // parameters to template
        return $this->render('car/index.html.twig', [
            'form' => $form->createView(),
            'pagination' => $pagination
        ]);
    }
}
