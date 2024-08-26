<?php

include '../CommonElements/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $id_categ = $_POST['id_categ'];
   $categ_name = $_POST['categ_name'];
   $categ_name = filter_var($categ_name, FILTER_SANITIZE_STRING);

   $update_categorie = $conn->prepare("UPDATE `categories` SET categ_name = ? WHERE id_categ = ?");
   $update_categorie->execute([$categ_name, $id_categ]);

   $success_msg[] = 'Category Updated Successfully!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $warning_msg[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `categories` SET image = ? WHERE id_categ = ?");
         $update_image->execute([$image, $id_categ]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../uploaded_img'.$old_image);
      }
   }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Category</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../CSS/admin_styles.css?v=<?php echo time();?>">

</head>
<body>

<?php include '../CommonElements/admin_header.php'; ?>

<section class="update-categorie">

   <h1 class="heading">Update Category</h1>

   <?php
      $update_id = $_GET['update'];
      $select_categories = $conn->prepare("SELECT * FROM `categories` WHERE id_categ = ?");
      $select_categories->execute([$update_id]);
      if($select_categories->rowCount() > 0){
         while($fetch_categories = $select_categories->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id_categ" value="<?= $fetch_categories['id_categ']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_categories['image']; ?>">
      <div class="main-image">
            <img src="../uploaded_img/<?= $fetch_categories['image']; ?>" alt="">
         </div>
      <span>Update Name</span>
      <input type="text" name="categ_name" required class="box" maxlength="100" placeholder="Enter Category Name" value="<?= $fetch_categories['categ_name']; ?>">
      <span>Update Image</span>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <div class="flex-btn">
         <input type="submit" name="update" class="option-btn" value="update">
         <a href="categories.php" class="cancel-btn">Cancel</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">No Category Found!</p>';
      }
   ?>

</section>











<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="../JavaScript/admin_scripts.js"></script>
<?php include '../CommonElements/alert.php'; ?>

</body>
</html>