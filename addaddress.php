<?php
$pagename = "Add Address";
require_once "header.php";
$currentfile = "addaddress.php";

//check if user is logged in
checkLogin();

$showform = 1;
$errexists = "";
$errName = "";
$errAddress = "";
$errOwner = "";
$errPhone = "";
$errEmail = "";
$errBuildOwner = "";


//form processing
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $address = $_POST['address'];
    $busName = $_POST['busName'];
    $complex = $_POST['complex'];
    $busOwner = $_POST['busOwner'];
    $busPhone = $_POST['busPhone'];
    $busEmail = $_POST['busEmail'];
    $cellPhone = $_POST['cellPhone'];
    $buildingOwner = $_POST['buildingOwner'];
    $buildPhone= $_POST['buildPhone'];

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
    $sql = "INSERT INTO address (address, busName, complex, busOwner, busPhone, busEmail, cellphone, buildingOwner, buildPhone )
                            VALUES (:address, :busName, :complex, :busOwner, :busPhone,:busEmail, :cellphone, :buildingOwner, :buildPhone)";
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
    $stmt->execute();

    //success message
    echo "<p class='success'>Form successfully submitted.</p>";
    //hide form
    $showform = 0;
}
}

if ($showform==1) {
?>

<form name="addAddress" id="addAddress" method="post" action="<?php echo $currentfile; ?>" enctype="multipart/form-data">
    <label for="address">Address:</label>
    <input type="text" name="address" id="address" placeholder="Address" maxlength="255" value="<?php if (isset($address)) {echo htmlspecialchars($address, ENT_QUOTES, "UTF-8");}?>">
    <?php if (!empty($errAddress)) {echo "<span class ='error'>$errAddress</span>"; } ?>
    <label for="busName">Business Name:</label>
    <input type="text" name="busName" id="busName" placeholder="Business Name" maxlength="255" value="<?php if (isset($busName)) {echo htmlspecialchars($busName, ENT_QUOTES, "UTF-8");}?>">
    <?php if (!empty($errName)) {echo "<span class ='error'>$errName</span>"; } ?>
    <label for="complex">Complex:</label>
    <input type="text" name="complex" id="complex" placeholder="Complex" maxlength="255" value="<?php if (isset($complex)) {echo htmlspecialchars($complex, ENT_QUOTES, "UTF-8");}?>">

    <label for="busOwner">Business Owner:</label>
    <input type="text" name="busOwner" id="busOwner" placeholder="Business Owner Name" maxlength="255" value="<?php if (isset($busOwner)) {echo htmlspecialchars($busOwner, ENT_QUOTES, "UTF-8");}?>">
    <?php if (!empty($errOwner)) {echo "<span class ='error'>$errOwner</span>"; } ?>
    <label for="busPhone">Business Phone:</label>
    <input type="text" name="busPhone" id="busPhone" placeholder="555-555-5555" maxlength="255" value="<?php if (isset($busPhone)) {echo htmlspecialchars($busPhone, ENT_QUOTES, "UTF-8");}?>">
    <?php if (!empty($errPhone)) {echo "<span class ='error'>$errPhone</span>"; } ?>
    <label for="busEmail">Business Email:</label>
    <input type="text" name="busEmail" id="busEmail" placeholder="Email" maxlength="255" value="<?php if (isset($busEmail)) {echo htmlspecialchars($busEmail, ENT_QUOTES, "UTF-8");}?>">
    <?php if (!empty($errEmail)) {echo "<span class ='error'>$errEmail</span>"; } ?>
    <label for="cellPhone">Cell Phone:</label>
    <input type="text" name="cellPhone" id="cellPhone" placeholder="555-555-5555" maxlength="255" value="<?php if (isset($cellPhone)) {echo htmlspecialchars($cellPhone, ENT_QUOTES, "UTF-8");}?>">
    <br><br>
    <?php if (!empty($errPhone)) {echo "<span class ='error'>$errPhone</span>"; } ?>
    <label for="buildingOwner">Building Owner:</label>
    <input type="text" name="buildingOwner" id="buildingOwner" placeholder="Building Owner Name" maxlength="255" value="<?php if (isset($buildingOwner)) {echo htmlspecialchars($buildingOwner, ENT_QUOTES, "UTF-8");}?>">
    <?php if (!empty($errBuildOwner)) {echo "<span class ='error'>$errBuildOwner</span>"; } ?><br><br>
    <label for="buildPhone">Building Phone:</label>
    <input type="text" name="buildPhone" id="buildPhone" placeholder="555-555-5555" maxlength="255" value="<?php if (isset($buildPhone)) {echo htmlspecialchars($buildPhone, ENT_QUOTES, "UTF-8");}?>">
    <br>

    <input type="submit" name="submit" id="submit" value="Submit">
</form>
<?php
}//close showform
require_once "footer.php";

?>
