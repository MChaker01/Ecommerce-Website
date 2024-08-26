<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">Store</a>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="products_page.php">Products</a>
         <a href="orders.php">Orders</a>
         <a href="about.php">About</a>
         <a href="home.php#contact-us">Contact</a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span></span></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span></span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="update_user.php" class="option-btn">update profile</a>
         <a href="CommonElements/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
            // echo '<p>please login or register first!</p>';
         ?>
         
         <div class="flex-btn">
            <a href="user_register.php" class="insert-btn">Register</a>
            <a href="user_login.php" class="btn">Login</a>
         </div>
         <?php
            }
         ?>      
      </div>

   </section>

</header>