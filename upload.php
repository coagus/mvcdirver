<?php
   if(isset($_FILES['file_fotoperfil'])){
      $errors = array();
      $file_name = $_FILES['file_fotoperfil']['name'];
      $file_size = $_FILES['file_fotoperfil']['size'];
      $file_tmp = $_FILES['file_fotoperfil']['tmp_name'];
      $file_type = $_FILES['file_fotoperfil']['type'];
      $tmp = explode('.',$_FILES['file_fotoperfil']['name']);
      $file_ext = strtolower(end($tmp));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"img/fotopefil/ABC123".".".$file_ext);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>
<html>
   <body>
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="file_fotoperfil" />
         <input type="submit"/>
      </form>
      
   </body>
</html>