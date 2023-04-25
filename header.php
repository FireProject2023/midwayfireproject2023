<?php

//Error Reporting
session_start();
error_reporting(E_ALL);
ini_set('display_errors','1');

//Current File
$currentfile = basename($_SERVER['SCRIPT_FILENAME']);

//Include Files
require_once "connect.php";
require_once "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Midway Fire</title>
    <link rel="stylesheet" href="styles/styles.css">
<!--  <script src="https://cdn.tiny.cloud/1/5o7mj88vhvtv3r2c5v5qo4htc088gcb5l913qx5wlrtjn81y/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
      <script>tinymce.init({ selector:'textarea' });</script> -->
    <script src="js/script.js"></script>
</head>
<body>

<header>
    <img class="headimg" src="media/midway_header.png" alt="Website Header Image" width="1024" height="203">

    <nav>
        <a href='index.php'>Home</a>

        <?php //if the user is logged in display the following
         if (isset($_SESSION['ID'])) { ?>
            <a href='formstart.php'>Forms</a>
            <a href='search.php'>Search</a>

         <?php //if the user has admin status display the following
            if ($_SESSION['status'] == 2) { ?>
                <a href='memberlist.php'>Manage Employees</a>
        <?php } //if user is logged in, display log out
            if ($_SESSION['status'] != 0) ?>
            <a class="login" href='logout.php'>Log Out</a
        <?php //else display log in
        } else { ?>
            <a class="login" href='login.php'>Log In</a>
        <?php } ?>
    </nav>
</header>
<main> <div class="mainpage">
    <h2><?php echo $pagename; ?></h2>
