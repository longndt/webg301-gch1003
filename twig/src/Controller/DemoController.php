<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
   #[Route('/demo1', name: 'd1')]
   public function demo1 () {
      return $this->render('demo/demo1.html.twig');
   }

   #[Route('/demo2', name: 'd2')]
   public function demo2 () {
      return $this->render('demo/demo2.html.twig');
   }

   #[Route('/demo3', name: 'demo3')]
   public function demo3 () {
      $city = 'Hanoi'; //string
      $year = 2022;    //integer
      $grade = 8.5;    //float
      $names = array("Hung", "Mai", "Linh", "Tuan"); //array
      return $this->render('demo/demo3.html.twig',
            [
               'city' => $city,
               'nam' => $year,
               'grade' => 8.5,
               'list' => $names,
               'age' => [18,20,35,40,27,23]
            ]);
   }
}
