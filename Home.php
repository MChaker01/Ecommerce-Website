
<?php include 'CommonElements/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'CommonElements/wishlist_cart.php';


if(isset($_POST['send'])){

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $subject = $_POST['subject'];
  $subject = filter_var($subject, FILTER_SANITIZE_STRING);
  $msg = $_POST['msg'];
  $msg = filter_var($msg, FILTER_SANITIZE_STRING);

  $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND subject = ? AND message = ?");
  $select_message->execute([$name, $email, $subject, $msg]);

  if($select_message->rowCount() > 0){
     $info_msg[] = 'already sent message!';
  }else{

     $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, subject, message) VALUES(?,?,?,?,?)");
     $insert_message->execute([$user_id, $name, $email, $subject, $msg]);

     $success_msg[] = 'Message sent Successfully!';

  }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="CSS/user_styles.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <title>Home</title>
</head>
<body>
    <?php include 'CommonElements/user_header.php';?>

    <header>
        <!-- Banner of the Header-->
        <section id="header-bnr">
            <img src="images/AppleCopy.png" alt="" id="banner-img">
            <article id="welcom-article">
                <p id="title-bnr">Welcom To Our Store</p>
                <p id="secondtitle-bnr">Up To <span id="span-banner">70%</span> Off</p>
                <p id="paragraphe-bnr">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Perferendis est iusto molestiae vel voluptatum facere,
                    tempore hic blanditiis sint odio, 
                    cumque ut unde esse eos nihil. Perspiciatis non officiis repudiandae.
                </p>
                <a href="user_register.php" class="shop-now">Shop Now</a>
            </article>
        </section>
        <!-- Advantages -->
        <article class="advantages">
            <div class="advantages-carts">
                <span class="advantages-container">
                    <i class="fa-solid fa-truck"></i>
                    <h4>Free Delivery</h4>
                    <p class="para-cart">Free Shipping on all order</p>
                </span>
                <span class="advantages-container">
                    <i class="fa-solid fa-arrows-rotate"></i>
                    <h4>Return Policy</h3>
                    <p class="para-cart">Free Shipping on all order</p>
                </span>
                <span class="advantages-container">
                    <i class="fa-solid fa-headset"></i>
                    <h4>24/7 Support</h4>
                    <p class="para-cart">Free Shipping on all order</p>
                </span>
                <span class="advantages-container">
                    <i class="fa-solid fa-coins"></i>
                    <h4>Secure Payment</h4>
                    <p class="para-cart">Free Shipping on all order</p>
                </span>
            </div>
        </article>
    </header>

    
    <section class="home-category">
    <div class="swiper categories-slider">
    <h1 class="home-titles">Categories</h1>
    <div class="category-container swiper-wrapper">
    <?php
     $select_categ = $conn->prepare("SELECT * FROM categories"); 
     $select_categ->execute();
     if($select_categ->rowCount() > 0){
      while($fetch_categ = $select_categ->fetch(PDO::FETCH_ASSOC)){
   ?>
  
      <div class="swiper-slide slide">
      <div class="category-cart">
        <a href="category.php?categ_name=<?= $fetch_categ['id_categ']; ?>">
            <img src="uploaded_img/<?= $fetch_categ['image']; ?>" alt="">
            <div class="name"><?= $fetch_categ['categ_name']; ?></div>
        </a>
      </div>
    </div>
   <?php
      }
   }else{
      echo '<p class="empty">No Categories Added Yet!</p>';
   }
   ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
    </div>
    </section>


    <section class="home-product">
    <h1 class="home-titles">New Products</h1>
    <div class="swiper products-slider">
    <div class="swiper-wrapper">
    <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide-product">
      <input type="hidden" name="pid" value="<?= $fetch_product['id_product']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="Show_Product.php?pid=<?= $fetch_product['id_product']; ?>" class="fas fa-eye"></a>
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
   }else{
      echo '<p class="empty">No Products Added Yet!</p>';
   }
   ?>
    </div>
    <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
    </div>
    </section>
    <section id="contact-us">
        <article class="contact">
            <form action="" method="post">
                <h2 class="home-titles">Contact US</h2>
                    <div class="contact-info-container">
                        <div class="contact-info">
                            <span class="informations">
                                <i class="fa-solid fa-house fa-contact-info"></i>
                                <span>
                                    <p>Agadir,Morocco</p>
                                    <p class="info-p">Agadir,Morocco</p>
                                </span>
                            </span>
                            <span class="informations">
                                <i class="fa-solid fa-mobile-screen fa-contact-info"></i>
                                <span>
                                    <p>0528000000</p>
                                    <p class="info-p">Mon to Fri 9AM to 9PM</p>
                                </span>
                            </span>
                            <span class="informations">
                                <i class="fa-solid fa-envelope fa-contact-info"></i>
                                <span >
                                    <p>store.support@services.xyz</p>
                                    <p class="info-p">Send us your query anytime!</p>
                                </span>
                            </span>
                        </div>
                        <div class="contact-us">
                            <input type="text" name="name" class="contact-input" placeholder="Enter your Name" required>
                            <input type="email" name="email" class="contact-input" placeholder="Enter your Email" required>
                            <input type="text" name="subject" class="contact-input" placeholder="Enter the Subject" required>
                        </div>
                        <div class="contact-us">
                            <textarea id="contact-text" placeholder="Enter your Message" required name="msg"></textarea>
                        </div>
                    </div>
                    <div class="send-contain"><input type="submit" name="send" value="Send Message" id="btn-send"></div>
            </form>
        </article>
    </section>









    
    <?php include 'CommonElements/footer.php'; ?>
    <script src="JavaScript/NewScript.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".categories-slider", {
        spaceBetween: 10,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });


      var swiper = new Swiper(".products-slider", {
   loop:true,
   slidesPerView: 3,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 4,
      },
   },
   navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
});
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'CommonElements/alert.php';?>
</body>
</html>