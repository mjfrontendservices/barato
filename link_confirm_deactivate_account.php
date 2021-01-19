<?php
session_start();
$user = $_SESSION['user'];
    $title = 'Barato | Deactivate Account';
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
        if(isset($_REQUEST['deactivate'])){
            $deactivate_user = $_REQUEST['deactivate'];
            // delete username
            $index = array_search($deactivate_user, $data_uniq_usernames);
            unset($data_uniq_usernames[$index]);
            $data_uniq_usernames_insert = json_encode($data_uniq_usernames);
            file_put_contents('assets/db/uniq_usernames.json', $data_uniq_usernames_insert);
            // delete image and remove user list
            foreach ($data_users as $key => $value) {
                if($value['username'] == $deactivate_user){
                    // if profile is not equal to dafault.png
                    if($value['profile_picture'] != 'default.png'){
                        unlink('assets/img/profile_pictures/'.$value['profile_picture'].'');
                    }
                    array_splice($data_users, $key, 1);
                    $data_users_insert = json_encode($data_users);
                    file_put_contents('assets/db/users.json', $data_users_insert);
                    header ('Location: index.php');
                }
            }
        }
    }
?>

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>