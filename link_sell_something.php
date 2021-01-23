<?php
session_start();
$user = $_SESSION['user'];
    $title = 'Barato | Sell Something';
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
                    <h2>Sell Something</h2>
                    <?php
                        foreach ($data_product_img as $key => $value) {
                            if($value['product_pic'] == $_SESSION['product_image']){
                                ?>
                                    <img src="assets/img/profile_pictures/<?php echo $value['product_pic']?>" alt=""><br>
                                <?php
                            }
                        }
                    ?>
                    <span class="_product_img_note">(Note: You can only insert one product image.)</span><br><br>
                    <a href="link_sell_something_upload_img.php">
                        <span class="product_image"><i class="fa fa-plus"></i> Product Image</span><br><br>
                    </a>
                    <form action="controller.php" method="GET">
                        <input type="text" name="product_name" placeholder="Product name" required><br>
                        <input type="number" name="product_price" placeholder="Product price" required><br>
                        <textarea type="text" name="product_description" placeholder="Product description" required></textarea><br><br>
                        <!-- <div class="boxes"> -->
                        <?php
                            foreach ($data_users as $key => $value) {
                                if($value['id'] == $user){
                                    ?>
                                        <input type="hidden" name="product_seller_name" value="<?php echo $value['firstname']." ".$value['middlename']." ".$value['lastname']?>"><br>
                                        <input type="hidden" name="product_seller_contact_info" value="<?php echo $value['phone_number']?>"><br>
                                    <?php
                                }
                            }
                        ?>
                        <button type="submit" name="sell_product_btn">Sell</button>
                    </form>
                </div>
            </section>
        
            <!-- /body -->

        <?php
    }
?>

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>