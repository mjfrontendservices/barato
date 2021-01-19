<?php
session_start();
$user = $_SESSION['user'];
    $title = 'Barato | Edit Profile Picture';
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
                        <h2>Choose a photo</h2>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <input class="upload_profile" type="file" name="file" required>
                            <button type="submit" name="update_profile_pic_btn">Upload File</button>
                        </form>
                    </div>
                </div>
            </section>
        
            <!-- /body -->

        <?php
    }
?>

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>