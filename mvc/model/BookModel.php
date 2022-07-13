<?php 
//include_once "Book.php";
require_once "Book.php";

//tạo class BookModel với 2 function tương ứng
//cho 2 chức năng: xem tất cả Book và xem Book theo title
class BookModel {
   //tạo function để load dữ liệu của Book từ Array có sẵn
   //Note: Array dùng để giả lập dữ liệu từ bảng trong DB
   public function ViewAllBook () {
      $bookList = array (
         "Java" => new Book("Java", "David", 77.77, 
             "https://www.devpro.edu.vn/uploads/news/1621645175.jpg"),
         "Python" => new Book("Python", "Michael", 88.88, 
             "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f8/Python_logo_and_wordmark.svg/1200px-Python_logo_and_wordmark.svg.png"),
         "PHP" => new Book("PHP", "John", 99.99, 
             "https://cafedev.vn/wp-content/uploads/2020/08/cafedev_tuhoc_php.png")
         //Note: dùng title của Book làm index của từng phần tử trong array
      );
      return $bookList;
   }

   //tạo function để show thông tin của Book tương ứng theo title mà người dùng chọn
   public function ViewBookByTitle ($title) {
      $books = $this->ViewAllBook();
      return $books[$title];
   }
}
?>