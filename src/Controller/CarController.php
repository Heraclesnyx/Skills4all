<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Car;
use App\Form\SearchType;
use App\Repository\CarRepository;
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
    public function index(Request $request,PaginatorInterface $paginator, CarRepository $carRepository): Response
    {
        
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        $pagination = $paginator->paginate(
            $form->isSubmitted() && $form->isValid() ? $carRepository->findWithSearch($search) : $carRepository->paginationQuery(),
            $request->query->get('page', 1),
            20
        );


        return $this->render('car/index.html.twig', [
            //'cars' => $car,
            'form' => $form->createView(),
            'pagination' => $pagination
        ]);
    }

}
