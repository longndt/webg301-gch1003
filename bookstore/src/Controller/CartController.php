<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'add_to_cart')]
    public function addToCart(Request $request) 
    {
        $session = $request->getSession();
        $id = $request->get('bookid');
        $book = $this->getDoctrine()->getRepository(Book::class)->find($id);
        $session->set('book', $book);
        $session->set('quantity', $request->get('quantity'));
        $date = date('Y/m/d');  //get current date
        $session->set('date', $date);
        return $this->render('cart/cart.html.twig');
    }

    #[Route('/order', name: 'make_order')]
    public function makeOrder(Request $request) 
    {
        //lưu vào DB
  
        return $this->render('cart/order.html.twig');
    }
}
