<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Book List</title>
   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
   <style>
      th {
         color: red;
      }
      td {
         color: blue;
      }
      img {
         border-radius: 50%;
      }
   </style>
</head>
<body>
<div class="container col-md-5 text-center mt-4">
   <h1 class="text text-primary">Book List</h1>
   <table class="table table-success">
      <thead>
         <tr>
            <th>Book Title</th>
            <th>Book Image</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
         <?php 
            foreach ($books as $book) {
         ?>
            <tr>
               <td> <?= $book->title; ?> </td>
               <td> 
                  <a href="index.php?book=<?= $book->title; ?> ">
                     <img src="<?= $book->image; ?>" width="100" height="100">   
                  </a>
               </td>
               <td>
                  <a class="btn btn-success" href="index.php?book=<?= $book->title; ?> ">
                     Detail
                  </a>
               </td>
            </tr>
         <?php
            }
         ?> 
      </tbody>
   </table>
</div>
</body>
</html>