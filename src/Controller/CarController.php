<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Cars;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(Request $request): Response
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

        return $this->render('car/index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView()
        ]);
    }
}
