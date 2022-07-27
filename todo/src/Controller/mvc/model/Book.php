<?php 
//tạo class Book tương ứng với design của bảng Book trong DB
class Book {
   //thuộc tính (attribute) tương ứng với từng cột trong bảng
   public $title;
   public $author;
   public $price;
   public $image;

   //hàm tạo (constructor) có các tham số tương ứng với từng thuộc tính
   //sử dụng constructor để tạo object cho class
   public function __construct($t, $a, $p, $i)
   {
      $this->title = $t;
      $this->author = $a;
      $this->price = $p;
      $this->image = $i;
   }
}
?>