<?php
session_start();
$user = $_SESSION['user'];
    $title = 'Barato | User Account';
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
        
            <section class="user_account">
                <div class="container">
                    <div class="account_info">
                        <h2>User Account</h2>
                        <p>
                        <?php
                            foreach ($data_users as $key => $value) {
                                if($value['id'] == $_SESSION['user']){
                                    ?>
                                        <a href="assets/img/profile_pictures/<?php echo $value['profile_picture']?>">
                                            <img src="assets/img/profile_pictures/<?php echo $value['profile_picture']?>" alt="">
                                        </a>
                                    <?php
                                }
                            }
                        ?>
                        </p>
                        <?php
                            foreach ($data_users as $key => $value) {
                                if($value['id'] == $_SESSION['user']){
                                    ?>
                                        <p class="info">
                                            <span><i class="fa fa-user"></i> <?php echo $value['firstname']." ".$value['middlename']." ".$value['lastname']?></span><br><br>
                                            <span><i class="fa fa-envelope"></i> <?php echo $value['email']?></span><br><br>
                                            <span><i class="fa fa-map-marker"></i> <?php echo $value['address']?></span><br><br>
                                            <span><i class="fa fa-phone"></i> <?php echo $value['phone_number']?></span><br><br>
                                            <span><i class="fa fa-calendar"></i> <?php echo $value['date']?> (date joined)</span><br><br>
                                            <span class="deactivate">
                                                <a href="link_deactivate_account.php">
                                                    <i class="fa fa-trash"></i> Deactivate Account
                                                </a>
                                            </span>
                                        </p>
                                        <a href="link_edit_profile_info.php">
                                            <button><i class="fa fa-edit"></i>Edit Profile Info</button></br>
                                        </a>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </section>
        
            <!-- /body -->

        <?php
    }
?>

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>