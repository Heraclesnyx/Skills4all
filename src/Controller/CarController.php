<?php

namespace App\Controller;

use App\Entity\Cars;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }


    #[Route('/', name: 'voitures')]
    public function index(): Response
    {
        $cars = $this->entityManager->getRepository(Cars::class)->findAll();
        //dd($cars);

        return $this->render('car/index.html.twig', [
            'cars' =>$cars
        ]);
    }
}
