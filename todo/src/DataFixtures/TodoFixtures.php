<?php

namespace App\DataFixtures;

use App\Entity\Todo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TodoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $todo = new Todo;
            $todo->setTitle("Todo $i");
            $todo->setCategory("Personal");
            $todo->setContent("This is my Todo content");
            $todo->setImage("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmr13jfFAO6CM78lHRW2uvFpv_1O4DIdXtZA&usqp=CAU");
            $todo->setDate(\DateTime::createFromFormat("Y/m/d","2022/07/27"));
            $manager->persist($todo);
        }

        $manager->flush();
    }
}
