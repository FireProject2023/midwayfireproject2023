<?php
$pagename = "Edit Address";
require_once "header.php";
$currentfile = "editaddress.php";

//check if user came from address page
if ((isset($_SESSION['referAddress']) && $_SESSION['referAddress']===TRUE )) {
    $refer=1;
} else {
    $refer="";
}

//get id
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $_SESSION['idEditAdd'] = $_GET['q'];
}

//make sure user came from the Member List
if ($refer != 1)  {
    echo "<p class='error'>You cannot access this page directly.</p>";
    ?>
    <a href="address.php">Return to Address Search</a>
    <?php
} else {


$showform = 1;
$errexists = "";
$errName = "";
$errAddress = "";
$errOwner = "";
$errPhone = "";
$errEmail = "";
$errBuildOwner = "";
$idAddress = $_SESSION['idEditAdd'];

//form processing
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $address = trim($_POST['address']);
    $busName = trim($_POST['busName']);
    $complex = trim($_POST['complex']);
    $busOwner = trim($_POST['busOwner']);
    $busPhone = trim($_POST['busPhone']);
    $busEmail = trim($_POST['busEmail']);
    $cellPhone = trim($_POST['cellPhone']);
    $buildingOwner = trim($_POST['buildingOwner']);
    $buildPhone= trim($_POST['buildPhone']);



    if (empty($address)) {
        $errexists = 1;
        $errAddress = " Address required.";
    }
    if (empty($busName)) {
        $errexists = 1;
        $errName = " Business name required.";
    }
    if(empty($busOwner)) {
        $errexists = 1;
        $errOwner = " Business Owner name is required.";
    }
    if (empty($busPhone) && empty($cellPhone)) {
        $errexists = 1;
        $errPhone = " At least one phone number is required.";
    }
    if(empty($busEmail)) {
        $errexists = 1;
        $errEmail = " Email is required.";
    }
    if(empty($buildingOwner)) {
        $errexists = 1;
        $errBuildOwner = " Building Owner is required.";
    }


    if ($errexists == 1) {
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    } else {
        //No errors, insert into database
        $sql = "UPDATE address SET address = :address, busName = :busName, complex = :complex, busOwner = :busOwner, busPhone = :busPhone, busEmail = :busEmail, cellphone = :cellphone, buildingOwner = :buildingOwner, buildPhone = :buildPhone WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':busName', $busName);
        $stmt->bindValue(':complex', $complex);
        $stmt->bindValue(':busOwner', $busOwner);
        $stmt->bindValue(':busPhone', $busPhone);
        $stmt->bindValue(':busEmail', $busEmail);
        $stmt->bindValue(':cellphone', $cellPhone);
        $stmt->bindValue(':buildingOwner', $buildingOwner);
        $stmt->bindValue(':buildPhone', $buildPhone);
        $stmt->bindValue(':id', $idAddress);
        $stmt->execute();

        //success message
        echo "<p class='success'>Changes have been submitted.</p>";
        //hide form
        $showform = 0;
    }
}

if ($showform==1) {
    $sql = "SELECT * from address WHERE id = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':ID', $idAddress);
    $stmt->execute();
    $row = $stmt->fetch();
    ?>

    <form name="addAddress" id="addAddress" method="post" action="<?php echo $currentfile; ?>" enctype="multipart/form-data">
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" placeholder="Address" maxlength="255" value ="<?php if (isset($address) && (!empty($address))) {
            echo htmlspecialchars($address, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['address'], ENT_QUOTES, "UTF-8");}?>">
        <?php if (!empty($errAddress)) {echo "<span class ='error'>$errAddress</span>"; } ?>
        <label for="busName">Business Name:</label>
        <input type="text" name="busName" id="busName" placeholder="Business Name" maxlength="255" value ="<?php if (isset($busName) && (!empty($busName))) {
            echo htmlspecialchars($busName, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['busName'], ENT_QUOTES, "UTF-8");}?>">
        <?php if (!empty($errName)) {echo "<span class ='error'>$errName</span>"; } ?>
        <label for="complex">Complex:</label>
        <input type="text" name="complex" id="complex" placeholder="Complex" maxlength="255" value ="<?php if (isset($complex) && (!empty($complex))) {
            echo htmlspecialchars($complex, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['complex'], ENT_QUOTES, "UTF-8");}?>">

        <label for="busOwner">Business Owner:</label>
        <input type="text" name="busOwner" id="busOwner" placeholder="Business Owner Name" maxlength="255" value ="<?php if (isset($busOwner) && (!empty($busOwner))) {
            echo htmlspecialchars($busOwner, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['busOwner'], ENT_QUOTES, "UTF-8");}?>">
        <?php if (!empty($errOwner)) {echo "<span class ='error'>$errOwner</span>"; } ?>
        <label for="busPhone">Business Phone:</label>
        <input type="text" name="busPhone" id="busPhone" placeholder="555-555-5555" maxlength="255" value ="<?php if (isset($busPhone) && (!empty($busPhone))) {
            echo htmlspecialchars($busPhone, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['busPhone'], ENT_QUOTES, "UTF-8");}?>">
        <?php if (!empty($errPhone)) {echo "<span class ='error'>$errPhone</span>"; } ?>
        <label for="busEmail">Business Email:</label>
        <input type="text" name="busEmail" id="busEmail" placeholder="Email" maxlength="255" value ="<?php if (isset($busEmail) && (!empty($busEmail))) {
            echo htmlspecialchars($busEmail, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['busEmail'], ENT_QUOTES, "UTF-8");}?>">
        <?php if (!empty($errEmail)) {echo "<span class ='error'>$errEmail</span>"; } ?>
        <label for="cellPhone">Cell Phone:</label>
        <input type="text" name="cellPhone" id="cellPhone" placeholder="555-555-5555" maxlength="255" value ="<?php if (isset($cellPhone) && (!empty($cellPhone))) {
            echo htmlspecialchars($cellPhone, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['cellphone'], ENT_QUOTES, "UTF-8");}?>">
        <br><br>
        <?php if (!empty($errPhone)) {echo "<span class ='error'>$errPhone</span>"; } ?>
        <label for="buildingOwner">Building Owner:</label>
        <input type="text" name="buildingOwner" id="buildingOwner" placeholder="Building Owner Name" maxlength="255" value ="<?php if (isset($buildingOwner) && (!empty($buildingOwner))) {
            echo htmlspecialchars($buildingOwner, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['buildingOwner'], ENT_QUOTES, "UTF-8");}?>">
        <?php if (!empty($errBuildOwner)) {echo "<span class ='error'>$errBuildOwner</span>"; } ?><br><br>
        <label for="buildPhone">Building Phone:</label>
        <input type="text" name="buildPhone" id="buildPhone" placeholder="555-555-5555" maxlength="255" value ="<?php if (isset($buildPhone) && (!empty($buildPhone))) {
            echo htmlspecialchars($buildPhone, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['buildPhone'], ENT_QUOTES, "UTF-8");}?>">
        <br>

        <input type="submit" name="submit" id="submit" value="Submit">
    </form>
    <?php
}//close refer
}//close showform
require_once "footer.php";

?>
