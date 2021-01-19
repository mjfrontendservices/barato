<?php
    $data_users = json_decode(file_get_contents('assets/db/users.json'), true);
    $data_forgot_password_users = json_decode(file_get_contents('assets/db/forgot_password_users.json'), true);
    $data_products = json_decode(file_get_contents('assets/db/products.json'), true);
    $data_product_img = json_decode(file_get_contents('assets/db/product_images.json'), true);
    $data_uniq_usernames = json_decode(file_get_contents('assets/db/uniq_usernames.json'), true);
?>