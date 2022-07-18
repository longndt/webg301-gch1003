<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Blog;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BlogFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $blog = new Blog;
            $blog->setTitle("Blog No. $i");
            $blog->setContent("This is my new blog");
            $blog->setDate(DateTime::createFromFormat("Y/m/d","2022/06/08"));
            $manager->persist($blog);
        }

        $manager->flush();
    }
}
