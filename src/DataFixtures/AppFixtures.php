<?php

namespace App\DataFixtures;

use App\Entity\Cars;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create();
        //$cars = array();

        //create 20 voitures
        // for ($i=0; $i < 25 ; $i++) { 
        //     $cars[$i] = new Cars();
        //     $cars[$i]->setName($faker->name);
        //     $cars[$i]->setPrice($faker->mt_rand(10, 100));
        //     $manager->persist($cars[$i]);
        // }

        $cars = new Cars();
        $cars->setName('cars ');
        $cars->setPrice(mt_rand(10, 100));
        
        $manager->persist($cars);
        $manager->flush();
    }
}
