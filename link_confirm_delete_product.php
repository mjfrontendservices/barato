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
        if(isset($_REQUEST['confirm_delete_product'])){
            $get_product_id = $_REQUEST['confirm_delete_product'];
            foreach ($data_products as $key => $value) {
                if($value['id'] == $get_product_id){
                    array_splice($data_products, $key, 1);
                    unlink('assets/img/uploads/'.$value['image'].'');
                    $data_product_insert = json_encode($data_products);
                    file_put_contents('assets/db/products.json', $data_product_insert);
                    header ('Location: sell_something.php');
                }
            }
        }
    }
?>

<!-- includes -->
<?php include 'assets/includes/bottom.php'?>