<?php

$pagename = "View Address";
require_once "header.php";
$currentfile = "viewaddress.php";

//query database
$sql = "SELECT * FROM address WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_GET['q']);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($result as $row) { ?>
    <p><strong>Address: </strong><?php echo $row['address'];?> <?php echo $row['complex'];?></p>
    <p><strong>Business Name: </strong><?php echo $row['busName'];?></p>
    <p><strong>Business Owner: </strong><?php echo $row['busOwner'];?></p>
    <p><strong>Business Email: </strong><?php echo $row['busEmail'];?></p>
    <p><strong>Business Phone: </strong><?php echo $row['busPhone'];?></p>
    <p><strong>Cellphone: </strong><?php echo $row['cellPhone'];?></p>
    <p><strong>Building Owner: </strong><?php echo $row['buildingOwner'];?></p>
    <p><strong>Building Phone: </strong><?php echo $row['buildPhone'];?></p>

<?php }//close foreach ?>


<?php
require_once "footer.php";
?>
