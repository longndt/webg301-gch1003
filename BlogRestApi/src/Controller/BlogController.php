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
use Symfony\Component\HttpFoundation\Request;

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
    //check xem biến $blogs có null hay không (bảng có dữ liệu hay không)
    if ($blogs != null) {
        //Bước 2: chuyển array thành API (1 trong 2 format: JSON hoặc XML)
        $api = $this->serializerInterface->serialize($blogs, "xml");
           //Bước 3: trả về api cho client thông qua response
      //response bao gồm: data (api : json hoặc xml), code (200, 201, 202,...), type (json, xml, html,...)
        return new Response($api, Response::HTTP_OK, //code: 200
            [
              'content-type' => 'application/xml'
            ]);
    } else {  //$blog == null
        return new Response(
            null,
            Response::HTTP_NO_CONTENT,
            [
              'content-type' => 'text/html'
            ]
        );
    }
}
     //SQL: SELECT * FROM Blog WHERE id = 'id'
     #[Route('/blog/view/{id}', methods: 'GET', name: 'view_blog_by_id_api')]
     public function viewBlogById ($id, BlogRepository $blogRepository, ManagerRegistry $managerRegistry) {
      //B1: lấy dữ liệu của blog từ DB theo id
        $blog1 = $blogRepository->find($id);
        $blog2 = $this->getDoctrine()->getRepository(Blog::class)->find($id);
        $blog3 = $managerRegistry->getRepository(Blog::class)->find($id);
      //check blog id có tồn tại hay không
      if ($blog1 == null) {
        $error = "Blog id not found";
        return new Response($error, Response::HTTP_NOT_FOUND); //status = 404
      } else {
        //B2: convert dữ liệu sang api
        $data = $this->serializerInterface->serialize($blog2, "json");
        //B3: response api cho client
        return new Response($data, 200, 
                          [
                              'content-type' => 'application/json'
                          ]);
    }
}
     //SQL: DELETE FROM Blog WHERE id = 'id'
     #[Route('/blog/delete/{id}', methods: 'DELETE', name: 'delete_blog_api')]
     public function removeBlog ($id, BlogRepository $blogRepository, ManagerRegistry $managerRegistry) {
       $blog = $blogRepository->find($id);
       if ($blog == null) {
          return new Response("Blog not found => Can not delete", Response::HTTP_BAD_REQUEST); //code: 400
       }
       else {
          //gọi ra entity (object manager)
          //$manager = $this->getDoctrine()->getManager();  
          $manager = $managerRegistry->getManager();
          //thực hiện lệnh xóa remove bằng manager
          $manager->remove($blog);
          //luôn luôn flush ở cuối cùng
          $manager->flush();
          return new Response(null, Response::HTTP_NO_CONTENT);  //code: 204
       }
     }

     //SQL: INSERT INTO Blog (....) VALUES (....)
     #[Route('/blog/add', methods: 'POST', name: 'add_blog_api')]
     public function addBlog (Request $request) {
        //B1: tạo mới 1 object $blog để lưu dữ liệu gửi từ client
        $blog = new Blog;
        //B2: dùng hàm json_decode để giải mã dữ liệu gửi từ client theo format JSON
        $data = json_decode($request->getContent(),true);
        //B3: set dữ liệu vào từng thuộc tính của object $blog
        $blog->setTitle($data['title']);
        $blog->setContent($data['content']);
        $blog->setDate(\DateTime::createFromFormat('Y-m-d',$data['date']));
        //B4: lưu dữ liệu của $blog vào DB thông qua manager
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($blog);
        $manager->flush();
        //B5: trả về response
        return new Response("Add blog succeed", Response::HTTP_CREATED); //code: 201
     }

     //SQL: UPDATE Blog SET .... WHERE id = 'id'
     #[Route('/blog/edit/{id}', methods: 'PUT', name: 'update_blog_api')]
     public function editBlog ($id, Request $request) {
          //B1: lấy dữ liệu của $blog theo id
          $blog = $this->getDoctrine()->getRepository(Blog::class)->find($id);
          if ($blog == null) {
            return new Response("Blog not found => Can not update", Response::HTTP_BAD_REQUEST); //code: 400
           }
          else {
            //B2: dùng hàm json_decode để giải mã dữ liệu gửi từ client theo format JSON
            $data = json_decode($request->getContent(),true);
            //B3: set dữ liệu vào từng thuộc tính của object $blog
            $blog->setTitle($data['title']);
            $blog->setContent($data['content']);
            $blog->setDate(\DateTime::createFromFormat('Y-m-d',$data['date']));
            //B4: lưu dữ liệu của $blog vào DB thông qua manager
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($blog);
            $manager->flush();
            //B5: trả về response
            return new Response("Update blog succeed", Response::HTTP_ACCEPTED); //code: 202
           }   
     }
}
