<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpClient\Response\ResponseStream;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
   //import thư viện SerializerInterface để convert dữ liệu thành API
   public $serializerInterface;

   public function __construct(SerializerInterface $serializerInterface) {
     $this->serializerInterface = $serializerInterface;
   }
    
   //SQL: SELECT * FROM Blog
   #[Route('/blog', methods: 'GET', name: 'view_all_blog_api')]
   public function viewAllBlog (BlogRepository $blogRepository, ManagerRegistry $managerRegistry) {
   //Bước 1: lấy dữ liệu từ bảng trong DB và lưu vào array
     //Cách 1: gọi thẳng đến hàm findAll() trong file class BlogRepository
     //Note: cần import BlogRepository
     //$blogs = $blogRepository->findAll();
     //Cách 2: gọi hàm findAll() thông qua getDoctrine() và getRepository()
     //Note: không cần import gì cả
     //$blogs = $this->getDoctrine()->getRepository(Blog::class)->findAll();
     //Cách 3: sử dụng ManagerRegistry
     //Note: cần import ManagerRegistry
     $blogs = $managerRegistry->getRepository(Blog::class)->findAll();
   //Bước 2: chuyển array thành API (1 trong 2 format: JSON hoặc XML)
     $api = $this->serializerInterface->serialize($blogs,"json");
   //Bước 3: trả về api cho client thông qua response
     return new Response($api);
   }
}
