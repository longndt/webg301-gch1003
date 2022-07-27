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
            $todo->setImage("https://w7.pngwing.com/pngs/972/511/png-transparent-todo-sketch-note-list-tasks-thumbnail.png");
            $todo->setDate(\DateTime::createFromFormat("Y/m/d","2022/07/27"));
            $manager->persist($todo);
        }

        $manager->flush();
    }
}
