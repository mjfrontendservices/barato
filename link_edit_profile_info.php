<?php
session_start();
$user = $_SESSION['user'];
    $title = 'Barato | Profile Information';
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
                        <h2>Edit User Account</h2>
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
                            <a href="link_edit_profile_picture.php">
                                <p class="edit_profile_picture"><i class="fa fa-edit"></i> Edit Profile Picture</p>
                            </a>
                        </p>
                        <?php
                                foreach ($data_users as $key => $value) {
                                    if($value['id'] == $_SESSION['user']){
                                        ?>
                                            <form action="controller.php" method="GET">
                                                <input type="text" name="firstname" placeholder="First name" value="<?php echo $value['firstname']?>" required><br>
                                                <input type="text" name="middlename" placeholder="Middle name" value="<?php echo $value['middlename']?>" required><br>
                                                <input type="text" name="lastname" placeholder="Lastname" value="<?php echo $value['lastname']?>" required><br>
                                                <input type="email" name="email" placeholder="Email" value="<?php echo $value['email']?>" required><br>
                                                <input type="number" name="phone_number" placeholder="Phone Number" value="<?php echo $value['phone_number']?>" required><br>
                                                <input type="text" name="address" placeholder="Complete Address" value="<?php echo $value['address']?>" required><br>
                                                <p class="uniq">Unique username cannot be change.</p>
                                                <input type="text" name="username" placeholder="Username" value="<?php echo $value['username']?>" disabled><br>
                                                <p class="acc_pass">Enter account password to confirm.</p>
                                                <input type="password" name="password" placeholder="Account password" required><br>
                                                <button type="submit" name="update_profile_btn">Update Profile</button>
                                            </form>
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