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
    <script src="https://cdn.tiny.cloud/1/5o7mj88vhvtv3r2c5v5qo4htc088gcb5l913qx5wlrtjn81y/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>

<header>
    <img class="headimg" src="media/midway_header.png" alt="Website Header Image" width="1024" height="203">

    <nav>
    <?php

        echo ($currentfile == "index.php") ? "Home" : "<a href='index.php'>Home</a>";

        //if the user is logged in display the following
        //if (isset($_SESSION['ID'])) {
            echo ($currentfile == "formstart.php") ? "Forms" : "<a href='signup.php'>Forms</a>";
            echo ($currentfile == "search.php") ? "Search" : "<a href='search.php'>Search</a>";
            echo ($currentfile == "email.php") ? "Email" : "<a href='email.php'>Email</a>";


            //if the user has admin status display the following
           // if ($_SESSION['status'] == 1) {
                echo ($currentfile == "memberlist.php") ? "View Members" : "<a href='additems.php'>Manage Employees</a>";
           // }
            //if user is logged in, display log out
            echo ($currentfile == "logout.php") ? "Log Out" : "<a href='logout.php'>Log Out</a>";
            //else display log in
       // } else {
            echo ($currentfile == "login.php") ? "Log In" : "<a href='login.php'>Log In</a>";
       // }
        ?>
    </nav>
</header>
<main>
    <h2><?php // echo $pagename; ?></h2>
