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
}
