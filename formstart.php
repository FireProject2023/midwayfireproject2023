<?php

$pagename = "Form Start";
require_once "header.php";
$currentfile = "formstart.php";

checkLogin();

//form processing
if(isset($_GET['submit'])) {
    //if search box was left empty
    if (empty($_GET['term'])) {
        echo "<p class ='error'>Search box empty, please try again.</p>";
    } else {
        //local variable & sanitization
        $term = trim($_GET['term']) . "%";
        //query database
        $sql = "SELECT address, buildOwner, busOwner FROM address WHERE address LIKE :term OR buildOwner LIKE :term OR busOwner LIKE :term";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':term', $term);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //no results
        if(empty($result)) {
            echo "<p class='error'>Nothing found matching " . htmlspecialchars($_GET['term']) . ". Please try again.</p>";
        }//if result empty
    }//if term empty
}//close submit


?>

<div class="section">
    <p>Please enter the address or name for the inspection.</p>
    <form name="empsearch" id="empsearch" method="get" action="<?php echo $currentfile; ?>">
        <label for="term">Search:</label><br>
        <input type="text" id="term" name="term" placeholder="Address, Building Owner, or Business Owner"><br>
        <input type="submit" id="submit" name="submit" value="submit">
    </form>
</div>


<?php
//print results
if(!empty($result)) {
    echo "<p class='success'>The following results match " . htmlspecialchars($_GET['term']) . ".</p>";
    ?>

    <table>
        <tr><th>Address</th><th>Building Owner</th><th>Business Owner</th><th>Forms</th></tr>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row['address'];?></td>
                <td><?php echo $row['buildOwner'];?></td>
                <td><?php echo $row['busOwner'];?></td>
                <td><a href="cot.php">Change of Tenant</a> <a href="fls.php">Fire & Life Safety</a> <a href="sfi.php">Fire Investigation</a></td>
            </tr>
        <?php }//close foreach ?>
    </table>

    <?php
}//foreach
echo "<br>";
require_once "footer.php";
?>