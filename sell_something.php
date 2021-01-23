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

            <section class="sell_something">
                <div class="container">
                    <a href="link_sell_something.php">
                        <button class="_sell_button"><i class="fa fa-cart-plus"></i> Sell Something</button>
                    </a>
                    <h2 class="sell_history_h">Manage your products</h2>
                    <?php
                        foreach ($data_products as $key => $value) {
                            if($value['seller_id'] == $user){
                                ?>
                                    <div class="products">
                                        <div class="product_image">
                                            <img src="assets/img/profile_pictures/<?php echo $value['image'];?>" alt="">
                                        </div>
                                        <div class="product_details">
                                            <h2><?php echo $value['name'];?></h2>
                                            <p><?php echo $value['description'];?></p>
                                        </div>
                                        <div class="unsell">
                                            <a href="link_delete_product.php?delete_product=<?php echo $value['id']?>">
                                                <button><i class="fa fa-trash"></i> Delete</button>
                                            </a>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </section>
        
            <!-- /body -->

        <?php
    }
?>

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>