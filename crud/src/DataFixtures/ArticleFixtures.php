<?php

namespace App\DataFixtures;

use App\Entity\Article;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=50; $i++) {
            $article = new Article;
            $article->setAuthor("Greenwich");
            $article->setTitle("My article $i");
            $article->setLength(rand(10,99));
            $article->setDate(DateTime::createFromFormat("Y/m/d","2022/07/15"));
            $manager->persist($article);
        }

        $manager->flush();
    }
}
