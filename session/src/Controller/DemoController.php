<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemoController extends AbstractController
{
    public function __construct()
    {
        $this->session = new Session();
    }

    #[Route('/demo1', name: 'demo1')]
    public function demo1()
    {
        $c = $this->session->get('cities');
        return $this->render('demo/demo1.html.twig');
    }

    #[Route('/demo2', name: 'demo2')]
    public function demo2()
    {
        $abc = $this->session->get('web');
        return $this->render('demo/demo2.html.twig');
    }

    #[Route('/demo3', name: 'demo3')]
    public function demo3()
    {
        $cities = array(
            'Hanoi', 'HCM City', 'Da Nang'
        );
        $this->session->set('cities', $cities);
        return $this->render('demo/demo3.html.twig');
    }
}
