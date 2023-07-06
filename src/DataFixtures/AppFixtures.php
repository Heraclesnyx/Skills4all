<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Category;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Create 10 categories.
        for ($i=0; $i < 10 ; $i++) {
                $category = new Category();
                $category->setName($faker->name);
                $manager->persist($category);
            }
        
            $manager->flush();
        
        /** @var Category[] $categories */
        $categories = $manager->getRepository(Category::class)->findAll();

        //create 100 voitures
        for ($i=0; $i < 100 ; $i++) { 
            $car = new Car();

            $car
                ->setName($faker->name)
                ->setPrice($faker->randomNumber(3))
                ->setCategory($categories[mt_rand(0,9)]);
            
            $manager->persist($car);
        }
        
        $manager->flush();

    }
}
