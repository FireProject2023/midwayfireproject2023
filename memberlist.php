<?php
$pagename = "Manage Employees";
require_once "header.php";
$currentfile = "memberlist.php";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $approve = $_POST['approve'];
    if ($approve==1) {
        $sql = "UPDATE signup SET status = :status WHERE ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':status', $approve);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();
        //Success message
        echo "<p class='success'>User has been approved.</p>";
    } else if ($approve==0) {
        $sql = "UPDATE signup SET status = :status WHERE ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':status', 0);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();
        //Success message
        echo "<p class='success'>User access has been removed.</p>";
    } else if ($approve==2) {
        $sql = "UPDATE signup SET status = :status WHERE ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':status', 2);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();
        //Success message
        echo "<p class='success'>User has been granted admin privileges.</p>";
    }
}
//Sorting options
if (isset($_GET['q'])) {
    switch ($_GET['q']){
        case "fa":
            $sorting = "fname";
            break;
        case "fd":
            $sorting = "fname DESC";
            break;
        default:
            $sorting = "fname";
    }//close switch

} else {
    $sorting = "fname";
}//isset q

//query database
$sql = "SELECT * FROM signup ORDER BY $sorting";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="section">
    <table id="members">
        <tr><th>Name <a href="<?php echo $currentfile; ?>?q=fa">&#x219F;</a> <a href="<?php echo $currentfile; ?>?q=fd">&#x21A1;</a>
            </th><th>Email</th><th>Options</th><th>Status</th><th>Admin Status</th></tr>
        <form name="approvemembers" id="approvemembers" method="post" action="<?php echo $currentfile; ?>">
        <?php
        //display to the screen
        //loop through the results and display to the screen
        foreach ($result as $row){
            ?>
            <tr>
                <td><?php echo $row['fname'] . " "; echo $row['lname'];?></td>
                <td><?php echo $row['eml'];?></td>
                <td>
                    <?php if ($_SESSION['ID'] == $row['id'] || $_SESSION['status'] == 2) {?>
                        <a href="update.php?q=<?php echo $row['id'];?>">Update</a><br>
                        <a href="changepwd.php?q=<?php echo $row['id'];?>">Change Password</a>
                    <?php } ?>
                </td>
                <td>
                    <form name="approve" id="approve" action="<?php echo $currentfile; ?>" method="post">
                    <?php if ($row['status'] == 0 && $_SESSION['status'] == 2) {?>
                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>"/>
                        <input type="hidden" name="approve" value="<?php echo 1; ?>"/>
                        <input type="submit" name="submit" id="submit" value="Approve">
                    <?php } else if ($row['status'] != 0 && $_SESSION['status'] == 2) {?>
                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>"/>
                        <input type="hidden" name="approve" value="<?php echo 0; ?>"/>
                        <input type="submit" name="submit" id="submit" value="Remove">
                    <?php } ?>
                    </form>
                </td>
                <td>
                    <form name="admin" id="admin" action="<?php echo $currentfile; ?>" method="post">
                    <?php if ($row['status'] != 2 && $_SESSION['status'] == 2) { ?>
                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>"/>
                        <input type="hidden" name="approve" value="<?php echo 2; ?>"/>
                        <input type="submit" name="submit" id="submit" value="Make Admin">
                    <?php } else if ($row['status'] == 2 && $_SESSION['status'] == 2) {
                        $approve=1; ?>
                        <input type="hidden" name="id" value="<?php echo $row['ID']; ?>"/>
                        <input type="submit" name="submit" id="submit" value="Remove Admin">
                    <?php } ?>
                    </form>
                </td>
            </tr>
            <?php
        }//foreach
        ?>

        </form>
    </table>
</div>

<?php
require_once "footer.php";
?>