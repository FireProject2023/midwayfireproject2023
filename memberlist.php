<?php
$pagename = "Manage Employees";
require_once "header.php";
$currentfile = "memberlist.php";

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
$sql = "SELECT id, fname, lname, eml FROM signup ORDER BY $sorting";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="columnleft">
<div class="section">
    <table id="members">
        <tr><th>First Name <a href="<?php echo $currentfile; ?>?q=fa">&#x219F;</a> <a href="<?php echo $currentfile; ?>?q=fd">&#x21A1;</a>
            </th><th>Email</th><th>Options</th></tr>
        <form name="approvemembers" id="approvemembers" method="post" action="<?php echo $currentfile; ?>">
        <?php
        //display to the screen
        //loop through the results and display to the screen
        foreach ($result as $row){
            ?>
            <tr>
                <td><?php echo $row['fname']; echo $row['lname'];?></td>
                <td><?php echo $row['eml'];?></td>
                <td>
                    <?php if ($_SESSION['ID'] == $row['id'] || $_SESSION['status'] == 2) {?>
                        <a href="update.php?q=<?php echo $row['id'];?>">Update</a>
                        <a href="changepwd.php?q=<?php echo $row['id'];?>">Change Password</a>
                    <?php } ?>

                </td>
            </tr>
            <?php
        }//foreach
        ?>

        </form>
    </table>
</div></div>

<div class="columnright">
    <div class="section">
        <h2>Insert info here! Maybe: # of inspections completed in year, weather?</h2>
    </div>
</div>
<?php
require_once "footer.php";
?>