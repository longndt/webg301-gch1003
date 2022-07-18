<?php

namespace App\DataFixtures;

use App\Entity\Laptop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LaptopFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=10; $i<=20; $i++) {
            $laptop = new Laptop;
            $laptop->setName("Laptop $i");
            $laptop->setQuantity(rand(10,50));
            $laptop->setPrice((float)(rand(1000,1500)));
            $laptop->setBestseller(true);
            $laptop->setImage("https://cdn.nguyenkimmall.com/images/detailed/758/10050190-laptop-hp-240-g8-i3-1005g1-519a7pa-01.jpg");
            $manager->persist($laptop);
        }
        $manager->flush();
    }
}
