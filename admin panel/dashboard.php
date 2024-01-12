<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id = $_COOKIE['seller_id'];
    }else{
        $seller_id = '';
        header('location:loging.php');
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purple Avenue - Admin Dashboard Page</title>
    <link rel="stylesheet" href="../css/admin_style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

</head>
<body>
    
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="dashboard">
            <div class="heading">
                <h1>dashboard</h1>
                <img src="../image/TextSeparator.png">
            </div>
            <div class="box-container">
                <div class="box">
                    <h3>welcome</h3>
                    <p><?= $fetch_profile['name']; ?></p>
                    <a href="update.php" class="btn">update profile</a>
                </div>
                <div class="box">
                <?php
                    $select_message = $conn->prepare("SELECT * FROM `message`"); // Changed single quotes to backticks
                    $select_message->execute();
                    $number_of_msg = $select_message->rowCount();
                ?>
                <h3><?= $number_of_msg; ?></h3>
                <p>unread message</p>
                <a href="admin_message.php" class="btn">see message</a>
                </div>
                <div class="box">
                <?php
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ?"); // Changed single quotes to backticks
                    $select_products->execute([$seller_id]);
                    $number_of_products = $select_products->rowCount();
                ?>
                <h3><?= $number_of_products; ?></h3>
                <p>products added</p>
                <a href="add_product.php" class="btn">add products</a>
                </div>
                <div class="box">
                <?php
                    $select_active_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ? AND status = ?"); // Changed single quotes to backticks
                    $select_active_products->execute([$seller_id, 'active']);
                    $number_of_active_products = $select_active_products->rowCount();
                ?>
                <h3><?= $number_of_active_products; ?></h3>
                <p>total active products</p>
                <a href="view_product.php" class="btn">active products</a>
                </div>
                <div class="box">
                <?php
                    $select_deactive_products = $conn->prepare("SELECT * FROM `products` WHERE seller_id = ? AND status = ?"); // Changed single quotes to backticks
                    $select_deactive_products->execute([$seller_id, 'deactive']);
                    $number_of_deactive_products = $select_deactive_products->rowCount();
                ?>
                <h3><?= $number_of_deactive_products; ?></h3>
                <p>total deactive products</p>
                <a href="view_product.php" class="btn">deactive products</a>
                </div>
                <div class="box">
                <?php
                    $select_users = $conn->prepare("SELECT * FROM `users`"); // Changed single quotes to backticks
                    $select_users->execute();
                    $number_of_users = $select_users->rowCount();
                ?>
                <h3><?= $number_of_users; ?></h3>
                <p>users account</p>
                <a href="user_accounts.php" class="btn">see users</a>
                </div>
                <div class="box">
                <?php
                    $select_sellers = $conn->prepare("SELECT * FROM `sellers`"); // Changed single quotes to backticks
                    $select_sellers->execute();
                    $number_of_sellers = $select_sellers->rowCount();
                ?>
                <h3><?= $number_of_sellers; ?></h3>
                <p>sellers account</p>
                <a href="user_accounts.php" class="btn">see sellers</a>
                </div>
                <div class="box">
                <?php
                    $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ?"); // Changed single quotes to backticks
                    $select_orders->execute([$seller_id]);
                    $number_of_orders = $select_orders->rowCount();
                ?>
                <h3><?= $number_of_orders; ?></h3>
                <p>total order place</p>
                <a href="admin_order.php" class="btn">total order</a>
                </div>
                <div class="box">
                <?php
                    $select_confirm_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ? AND status =?"); // Changed single quotes to backticks
                    $select_confirm_orders->execute([$seller_id, 'in progress']);
                    $number_of_confirm_orders = $select_confirm_orders->rowCount();
                ?>
                <h3><?= $number_of_confirm_orders; ?></h3>
                <p>total confirm orders</p>
                <a href="admin_order.php" class="btn">confirm order</a>
                </div>
                <div class="box">
                <?php
                    $select_cancelled_orders = $conn->prepare("SELECT * FROM `orders` WHERE seller_id = ? AND status =?"); // Changed single quotes to backticks
                    $select_cancelled_orders->execute([$seller_id, 'cancelled']);
                    $number_of_cancelled_orders = $select_cancelled_orders->rowCount();
                ?>
                <h3><?= $number_of_cancelled_orders; ?></h3>
                <p>total cancelled</p>
                <a href="admin_order.php" class="btn">cancelled order</a>
                </div>
            </div>
        </section>
    </div>
    



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="../js/admin_script.js"></script>

    <?php include '../components/alert.php' ?>
</body>
</html>