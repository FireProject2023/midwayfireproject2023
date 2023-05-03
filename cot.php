<?php
$pagename = "COT Form";
require_once "header.php";
$currentfile = "cot.php";

//check if user is logged in
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $_SESSION['idAddress'] = $_GET['q'];
}

//initial variabless
$showform = 1;
$errexists = "";
$errInspect = "";
$errOccur = "";
$errPF = "";
$errInspector = "";
$errBusRep = "";
$reqAtt = " ";
$signature = "";
$idAddress = $_SESSION['idAddress'];

//form processing
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //local variables & sanitization
    $typeChoice = $_POST['inspect_type'];
    $inspectOccur = $_POST['inspectOccur'];
    $passfail = $_POST['passfail'];
    $reqAtt = $_POST['reqAtt'];
    $notes = trim($_POST['addNotes']);
    $inspector = trim($_POST['inspector']);
    $busRep = trim($_POST['busRep']);

    //Error checking & validation
    if (empty($typeChoice)) {
        $errexists = 1;
        $errInspect = " Missing form type selection.";
    }
    if (empty($inspectOccur)) {
        $errexists = 1;
        $errOccur = " Missing inspection occurance.";
    }
    if (empty($passfail)) {
        $errexists = 1;
        $errPF = " Missing inspection status.";
    }

    if (empty($reqAtt)) {
        $requireAtt = "None";
    } else {
        $requireAtt = implode(" ", $reqAtt);
    }

    if (empty($notes)) {
        $notes = "None";
    }

    if (empty($inspector)) {
        $errexists = 1;
        $errInspector = " Please enter inspector name.";
    }
    if (empty($busRep)) {
        $errexists = 1;
        $errBusRep = " Please enter business representitive name.";
    }



    //General error message
    if ($errexists == 1) {
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    } else {
        //No errors, insert into database
        $created = date("Y-m-d H:i:s");

        //insert data into database
        $sql = "INSERT INTO formcot (idAddress, inspectType, inspectOccur, passFail, areasRequire, comments, inspector, busRep, signature, created )
                            VALUES (:address, :inspectType, :inspectOccur, :passFail, :reqAtt,:notes, :inspector, :busRep, :signature, :created)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':address', $idAddress);
        $stmt->bindValue(':inspectType', $typeChoice);
        $stmt->bindValue(':inspectOccur', $inspectOccur);
        $stmt->bindValue(':passFail', $passfail);
        $stmt->bindValue(':reqAtt', $requireAtt);
        $stmt->bindValue(':notes', $notes);
        $stmt->bindValue(':inspector', $inspector);
        $stmt->bindValue(':busRep', $busRep);
        $stmt->bindValue(':signature', $signature);
        $stmt->bindValue(':created', $created);
        $stmt->execute();

        //success message
        echo "<p class='success'>Form successfully submitted.</p>";
        //hide form
        $showform = 0;

    }//close else no errors
}//close if req method is post

//If the form has not been submitted, display the form.
if ($showform == 1) {
?>
<p>Please enter the following information. All fields are required unless otherwise stated.</p>
<form name="cot" id="cot" method="post" action="<?php echo $currentfile; ?>" enctype="multipart/form-data">


<div class="section">
    <h3>Please select the Inspection Type(s):</h3>

        <input type="radio" id="COTen" name="inspect_type" value="Change_of_Tenant" <?php if(isset($_POST['inspect_type']) && $_POST['inspect_type'] =='Change_of_Tenant' ){echo "checked";}?> ><label for="COTen">Change of Tenant (No construction work | Fire Inspection Required)</label>
        <input type="radio" id="commercial" name="inspect_type" value="Commercial" <?php if(isset($_POST['inspect_type']) && $_POST['inspect_type'] =='Commercial' ){echo "checked";}?>><label for="commercial" >Commercial (Any/All construction work | Building Permit Required)</label>
        <input type="radio" id="fps" name="inspect_type" value="Fire_Protection_System" <?php if(isset($_POST['inspect_type']) && $_POST['inspect_type'] =='Fire_Protection_System' ){echo "checked";}?>><label for="fps">Fire Protection System</label>
        <input type="radio" id="res" name="inspect_type" value="Residential <?php if(isset($_POST['inspect_type']) && $_POST['inspect_type'] =='Residential' ){echo "checked";}?>"><label for="res">Residential</label>
        <input type="radio" id="smokeAlarm" name="inspect_type" value="Smoke_Alarm" <?php if(isset($_POST['inspect_type']) && $_POST['inspect_type'] =='Smoke_Alarm' ){echo "checked";}?>><label for="smokeAlarm">Smoke Alarm</label>
        <?php if (!empty($errInspect)) {echo "<span class ='error'>$errInspect</span>"; } ?>

</div>

<div class="section">
        <h3>Inspection Occurance:</h3>
        <input type="radio" id="inspectOccurR" name="inspectOccur" value="Rough_In" <?php if(isset($_POST['inspectOccur']) && $_POST['inspectOccur'] =='Rough_In' ){echo "checked";}?>>
        <label for="inspectOccurR">Rough-In</label><br>
        <input type="radio" id="inspectOccurF" name="inspectOccur" value="Final" <?php if(isset($_POST['inspectOccur']) && $_POST['inspectOccur'] =='Final' ){echo "checked";}?>>
        <label for="inspectOccurF">Final</label><br>
        <?php if (!empty($errOccur)) {echo "<span class ='error'>$errOccur</span>"; } ?>
</div>

<div class="section">
    <h3>Status:</h3>
    <input type="radio" id="passed" name="passfail" value="passed" <?php if(isset($_POST['passfail']) && $_POST['passfail'] =='passed' ){echo "checked";}?>>
    <label for="passed">PASSED - All Fire and Life Safety Code requirements for listed project complete</label><br>
    <input type="radio" id="failed" name="passfail" value="failed" <?php if(isset($_POST['passfail']) && $_POST['passfail'] =='failed' ){echo "checked";}?>>
    <label for="failed">FAILED - The following Fire and Life Safety Code requirements for listed project incomplete. Schedule follow-up inspections allowing 72-Hour notice.</label><br>
    <?php if (!empty($errPF)) {echo "<span class ='error'>$errPF</span>"; } ?>
</div>

<div class="section">
    <h3>Areas Requiring Attention</h3>
    <input type="checkbox" id="addDis" name="reqAtt[]" value="Add_Displayed" <?php if (in_array("Add_Displayed", $_POST['reqAtt'])) echo "checked"; ?> >
    <label for="addDis">Address Displayed</label>
    <input type="checkbox" id="exitLight" name="reqAtt[]" value="Exit_Light" <?php if (in_array("Exit_Light", $_POST['reqAtt'])) echo "checked='checked'"; ?> >
    <label for="exitLight">Exit/Emergency Lights</label>
    <input type="checkbox" id="fireExt" name="reqAtt[]" value="Fire_Extinguisher" <?php if (in_array("Fire_Extinguisher", $_POST['reqAtt'])) echo "checked='checked'"; ?>>
    <label for="fireExt">Fire Extinguisher(s)</label>
    <input type="checkbox" id="sprinkSys" name="reqAtt[]" value="Sprinkler_System" <?php if (in_array("Sprinkler_System", $_POST['reqAtt'])) echo "checked='checked'"; ?>>
    <label for="sprinkSys">Sprinkler System - Standpipe System</label>
    <input type="checkbox" id="alarmSys" name="reqAtt[]" value="Alarm_System" <?php if (in_array("Alarm_System", $_POST['reqAtt'])) echo "checked='checked'"; ?>>
    <label for="alarmSys">Alarm System</label>
    <input type="checkbox" id="exits" name="reqAtt[]" value="emerg_Exit" <?php if (in_array("emerg_Exit", $_POST['reqAtt'])) echo "checked='checked'"; ?>>
    <label for="exits">Emergency Exit/Exitways</label>
    <input type="checkbox" id="hoodSuppress" name="reqAtt[]" value="Hood_Suppression" <?php if (in_array("Hood_Suppression", $_POST['reqAtt'])) echo "checked='checked'"; ?>>
    <label for="hoodSuppress">Hood suppression</label>
    <input type="checkbox" id="hoodVentilation" name="reqAtt[]" value="Hood_Ventilation"<?php if (in_array("Hood_Ventilation", $_POST['reqAtt'])) echo "checked='checked'"; ?>>
    <label for="hoodVentilation">Hood Ventilation System Clean</label>
    <input type="checkbox" id="electricPanel" name="reqAtt[]" value="Electric_Panel" <?php if (in_array("Electric_Panel", $_POST['reqAtt'])) echo "checked='checked'"; ?>>
    <label for="electricPanel">Electrical Panels</label>
    <input type="checkbox" id="knoxBox" name="reqAtt[]" value="knox_Box" <?php if (in_array("knox_Box", $_POST['reqAtt'])) echo "checked='checked'"; ?>
    <label for="knoxBox">Knox Box</label><br>
</div>

    <label for="addNotes">Additional Notes/Comments:</label> <br>
    <textarea id="addNotes" name="addNotes" rows="5"><?php if (isset($notes)) {echo $notes;}?></textarea>
    <br><br><br>


    <label for="inspector">Inspector: </label>
    <input type="text" id="inspector" name="inspector" value="<?php if (isset($inspector)) {echo htmlspecialchars($inspector, ENT_QUOTES, "UTF-8");}?>">
    <?php if (!empty($errInspector)) {echo "<span class ='error'>$errInspector</span>"; } ?>
    <label for="busRep">Business Representative: </label>
    <input type="text" id="busRep" name="busRep" value="<?php if (isset($busRep)) {echo htmlspecialchars($busRep, ENT_QUOTES, "UTF-8");}?>">
    <?php if (!empty($errBusRep)) {echo "<span class ='error'>$errBusRep</span>"; } ?>
    <br><br>
    <label for="signature-pad">Business Representative Signature: </label>
    <div class="wrapper">
    <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
    </div><br>

    <button id="clear">Clear</button>
    <br><br>

    <input type="submit" name="submit" id="submit" value="Submit">


</form>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="javascript/signature.js"></script>
<?php

}//close showform
    require_once "footer.php";
?>