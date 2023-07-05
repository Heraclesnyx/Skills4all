<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Cars;
use App\Form\SearchType;
use App\Repository\CarsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }


    #[Route('/', name: 'voitures')]
    public function index(Request $request,PaginatorInterface $paginator, CarsRepository $carsRepository): Response
    {
        
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $cars = $this->entityManager->getRepository(Cars::class)->findWithSearch($search);
        }else{
            $cars = $this->entityManager->getRepository(Cars::class)->findAll();
        }

        

        $pagination = $paginator->paginate(
            $carsRepository->paginationQuery(),
            $request->query->get('page', 1),
            20
        );

        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView(),
            'pagination' => $pagination
        ]);
    }

    /*#[Route('/', name: 'pagination')]
    public function pagination(Request $request, PaginatorInterface $paginator, CarsRepository $carsRepository): Response
    {
        $pagination = $paginator->paginate(
            $carsRepository->paginationQuery(),
            $request->query->get('page', 1),
            20
        );

        return $this->render('car/index.html.twig', [
            'pagination' => $pagination
        ]);
    }*/
}
