<?php

namespace App\Controller;

use App\Entity\Note;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends AbstractController
{
   //Cách 1: tạo form ngay trong Controller sử dụng hàm createFormBuilder (not recommmended)
   #[Route('/add', name: 'add_new_note')]
   public function addNewNote(Request $request) {
    //tạo object $note để chứa thông tin nhập vào form
    $note = new Note;
    //tạo form để nhập liệu
    $form = $this->createFormBuilder($note)
                 ->add('content', TextType::class)
                 ->add('date', DateType::class,
                 [
                    'widget' => 'single_text'
                 ])
                 ->add('Add', SubmitType::class)
                 ->getForm();
    //handle request gửi từ form
    $form->handleRequest($request);
    //check xem form đã được submit hay chưa & dữ liệu trong form có hợp lệ không (đã được validate chưa)
    if ($form->isSubmitted() && $form->isValid()) {
        //lấy dữ liệu từ form & lưu vào biến $data
        $data = $form->getData();
        //tạo biến để lưu từng thông tin riêng biệt trong form
        $content = $data->content;
        $date = $data->date->format('Y-m-d');
        //cách 1: render ra trang success để show thông tin vừa nhập
        return $this->render('note/success.html.twig',
        [
            'content' => $content,
            'date' => $date
        ]);
    }
    //mặc định hàm này sẽ render ra form để người dùng nhập lúc đầu hoặc nhập lại nếu nhập sai
    //cách 1: dùng hàm createView()
    return $this->render('note/add.html.twig',
        [
            'noteForm' => $form->createView()
        ]);
   }

   //Cách 2: tạo form ở class ngoài và gọi đến trong Controller sử dụng hàm createForm (recommended)
   #[Route('/create', name: 'create_new_note')]
   public function createNewNote() {

   }
}
