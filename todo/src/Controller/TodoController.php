<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/todo')]
class TodoController extends AbstractController
{
   #[Route('/viewall', name: 'view_all_todos')]
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

   #[Route('/detail/{id}', name: 'view_todo_by_id')]
   public function TodoDetail ($id) {
      $todo = $this->getDoctrine()->getRepository(Todo::class)->find($id);
      //check xem id có tồn tại không => $todo có khác null không
      if ($todo != null) {
        return $this->render("todo/detail.html.twig",
        [
          'todo' => $todo
        ]);
      } else { //$todo = null
        //gửi message lỗi về phía front-end (view - client side)
        $this->addFlash("Error","Todo not found !");
        //chuyển về trang todo list
        return $this->redirectToRoute("view_all_todos");
      }     
   }

   #[Route('/delete/{id}', name: 'delete_todo')]
   public function TodoDelete ($id, ManagerRegistry $managerRegistry) {
     $todo = $managerRegistry->getRepository(Todo::class)->find($id);
     if ($todo == null) {
       $this->addFlash("Error","Todo not found !");
     } else {  // $todo != null
       $manager = $managerRegistry->getManager();
       $manager->remove($todo);
       $manager->flush();
       $this->addFlash('Success','Delete todo succeed');  
     }
     return $this->redirectToRoute("view_all_todos");
   }
}
