<?php

//check for duplicates
function checkdup($pdo, $sql, $field)
{
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $field);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

//check is user is logged in
function checkLogin()
{
    if (!isset($_SESSION['ID'])) {
        echo "<p class='error'>This page requires authentication.  Please log in to view details.</p>";
        require_once "footer.php";
        exit();
    }
}

//check if user is an admin
function checkAdmin()
{
    if ($_SESSION['status'] != 2 ) {
        echo "<p class='error'>This page is restricted. Access is available to admins only.</p>";
        require_once "footer.php";
        exit();
    }
}




















