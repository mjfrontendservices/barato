<?php
session_start();
$user = $_SESSION['user'];
    $title = 'Barato | Sell Something | Product Image';
    include 'assets/includes/top.php';
    include 'assets/includes/data.php';
    if($user === ""){
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

            <section class="sell_something_form">
                <div class="container">
                    <h2>Upload Product Picture</h2>
                    <form action="controller.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="product_picture" required><br>
                        <button type="submit" name="upload_product_img_btn">Upload Product Photo</button>
                    </form>
                </div>
            </section>
        
            <!-- /body -->

        <?php
    }
?>

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>