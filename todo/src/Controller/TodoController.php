<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TodoController extends AbstractController
{
   #[Route('/todo/viewall', name: 'view_all_todos')]
   public function TodoIndex(TodoRepository $todoRepository, ManagerRegistry $managerRegistry) {
      //lấy dữ liệu từ bảng Todo trong DB
        //Cách 1
        //$todos = $todoRepository->findAll();
        //Cách 2
        //$todos = $this->getDoctrine()->getRepository(Todo::class)->findAll();
        //Cách 3
        $todos = $managerRegistry->getRepository(Todo::class)->findAll();
      //render ra view và gửi kèm dữ liệu 
        return $this->render("todo/index.html.twig",
            [
                'todos' => $todos
            ]);
   }
}
