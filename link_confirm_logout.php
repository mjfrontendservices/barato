<?php
session_start();
    $title = 'Barato | Log out';
    include 'assets/includes/top.php';
    include 'assets/includes/data.php';
    $_SESSION['user'] = "";
    header ('Location: index.php');
    include 'assets/includes/bottom.php';
?>