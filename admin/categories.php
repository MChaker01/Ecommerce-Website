<?php

include '../CommonElements/connect.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:admin_login.php');
};

if(isset($_POST['add_categorie']))
{
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_categories = $conn->prepare("SELECT * FROM `categories` WHERE categ_name = ?");
   $select_categories->execute([$name]);


   if($select_categories->rowCount() > 0){
    $info_msg[] = 'Category Name Already Exist!';
 }else{

    $insert_categories = $conn->prepare("INSERT INTO `categories`(categ_name, image) VALUES(?,?)");
    $insert_categories->execute([$name, $image]);

    if($insert_categories){
       if($image_size > 2000000){
          $warning_msg[] = 'The Size Of The Image Is Too Large!';
       }else{
          move_uploaded_file($image_tmp_name, $image_folder);
          move_uploaded_file($image_tmp_name, $image_folder);
          move_uploaded_file($image_tmp_name, $image_folder);
          $success_msg[] = 'New Category Added Successfully!';
       }

    }

 }
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_categorie_image = $conn->prepare("SELECT * FROM `categories` WHERE id_categ = ?");
   $delete_categorie_image->execute([$delete_id]);
   $fetch_delete_image = $delete_categorie_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `categories` WHERE id_categ = ?");
   $delete_product->execute([$delete_id]);
   header('location:categories.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../CSS/admin_styles.css?v=<?php echo time();?>">
    <title>Categories</title>
</head>
<body>
    <?php include '../CommonElements/admin_header.php'?>

    <section class="add-categories">
        <h1 class="heading">Add Category</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="flex">
                <div class="inputBox">
                    <span>Category Name (required)</span>
                    <input type="text" class="box" required maxlength="100" name="name" placeholder="Enter Category Name">
                </div>
                <div class="inputBox">
                <span>Image (required)</span>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>
            </div>
            <input type="submit" value="Add Category" class="insert-btn" name="add_categorie">
        </form>
    </section>

    <section class="show-categories">
        <h1 class="heading">Categories Added</h1>
        <div class="box-container">

        <?php
      $select_categories = $conn->prepare("SELECT * FROM `categories`");
      $select_categories->execute();
      if($select_categories->rowCount() > 0){
         while($fetch_categories = $select_categories->fetch(PDO::FETCH_ASSOC)){ 
   ?>

<div class="box">
      <img src="../uploaded_img/<?= $fetch_categories['image']; ?>" alt="">
      <div class="name"><?= $fetch_categories['categ_name']; ?></div>
      <div class="flex-btn">
         <a href="update_categorie.php?update=<?= $fetch_categories['id_categ']; ?>" class="option-btn">Update</a>
         <a href="categories.php?delete=<?= $fetch_categories['id_categ']; ?>" class="delete-btn" onclick="return confirm('Delete This Categorie?');">Delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No Categories Added Yet!</p>';
      }
   ?>
        </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../JavaScript/admin_scripts.js"></script>
</body>
</html>