<?php
session_start();
$user = $_SESSION['user'];
    $title = 'Barato | Welcome';
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
        
            <section class="search_bar">
                <div class="container">
                    <input type="text" class="search_bar_input" placeholder="Search for items, seller, address etc...">
                </div>
            </section>
        
            <section class="items">
                <div class="container">
                    <h3>Listings: <?php echo count($data_products)?></h3>
                    <?php
                        foreach ($data_products as $key => $value) {
                            ?>
                                <div class="item_wrapper" data-toggle="modal" data-target="#<?php echo $value['id'];?>">
                                    <div class="item_img">
                                        <img src="assets/img/uploads/<?php echo $value['image']?>" alt="">
                                    </div>
                                    <div class="item_desc">
                                        <h4><?php echo $value['name']?></h4>
                                        <span>Php <?php echo $value['price']?></span>
                                        <div class="seller_address">
                                            <p>
                                                <?php echo $value['description'];?><br>
                                                <b>Seller:</b> <?php echo $value['seller'];?><br>
                                                <?php
                                                    foreach ($data_users as $key => $users_value) {
                                                        if($users_value['id'] == $value['seller_id']){
                                                            ?>
                                                                <b>Location:</b> <?php echo $users_value['address'];?>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </section>
        
            <!-- /body -->

        <?php
    }
?>

<!-- produt information -->
    <?php
        foreach ($data_products as $key => $value) {
            ?>
                <div id="<?php echo $value['id'];?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="product_details_img">
                                    <a href="assets/img/uploads/<?php echo $value['image']?>">
                                        <img src="assets/img/uploads/<?php echo $value['image']?>" alt="">
                                    </a>
                                </div>
                                <div class="product_details_info">
                                    <p>
                                        <b>Product ID:</b> 
                                        <span class="product_id">
                                            <?php echo $value['id']?>
                                        </span><br><br>
                                        <span class="product_details_name">
                                            <b><?php echo $value['name']?></b>
                                        </span><br><br>
                                        <b>Price:</b> 
                                        <span class="product_details_price">
                                            Php <?php echo $value['price']?>
                                        </span><br><br>
                                        <b>Description:</b><br>
                                        <span class="product_details_description">
                                            <?php echo $value['description']?>
                                        </span><br><br><hr>
                                        <span class="product_details_seller">
                                            <b>Seller:</b>
                                            <?php echo $value['seller']?>
                                        </span><br>
                                        <span class="product_details_seller_address">
                                            <b>Seller Address:</b>
                                            <?php
                                                foreach ($data_users as $key => $user_value) {
                                                    if($user_value['id'] == $value['seller_id']){
                                                        ?>
                                                            <?php echo $user_value['address']?>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </span><br><br>
                                        <b>Contact Seller</b><br>
                                        <span class="direct">(Direct call and message button)</span><br><br>
                                        <span class="product_details_seller_phone_number">
                                            <a href="tel:<?php echo $value['contact info']?>">
                                                <i class="fa fa-phone"></i> <?php echo $value['contact info']?>
                                            </a>
                                        </span> 
                                        <span class="product_details_seller_phone_number">
                                            <a href="sms:<?php echo $value['contact info']?>">
                                                <i class="fa fa-sms"></i> <?php echo $value['contact info']?>
                                            </a>
                                        </span><br><br><br>
                                        <b>Date Posted:</b><br>
                                        <span class="product_details_date">
                                            <i class="fa fa-calendar"></i> <?php echo $value['date']?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Back</button>
                            </div>
                        </div>
            
                    </div>
                </div>
            <?php
        }
    ?>

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>