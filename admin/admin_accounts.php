<?php

include '../CommonElements/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_admin = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
    $delete_admin->execute([$delete_id]);
    header('location:admin_accounts.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

   <link rel="stylesheet" href="../CSS/admin_styles.css?v=<?php echo time();?>">

</head>
<body>

<?php include '../CommonElements/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">Admin Accounts</h1>

   <!-- *************************************************************** -->
   <table id="accounts">
         <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
         </thead>
         <tbody>
        <?php
      $select_accounts = $conn->prepare("SELECT * FROM `admins`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
            <tr>
                <td><span><?= $fetch_accounts['id']; ?></span></td>
                <td><span><?= $fetch_accounts['name']; ?></span></td>
                <td><span id="admin-actions"><a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('Delete This Account?')" class="delete-btn" id="delete-adminbtn">Delete</a>
                <?php
            if($fetch_accounts['id'] == $admin_id){
               echo '<a href="update_profile.php" class="option-btn" id="updateadmin-btn">Update</a>';
            }
         ?></span></td>

            </tr>
      <?php }?>
      </tbody>
      </table>
   <?php
         
      }else{
         echo '<p class="empty">No Accounts Available!</p>';
      }
   ?>
   <!-- **************************************************************** -->

</section>












<script src="../JavaScript/admin_scripts.js"></script>
   
</body>
</html>