<?php
$pagename = "Confirmation Page";
require_once "header.php";

//logout msg
if ($_GET['state']==1) {
    echo "<p class='success'> Successfully logged out. </p>";
}
//login msg
if ($_GET['state']==2){
    echo "<p class='success'>Welcome back " . $_SESSION['fname'] . "!</p>";
}
//forced logout from changing password
if ($_GET['state']==3){
    echo "<p class='success'>Your password has been changed and you have been logged out. Please log in again using your new password.</p>";
}

require_once "footer.php";
?>