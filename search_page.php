<?php

include 'CommonElements/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'CommonElements/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="CSS/user_styles.css?v=<?php echo time();?>">

</head>
<body>
   
<?php include 'CommonElements/user_header.php'; ?>

<div class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" placeholder="search here..." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</div>

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
   if (isset($_POST['search_box']) or isset($_POST['search_btn'])) {
       $search_box = $_POST['search_box'];
       $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'");
       $select_products->execute();
       $select_categ = $conn->prepare("SELECT * FROM categories WHERE categ_name LIKE '%{$search_box}%'");
       $select_categ->execute();
       if ($select_products->rowCount() > 0) {
           while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
               ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id_product']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id_product']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><?= $fetch_product['price']; ?><span> DH</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
           }
       } elseif ($select_categ->rowCount() > 0) {
           while ($fetch_categ = $select_categ->fetch(PDO::FETCH_ASSOC)) {
               ?>
    <div class="category-cart">
        <a href="category.php?categ_name=<?= $fetch_categ['id_categ']; ?>">
            <img src="uploaded_img/<?= $fetch_categ['image']; ?>" alt="">
            <div class="name"><?= $fetch_categ['categ_name']; ?></div>
        </a>
      </div>
      <?php
           }
       } else {
           echo '<p class="empty">Nothing Added Yet!</p>';
       }
   }
   ?>
   </div>

</section>






<?php include 'CommonElements/footer.php'; ?>

<script src="JavaScript/NewScript.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include './CommonElements/alert.php';?>
</body>
</html>