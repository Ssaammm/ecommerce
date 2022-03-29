<?php

namespace App\DataFixtures;

use App\Entity\Category;
use app\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        //créer 3 catégorie fake
        for ($i=1; $i <= 3 ; $i++) { 
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());

            $manager->persist($category);            
        
            for ($j=1; $j <=10 ; $j++) { 
                $article = new Article();
                $article->setTitle($faker->sentence())
                $article->setContent()
            }
        }





        $manager->flush();
    }
}
