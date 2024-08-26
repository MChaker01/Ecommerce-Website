<header class="header">
    <section class="flex">
        <a href="../admin/dashboard.php" class="logo">Admin</a>
        <nav class="navbar">
            <a href="../admin/dashboard.php">Home</a>
            <a href="../admin/products.php">Products</a>
            <a href="../admin/categories.php">Categories</a>
            <a href="../admin/placed_orders.php">Orders</a>
            <a href="../admin/admin_accounts.php">Admins</a>
            <a href="../admin/users_accounts.php">Users</a>
            <a href="../admin/messages.php">Messages</a>
        </nav>
        <div class="icons">
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <div class="profile">
        <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
            <a href="../admin/update_profile.php" class="option-btn">Profile</a>
            <a href="../admin/register_admin.php" class="insert-btn">New Admin</a>
            <a href="../CommonElements/admin_logout.php" class="delete-btn" onclick="return confirm('Logout from the website?');">Logout</a>
      
        </div>
    </section>
    <?php include '../CommonElements/alert.php'; ?>
</header>