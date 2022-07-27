<?php
require_once "model/BookModel.php";

//tạo file controller để xử lý logic của hệ thống
//2 nhiệm vụ chính của controller: lấy dữ liệu từ DB (model)
//và render ra view (UI) 
class BookController {
   public $model;

   public function __construct()
   {
      $this->model = new BookModel;
   }

   //tạo function để xử lý request từ client 
   public function handle () {
      //TH1: render ra trang BookList.php (homepage) nếu đường dẫn url không có tham số của book title
      //Note: người dùng chưa click vào title của book nào cả
      //ex: localhost/mvc/index.php
      if (!isset($_GET['book'])) {
         //lấy dữ liệu từ model
         $books = $this->model->ViewAllBook();
         //render ra view
         require_once "view/BookList.php";
      }
   
      //TH2: render ra trang BookDetail.php nếu đường dẫn url có chứa tham số của book title
      //Note: người dùng đã click vào title của 1 book
      //ex: localhost/mvc/index.php?book=Java
      else {
         //lấy dữ liệu từ model
         $book = $this->model->ViewBookByTitle($_GET['book']);
         //render ra view
         require_once "view/BookDetail.php";
      }
   }
}
?>