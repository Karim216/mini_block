<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        $users = [];
        for ($i=0; $i < 50; $i++) { 
            # code...
            $user = new User();
            $user->setUsername($faker->name);
            $user->setFirstname($faker->firstname);
            $user->setLastname($faker->lastname);
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $user->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($user);

            $users[] = $user;
        }

        $categories = [];

        for ($i=0; $i < 15; $i++) { 
            # code...
            $category = new Category();

            $category->setTitle($faker->text(50));
            $category->setDescription($faker->text(250));
            $category->setImage($faker->imageUrl());
            $manager->persist($category);

            $categories[] = $category;
        }

        // $articles = [];

        for ($i=0; $i < 100; $i++) { 
            # code...
            $article = new Article();

            $article->setTitle($faker->text(50));
            $article->setContent($faker->text(250));
            $article->setImage($faker->imageUrl());
            $article->setCreatedAt(new \DateTimeImmutable());
            $article->addCategory($categories[$faker->numberBetween(0, 14)]);
            $article->setAuthor($users[$faker->numberBetween(0, 49)]);
            $manager->persist($article);

            // $articles[] = $article;
        }
        $manager->flush();
    }
}