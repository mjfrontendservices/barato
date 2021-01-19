<?php
session_start();
$user = $_SESSION['user'];
    $title = 'Barato | Delete Product';
    include 'assets/includes/top.php';
    include 'assets/includes/data.php';
    if($_SESSION['user'] === ""){
        include 'assets/includes/header.php';
        ?>
            <div class="container">
                <p class="alert alert-danger success">
                    <b>User is logged out</b>
                </p>
                <a href="index.php">
                    <button class="btn btn-info"><i class="fa fa-arrow-left"></i> Log in</button>
                </a>
                <a href="register.php">
                    <button class="btn btn-info">Register <i class="fa fa-arrow-right"></i></button>
                </a>
            </div>
        <?php
        include 'assets/includes/bottom.php';
    } else {
        include 'assets/includes/header.php';
        include 'assets/includes/header2.php';
        ?>

        <!-- body -->
    
        <section class="delete_product">
            <div class="container">
                <p class="alert alert-info logout_msg">
                    <b>Do you want to delete this product?</b><br>
                    This action cannot be undone.
                </p>
                <a href="link_confirm_delete_product.php?confirm_delete_product=<?php echo $_REQUEST['delete_product'];?>">
                    <button class="btn btn-info"><i class="fa fa-check"></i> Yes</button>
                </a>
                <a href="sell_something.php">
                    <button class="btn btn-danger"><i class="fa fa-times"></i> No</button>
                </a>
            </div>
        </section>
        
            <!-- /body -->

        <?php
    }
?>

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>