<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        //create 100 voitures
        for ($i=0; $i < 100 ; $i++) { 
            $car = new Car();
            $car->setName($faker->name);
            $car->setPrice($faker->mt_rand(10, 12));
            $manager->persist($car);
        }
        
        //$manager->persist($car);
        $manager->flush();
    }
}
