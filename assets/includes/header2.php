<?php
    $user = $_SESSION['user'];
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
        ?>
        <header class="sub_header">
            <div class="container">
                <div class="user">
                    <div class="img">
                        <?php
                            foreach ($data_users as $index => $property) {
                                if($property['id'] == $user){
                                    ?>
                                        <a href="http://phpwithdb.rf.gd/assets/img/profile_pictures/default.png">
                                            <img src="http://phpwithdb.rf.gd/assets/img/profile_pictures/default.png" alt="">
                                        </a>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="name">
                        <?php
                            foreach ($data_users as $index => $property) {
                                if($property['id'] == $user){
                                    ?>
                                        <a href="user_account.php">
                                            <h4><?php echo $property['firstname']." ".$property['middlename']." ".$property['lastname']?></h4>
                                        </a>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="menus">
                    <p>
                        <a href="welcome.php">
                            <span><i class="fa fa-home"></i></span>
                        </a>
                        <a href="sell_something.php">
                            <span><i class="fa fa-cart-plus"></i></span>
                        </a>
                        <a href="user_account.php">
                            <span><i class="fa fa-user-o"></i></span>
                        </a>
                        <a href="link_logout.php">
                            <span><i class="fa fa-door-open"></i></span>
                        </a>
                    </p>
                </div>
            </div>
        </header>

        <?php
    }
?>
