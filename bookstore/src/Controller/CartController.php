<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'add_to_cart')]
    public function addToCart() 
    {
        //render ra view 
        return $this->render('cart/cart.html.twig');
    }

    #[Route('/order', name: 'make_order')]
    public function makeOrder(Request $request) 
    {
        //lưu vào DB
  
        return $this->render('cart/order.html.twig');
    }
}
