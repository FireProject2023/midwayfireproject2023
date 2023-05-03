<?php
$pagename = "Addresses";
require_once "header.php";
$currentfile = "address.php";

//check if user is logged in
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
        $sql = "SELECT id, address, busOwner, busPhone, busEmail, buildingOwner FROM address WHERE address LIKE :term OR buildingOwner LIKE :term OR busOwner LIKE :term";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':term', $term);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //no results
        if(empty($result)) {
            echo "<p class='error'>Nothing found matching " . htmlspecialchars($_GET['term']) . ". Please try again or <a href='addaddress.php'>Add Address</a></p>";
        }//if result empty
    }//if term empty
}//close submit


?>
    <a class="button" href='addaddress.php'>Add Address</a> <br><br>
    <div class="section">
        <form name="empsearch" id="empsearch" method="get" action="<?php echo $currentfile; ?>">
            <label for="term">Please enter the address, business owner name, or building owner name:</label><br>
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
        <tr><th>Address</th><th>Business Owner</th><th>Business Phone</th><th>Email</th><th>Building Owner</th></tr>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row['address'];?></td>
                <td><?php echo $row['busOwner'];?></td>
                <td><?php echo $row['busPhone'];?></td>
                <td><?php echo $row['busEmail'];?></td>
                <td><?php echo $row['buildingOwner'];?></td>
                <td><a href="viewaddress.php?q=<?php echo $row['id'];?>">View</a> <a href="editaddress.php?q=<?php echo $row['id'];?>">Edit</a></td>
            </tr>
        <?php }//close foreach ?>
    </table>

    <?php
}//foreach
echo "<br>";
require_once "footer.php";
?>