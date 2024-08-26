<?php

include 'CommonElements/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
   <link rel="stylesheet" href="CSS/user_styles.css?v=<?php echo time();?>">
</head>
<body>
   <?php include 'CommonElements/user_header.php';?>



   <section class="about">

<div class="row">

   <div class="image">
      <img src="images/AboutUs.png" alt="">
   </div>

   <div class="content">
      <h3>why choose us?</h3>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam quia minima hic non consectetur dolorum modi ea quod ut adipisci quos impedit tempore nisi fugiat, reiciendis, aliquid explicabo eius quisquam?</p>
      <a href="home.php#contact-us" class="btn btn-contact">contact us</a>
   </div>

</div>

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

<section class="reviews">

<h1 class="heading">client's reviews</h1>

<div class="swiper reviews-slider">

<div class="swiper-wrapper">

   <div class="swiper-slide slide">
      <img src="images/pic-1.png" alt="">
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
      <div class="stars">
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star-half-alt checked"></i>
      </div>
      <h3>john deo</h3>
   </div>

   <div class="swiper-slide slide">
      <img src="images/pic-3.png" alt="">
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
      <div class="stars">
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star-half-alt checked"></i>
      </div>
      <h3>john deo</h3>
   </div>

   <div class="swiper-slide slide">
      <img src="images/pic-4.png" alt="">
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia tempore distinctio hic, iusto adipisci a rerum nemo perspiciatis fugiat sapiente.</p>
      <div class="stars">
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star checked"></i>
         <i class="fas fa-star-half-alt checked"></i>
      </div>
      <h3>john deo</h3>
   </div>



</div>

<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>
<div class="swiper-pagination"></div>

</div>

<article class="logos-container">
            <a href="#"><img src="images/samsung.png" alt="" class="img-logos"></a>
            <a href="#"><img src="images/Dell.png" alt="" class="img-logos"></a>
            <a href="#"><img src="images/Apple-Logosu.png" alt="" class="img-logos"></a>
            <a href="#"><img src="images/Asus-logo.jpg" alt="" class="img-logos"></a>
            <a href="#"><img src="images/hp.png" alt="" class="img-logos"></a>
            <a href="#"><img src="images/Lenovo_Logo.png" alt="" class="img-logos"></a>
        </article>
</section>










   <?php include 'CommonElements/footer.php' ?>
   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="JavaScript/NewScript.js"></script>
   <script>
      var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
   navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
});
   </script>

</body>
</html>