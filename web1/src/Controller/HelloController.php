<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/greenwich', name: 'gw')]
    public function greenwich()
    {
        return $this->render('hello/greenwich.html.twig');
    }

    #[Route('/', name: 'home')]
    public function hn()  
    {
        return $this->render('hello/hanoi.html.twig');
    }
}
