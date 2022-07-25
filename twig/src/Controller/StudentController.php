<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
   #[Route('/student', name: 'view_student')]
   public function viewStudent() {
     $student = new Student(null,null,null,null,null,null);
     $student->setName('Nguyen Van Nam');
     $student->setAddress('Ha Noi');
     $student->setMobile("0912345678");
     $student->setEmail("nam@fpt.edu.vn");
     $student->setGrade(7.8);
     $student->setAge(20);
     return $this->render('student/view.html.twig',
     [
        'student' => $student
     ]);
   }

   #[Route("/students", name: 'view_student_list')]
   public function viewStudentList() {
      $s1 = new Student("Nam",20,"Hanoi","0912345678","nam@gmail.com", 7.5);   
      $s2 = new Student("Minh",21,"Hanoi","0912345678","minh@gmail.com", 8.5);  
      $s3 = new Student("Tuan",22,"Hanoi","0912345678","tuan@gmail.com", 9.5); 
      $students = array($s1,$s2,$s3); 
      return $this->render('student/list.html.twig',
      [
         'students' => $students
      ]);
   }
}
