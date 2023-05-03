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

<table>
    <tr><th>Address</th><th>Business Name</th><th>Complex</th><th>Business Owner</th><th>Business Phone</th><th>Business Email</th><th>Cellphone</th><th>Building Owner</th><th>Building Phone</th></tr>
    <?php foreach ($result as $row) { ?>
        <tr>
            <td><?php echo $row['address'];?></td>
            <td><?php echo $row['busName'];?></td>
            <td><?php echo $row['complex'];?></td>
            <td><?php echo $row['busOwner'];?></td>
            <td><?php echo $row['busEmail'];?></td>
            <td><?php echo $row['cellPhone'];?></td>
            <td><?php echo $row['buildingOwner'];?></td>
            <td><?php echo $row['buildPhone'];?></td>
        </tr>
    <?php }//close foreach ?>
</table>

<?php
require_once "footer.php";
?>
