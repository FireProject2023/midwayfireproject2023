<?php
$pagename = "Fire & Life Safety Form";
require_once "header.php";
$currentfile = "fls.php";

//check if user is logged in
checkLogin();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $_SESSION['idAddress'] = $_GET['q'];
}

$signature = "";

//initial variables
$showform = 1;
$errexists = "";
$errExit = "";
$errElec = "";
$errMisc = "";
$errFpse = "";
$errRois = "";
$errResult = "";
$errInspect = "";
$errRepresent = "";
$errFollowUp = "";
$errDate = "";
$idAddress = $_SESSION['idAddress'];

//form processing
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //local variables & sanitization
    $exit1 = $_POST['exit1'];
    $exit2 = $_POST['exit2'];
    $exit3 = $_POST['exit3'];
    $exit4 = $_POST['exit4'];
    $exitComments = trim($_POST['exitComments']);
    $elec1 = $_POST['elec1'];
    $elec2 = $_POST['elec2'];
    $elec3 = $_POST['elec3'];
    $elec4 = $_POST['elec4'];
    $elecComments = trim($_POST['elecComments']);
    $misc1 = $_POST['misc1'];
    $misc2 = $_POST['misc2'];
    $misc3 = $_POST['misc3'];
    $misc4 = $_POST['misc4'];
    $misc5 = $_POST['misc5'];
    $misc6 = $_POST['misc6'];
    $misc7 = $_POST['misc7'];
    $miscComments = trim($_POST['miscComments']);
    $fpse1 = $_POST['fpse1'];
    $fpse2 = $_POST['fpse2'];
    $fpse3 = $_POST['fpse3'];
    $fpse4 = $_POST['fpse4'];
    $fpse5 = $_POST['fpse5'];
    $fpse6 = $_POST['fpse6'];
    $fpse7 = $_POST['fpse7'];
    $fpse8 = $_POST['fpse8'];
    $fpseComments = trim($_POST['fpseComments']);
    $smokeNum = $_POST['smokeNum'];
    $smokeMiss = $_POST['smokeMiss'];
    $smokeDisc = $_POST['smokeDisc'];
    $smokeOld = $_POST['smokeOld'];
    $rois1= $_POST['rois1'];
    $rois2= $_POST['rois2'];
    $rois3= $_POST['rois3'];
    $rois4= $_POST['rois4'];
    $rois5= $_POST['rois5'];
    $rois6= $_POST['rois6'];
    $rois7= $_POST['rois7'];
    $rois8= $_POST['rois8'];
    $inspectResults= $_POST['inspectResults'];
    $inspector = trim($_POST['inspector']);
    $represent = trim($_POST['represent']);


    //Error checking & validation
    if (empty($exit1) || empty($exit2) || empty($exit3) || empty($exit4)) {$errexists = 1; $errExit = " All fields required.";}

    if (empty($elec1) || empty($elec2) || empty($elec3) || empty($elec4)) {$errexists = 1; $errElec = " All fields required.";}

    if (empty($misc1) || empty($misc2) || empty($misc3) || empty($misc4) || empty($misc5) || empty($misc6) || empty($misc7)) {$errexists = 1; $errMisc = " All fields required.";}

    if (empty($fpse1) || empty($fpse2) || empty($fpse3) || empty($fpse4) || empty($fpse5) || empty($fpse6) || empty($fpse7) || empty($fpse8)) {$errexists = 1; $errFpse = " All fields required.";}

    if (empty($smokeNum)) { $smokeNum=0;}
    if (empty($smokeMiss)) { $smokeMiss=0;}
    if (empty($smokeDisc)) { $smokeDisc=0;}
    if (empty($smokeOld)) { $smokeOld=0;}

    if (empty($rois1) || empty($rois2) || empty($rois3) || empty($rois4) || empty($rois5) || empty($rois6) || empty($rois7) || empty($rois8)) {$errexists = 1; $errRois = " All fields required.";}

    if (empty($inspectResults)) {
        $errexists = 1;
        $errResult = "Select the inspection result.";
    } else if ($inspectResults=="FLSHazard") {
        //if hazard is found, require follow date and occurrence fields.
        $followUp= $_POST['followUp'];
        $followUpDate = $_POST['followUpDate'];
        if (empty($followUp)) { $errexists=1; $errFollowUp = " Follow-up occurrence required.";}
        if (empty($followUpDate)) { $errexists=1; $errDate = " Follow-up date required.";}
    }//close hazard detected
    else {
        $followUp = 1;
        $followUpDate = "";
    }

    if (empty($inspector)) {
        $errexists = 1;
        $errInspect = " Enter the inspector name.";
    }
    if (empty($represent)) {
        $errexists = 1;
        $errRepresent = " Enter the representative name.";
    }

    //General error message
    if ($errexists == 1) {
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    } else {
        //No errors, insert into database
        $created = date("Y-m-d H:i:s");

        //insert data into database
        $sql = "INSERT INTO formfls (idAddress, exit1, exit2, exit3, exit4, exitComments, elec1, elec2, elec3, elec4, elecComments,
                                    misc1, misc2, misc3, misc4, misc5, misc6, misc7, miscComments,
                                    fpse1, fpse2, fpse3, fpse4, fpse5, fpse6, fpse7, fpse8, fpseComments,
                                    smokeNum, smokeMiss, smokeDisc, smokeOld,
                                    rois1, rois2, rois3, rois4, rois5, rois6, rois7, rois8, 
                                    inspectResults, followUpDate, followUp, inspector, represent, signature, created)
                            VALUES (:idAddress, :exit1, :exit2, :exit3, :exit4, :exitComments, :elec1, :elec2, :elec3, :elec4, :elecComments,
                                    :misc1, :misc2, :misc3, :misc4, :misc5, :misc6, :misc7, :miscComments,
                                    :fpse1, :fpse2, :fpse3, :fpse4, :fpse5, :fpse6, :fpse7, :fpse8, :fpseComments,
                                    :smokeNum, :smokeMiss, :smokeDisc, :smokeOld,
                                    :rois1, :rois2, :rois3, :rois4, :rois5, :rois6, :rois7, :rois8,
                                    :inspectResults, :followUpDate, :followUp, :inspector, :represent, :signature, :created)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':idAddress', $idAddress);
        $stmt->bindValue(':exit1', $exit1);
        $stmt->bindValue(':exit2', $exit2);
        $stmt->bindValue(':exit3', $exit3);
        $stmt->bindValue(':exit4', $exit4);
        $stmt->bindValue(':exitComments', $exitComments);
        $stmt->bindValue(':elec1', $elec1);
        $stmt->bindValue(':elec2', $elec2);
        $stmt->bindValue(':elec3', $elec3);
        $stmt->bindValue(':elec4', $elec4);
        $stmt->bindValue(':elecComments', $elecComments);
        $stmt->bindValue(':misc1', $misc1);
        $stmt->bindValue(':misc2', $misc2);
        $stmt->bindValue(':misc3', $misc3);
        $stmt->bindValue(':misc4', $misc1);
        $stmt->bindValue(':misc5', $misc5);
        $stmt->bindValue(':misc6', $misc6);
        $stmt->bindValue(':misc7', $misc7);
        $stmt->bindValue(':miscComments', $miscComments);
        $stmt->bindValue(':fpse1', $fpse1);
        $stmt->bindValue(':fpse2', $fpse2);
        $stmt->bindValue(':fpse3', $fpse3);
        $stmt->bindValue(':fpse4', $fpse4);
        $stmt->bindValue(':fpse5', $fpse5);
        $stmt->bindValue(':fpse6', $fpse6);
        $stmt->bindValue(':fpse7', $fpse7);
        $stmt->bindValue(':fpse8', $fpse8);
        $stmt->bindValue(':fpseComments', $fpseComments);
        $stmt->bindValue(':smokeNum', $smokeNum);
        $stmt->bindValue(':smokeOld', $smokeOld);
        $stmt->bindValue(':smokeMiss', $smokeMiss);
        $stmt->bindValue(':smokeDisc', $smokeDisc);
        $stmt->bindValue(':rois1', $rois1);
        $stmt->bindValue(':rois2', $rois2);
        $stmt->bindValue(':rois3', $rois3);
        $stmt->bindValue(':rois4', $rois4);
        $stmt->bindValue(':rois5', $rois5);
        $stmt->bindValue(':rois6', $rois6);
        $stmt->bindValue(':rois7', $rois7);
        $stmt->bindValue(':rois8', $rois8);
        $stmt->bindValue(':inspectResults', $inspectResults);
        $stmt->bindValue(':followUpDate', $followUpDate);
        $stmt->bindValue(':followUp', $followUp);
        $stmt->bindValue(':inspector', $inspector);
        $stmt->bindValue(':represent', $represent);
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
if ($showform == 1) { ?>

<form name="flsForm" id="flsForm" method="post" action="<?php echo $currentfile; ?>" enctype="multipart/form-data">

    <h3>ACCESS/EGRESS/EXITS</h3>
    <table id="accessEgress">
        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes1" name="exit1" value="yes" <?php if(isset($_POST['exit1']) && $_POST['exit1'] =='yes' ){echo "checked";}?> >
                    <label for="yes1">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no1" name="exit1" value="no" <?php if(isset($_POST['exit1']) && $_POST['exit1'] =='no' ){echo "checked";}?> >
                <label for="no1">N</label></div>
            </td>
            <td id="category"><p>All exit doors shall operate properly when building is occupied.</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes2" name="exit2" value="yes" <?php if(isset($_POST['exit2']) && $_POST['exit2'] =='yes' ){echo "checked";}?> >
                    <label for="yes2">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no2" name="exit2" value="no" <?php if(isset($_POST['exit2']) && $_POST['exit2'] =='no' ){echo "checked";}?> >
                    <label for="no2">N</label></div>
            </td>
            <td id="category"><p>All designated exit isles, exit doors, and exit discharges shall remain free of obstruction at all times</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes3" name="exit3" value="yes" <?php if(isset($_POST['exit3']) && $_POST['exit3'] =='yes' ){echo "checked";}?> >
                    <label for="yes3">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no3" name="exit3" value="no" <?php if(isset($_POST['exit3']) && $_POST['exit3'] =='no' ){echo "checked";}?> >
                    <label for="no3">N</label></div>
            </td>
            <td id="category"><p>All required exit signs shall be properly maintained.</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes4" name="exit4" value="yes" <?php if(isset($_POST['exit4']) && $_POST['exit4'] =='yes' ){echo "checked";}?> >
                    <label for="yes4">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no4" name="exit4" value="no" <?php if(isset($_POST['exit4']) && $_POST['exit4'] =='no' ){echo "checked";}?> >
                    <label for="no4">N</label></div>
            </td>
            <td id="category"><p>All required emergency lights shall be properly maintained</p></td>
        </tr>
    </table>
    <?php if (!empty($errExit)) {echo "<span class ='error'>$errExit</span>"; } ?>
    <label for="exitComments">Notes/Comments:</label> <br>
    <textarea id="exitComments" name="exitComments" rows="5"><?php if (isset($exitComments)) {echo $exitComments;}?></textarea>


    <h3>ELECTRICAL COMPONENTS</h3>
    <table id="electricComp">
        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes5" name="elec1" value="yes" <?php if(isset($_POST['elec1']) && $_POST['elec1'] =='yes' ){echo "checked";}?> >
                    <label for="yes5">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no5" name="elec1" value="no" <?php if(isset($_POST['elec1']) && $_POST['elec1'] =='no' ){echo "checked";}?> >
                    <label for="no5">N</label></div>
            </td>
            <td id="category"><p>36in front and 30in side clearance maintained for: Electric Panels, Water Heaters, HVAC Equipment, & Cooking Equipment</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes6" name="elec2" value="yes" <?php if(isset($_POST['elec2']) && $_POST['elec2'] =='yes' ){echo "checked";}?> >
                    <label for="yes6">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no6" name="elec2" value="no" <?php if(isset($_POST['elec2']) && $_POST['elec2'] =='no' ){echo "checked";}?> >
                    <label for="no6">N</label></div>
            </td>
            <td id="category"><p> Extension cords shall not be plugged into appliances, utilized as permanent wiring, or extended through ceilings, walls, or doorway</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes7" name="elec3" value="yes" <?php if(isset($_POST['elec3']) && $_POST['elec3'] =='yes' ){echo "checked";}?> >
                    <label for="yes7">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no7" name="elec3" value="no" <?php if(isset($_POST['elec3']) && $_POST['elec3'] =='no' ){echo "checked";}?> >
                    <label for="no7">N</label></div>
            </td>
            <td id="category"><p> Power strips shall be FM or UL Listed, and have built-in surge protection</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes8" name="elec4" value="yes" <?php if(isset($_POST['elec4']) && $_POST['elec4'] =='yes' ){echo "checked";}?> >
                    <label for="yes8">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no8" name="elec4" value="no" <?php if(isset($_POST['elec4']) && $_POST['elec4'] =='no' ){echo "checked";}?> >
                    <label for="no8">N</label></div>
            </td>
            <td id="category"><p> All electrical wall plugs, switch plates, and junction boxes shall be properly covered</p></td>
        </tr>
    </table>
    <?php if (!empty($errElec)) {echo "<span class ='error'>$errElec</span>"; } ?>

    <label for="elecComments">Notes/Comments:</label> <br>
    <textarea id="elecComments" name="elecComments" rows="5"><?php if (isset($elecComments)) {echo $elecComments;}?></textarea>

    <h3>MISC FIRE SAFETY ISSUES</h3>
    <table id="miscFPS">
        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes9" name="misc1" value="yes" <?php if(isset($_POST['misc1']) && $_POST['misc1'] =='yes' ){echo "checked";}?> >
                    <label for="yes9">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no9" name="misc1" value="no" <?php if(isset($_POST['misc1']) && $_POST['misc1'] =='no' ){echo "checked";}?> >
                    <label for="no9">N</label></div>
            </td>
            <td id="category"><p>Center room storage clearance shall be 18in from the bottom of sprinkler heads or 24in below ceiling in non-sprinkler buildings</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes10" name="misc2" value="yes" <?php if(isset($_POST['misc2']) && $_POST['misc2'] =='yes' ){echo "checked";}?>  >
                    <label for="yes10">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no10" name="misc2" value="no" <?php if(isset($_POST['misc2']) && $_POST['misc2'] =='no' ){echo "checked";}?> >
                    <label for="no10">N</label></div>
            </td>
            <td id="category"><p>Interior and exterior of structure is free of clutter, boxes, paper, & trash</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes11" name="misc3" value="yes" <?php if(isset($_POST['misc3']) && $_POST['misc3'] =='yes' ){echo "checked";}?> >
                    <label for="yes11">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no11" name="misc3" value="no" <?php if(isset($_POST['misc3']) && $_POST['misc3'] =='no' ){echo "checked";}?> >
                    <label for="no11">N</label></div>
            </td>
            <td id="category"><p>Fueled equipment and fuel storage containers are not stored inside of the occupancy</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes12" name="misc4" value="yes" <?php if(isset($_POST['misc4']) && $_POST['misc4'] =='yes' ){echo "checked";}?> >
                    <label for="yes12">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no12" name="misc4" value="no" <?php if(isset($_POST['misc4']) && $_POST['misc4'] =='no' ){echo "checked";}?> >
                    <label for="no12">N</label></div>
            </td>
            <td id="category"><p>Knox boxes in occupancies are in proper working order, and all building keys are clearly marked with key tags</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes13" name="misc5" value="yes" <?php if(isset($_POST['misc5']) && $_POST['misc5'] =='yes' ){echo "checked";}?> >
                    <label for="yes13">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no13" name="misc5" value="no" <?php if(isset($_POST['misc5']) && $_POST['misc5'] =='no' ){echo "checked";}?> >
                    <label for="no13">N</label></div>
            </td>
            <td id="category"><p>Business address is displayed on the front of the building and rear door</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes14" name="misc6" value="yes" <?php if(isset($_POST['misc6']) && $_POST['misc6'] =='yes' ){echo "checked";}?> >
                    <label for="yes14">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no14" name="misc6" value="no" <?php if(isset($_POST['misc6']) && $_POST['misc6'] =='no' ){echo "checked";}?> >
                    <label for="no14">N</label></div>
            </td>
            <td id="category"><p>Specialty rooms are properly labeled (Alarm System, Sprinkler Riser Room, Electrical Room, Pool Chemicals, and Elevator Controls)</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes15" name="misc7" value="yes" <?php if(isset($_POST['misc7']) && $_POST['misc7'] =='yes' ){echo "checked";}?> >
                    <label for="yes15">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no15" name="misc7" value="no" <?php if(isset($_POST['misc7']) && $_POST['misc7'] =='no' ){echo "checked";}?> >
                    <label for="no15">N</label></div>
            </td>
            <td id="category"><p>All compressed gas cylinders are secured</p></td>
        </tr>
    </table>
    <?php if (!empty($errMisc)) {echo "<span class ='error'>$errMisc</span>"; } ?>

    <label for="miscComments">Notes/Comments:</label> <br>
    <textarea id="miscComments" name="miscComments" rows="5"><?php if (isset($miscComments)) {echo $miscComments;}?></textarea>

    <h3>FPS & EQUIPMENT INSPECTIONS SHALL BE CURRENT</h3>
    <table id="miscFPS">
        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes16" name="fpse1" value="yes" <?php if(isset($_POST['fpse1']) && $_POST['fpse1'] =='yes' ){echo "checked";}?> >
                    <label for="yes16">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no16" name="fpse1" value="no" <?php if(isset($_POST['fpse1']) && $_POST['fpse1'] =='no' ){echo "checked";}?> >
                    <label for="no16">N</label></div>
            </td>
            <td id="category"><p>Fire extinguisher inspections are current & mounted properly</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes17" name="fpse2" value="yes" <?php if(isset($_POST['fpse2']) && $_POST['fpse2'] =='yes' ){echo "checked";}?> >
                    <label for="yes17">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no17" name="fpse2" value="no" <?php if(isset($_POST['fpse2']) && $_POST['fpse2'] =='no' ){echo "checked";}?> >
                    <label for="no17">N</label></div>
            </td>
            <td id="category"><p>6 month kitchen hood suppression system inspection is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes18" name="fpse3" value="yes" <?php if(isset($_POST['fpse3']) && $_POST['fpse3'] =='yes' ){echo "checked";}?> >
                    <label for="yes18">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no18" name="fpse3" value="no" <?php if(isset($_POST['fpse3']) && $_POST['fpse3'] =='no' ){echo "checked";}?> >
                    <label for="no18">N</label></div>
            </td>
            <td id="category"><p>Yearly fire sprinkler system inspection is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes19" name="fpse4" value="yes" <?php if(isset($_POST['fpse4']) && $_POST['fpse4'] =='yes' ){echo "checked";}?> >
                    <label for="yes19">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no19" name="fpse4" value="no" <?php if(isset($_POST['fpse4']) && $_POST['fpse4'] =='no' ){echo "checked";}?> >
                    <label for="no19">N</label></div>
            </td>
            <td id="category"><p>Yearly fire alarm system is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes20" name="fpse5" value="yes" <?php if(isset($_POST['fpse5']) && $_POST['fpse5'] =='yes' ){echo "checked";}?> >
                    <label for="yes20">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no20" name="fpse5" value="no" <?php if(isset($_POST['fpse5']) && $_POST['fpse5'] =='no' ){echo "checked";}?> >
                    <label for="no20">N</label></div>
            </td>
            <td id="category"><p>Maintain a 3-foot clearance in all directions around all fire protection equipment, system connection, and fire hydrants on site</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes21" name="fpse6" value="yes" <?php if(isset($_POST['fpse6']) && $_POST['fpse6'] =='yes' ){echo "checked";}?> >
                    <label for="yes21">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no21" name="fpse6" value="no" <?php if(isset($_POST['fpse6']) && $_POST['fpse6'] =='no' ){echo "checked";}?> >
                    <label for="no21">N</label></div>
            </td>
            <td id="category"><p>Kitchen hood ventilation system is clean and operational</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes22" name="fpse7" value="yes" <?php if(isset($_POST['fpse7']) && $_POST['fpse7'] =='yes' ){echo "checked";}?> >
                    <label for="yes22">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no22" name="fpse7" value="no" <?php if(isset($_POST['fpse7']) && $_POST['fpse7'] =='no' ){echo "checked";}?> >
                    <label for="no22">N</label></div>
            </td>
            <td id="category"><p>Yearly fire standpipe system inspection is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <div class="formGroup">
                <input type="radio" id="yes23" name="fpse8" value="yes" <?php if(isset($_POST['fpse8']) && $_POST['fpse8'] =='yes' ){echo "checked";}?> >
                    <label for="yes23">Y</label></div>
                <div class="formGroup">
                <input type="radio" id="no23" name="fpse8" value="no" <?php if(isset($_POST['fpse8']) && $_POST['fpse8'] =='no' ){echo "checked";}?> >
                    <label for="no23">N</label></div>
            </td>
            <td id="category"><p>All system inspection reports are available on site</p></td>
        </tr>
    </table>
    <?php if (!empty($errFpse)) {echo "<span class ='error'>$errFpse</span>"; } ?>

    <label for="fpseComments">Notes/Comments:</label> <br>
    <textarea id="fpseComments" name="fpseComments" rows="5"><?php if (isset($fpseComments)) {echo $fpseComments;}?></textarea>

    <h3>SMOKE ALARM & RESIDENTIAL OCCUPANCY INSPECTIONS</h3>
    <div class="formGroup">
    <label for="numAlarm">Number of operating smoke alarms: </label>
    <input type="number" id="numAlarm" name="smokeNum" min="0" max="50" value="<?php if (isset($smokeNum)) {echo htmlspecialchars($smokeNum, ENT_QUOTES, "UTF-8");}?>"> <br>
    </div>

        <h3>Number of smoke alarms ... </h3>
    <div class="formGroup">
    <label for="numMissing">Missing: </label>
    <input type="number" id="numMissing" name="smokeMiss" min="0" max="50" value="<?php if (isset($smokeMiss)) {echo htmlspecialchars($smokeMiss, ENT_QUOTES, "UTF-8");}?>">
    </div>
    <div class="formGroup">
        <label for="numMissingBattery">Missing Battery: </label>
    <input type="number" id="numMissingBattery" name="smokeOld" min="0" max="50" value="<?php if (isset($smokeOld)) {echo htmlspecialchars($smokeOld, ENT_QUOTES, "UTF-8");}?>">
    </div>
    <div class="formGroup">
        <label for="numDisconnect">10-year smoke alarms: </label>
    <input type="number" id="numDisconnect" name="smokeDisc" min="0" max="50" value="<?php if (isset($smokeDisc)) {echo htmlspecialchars($smokeDisc, ENT_QUOTES, "UTF-8");}?>">
    </div><div class="formGroup">
        <label for="num10">Disconnected smoke alarms: </label>
    <input type="number" id="num10" name="num10" min="0" max="50">
    </div>
    <br><br>

    <table>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes24" name="rois1" value="yes" <?php if(isset($_POST['rois1']) && $_POST['rois1'] =='yes' ){echo "checked";}?> >
                <label for="yes24">Y</label>
                <input type="radio" id="no24" name="rois1" value="no" <?php if(isset($_POST['rois1']) && $_POST['rois1'] =='no' ){echo "checked";}?> >
                <label for="no24">N</label>
            </td>
            <td id="category"><p>Reviewed educational package</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes25" name="rois2" value="yes" <?php if(isset($_POST['rois2']) && $_POST['rois2'] =='yes' ){echo "checked";}?> >
                <label for="yes25">Y</label>
                <input type="radio" id="no25" name="rois2" value="no" <?php if(isset($_POST['rois2']) && $_POST['rois2'] =='no' ){echo "checked";}?> >
                <label for="no25">N</label>
            </td>
            <td id="category"><p>Reviewed home escape plan guideline</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes26" name="rois3" value="yes" <?php if(isset($_POST['rois3']) && $_POST['rois3'] =='yes' ){echo "checked";}?> >
                <label for="yes26">Y</label>
                <input type="radio" id="no26" name="rois3" value="no" <?php if(isset($_POST['rois3']) && $_POST['rois3'] =='no' ){echo "checked";}?> >
                <label for="no26">N</label>
            </td>
            <td id="category"><p>House numbers are visible</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes27" name="rois4" value="yes" <?php if(isset($_POST['rois4']) && $_POST['rois4'] =='yes' ){echo "checked";}?> >
                <label for="yes27">Y</label>
                <input type="radio" id="no27" name="rois4" value="no" <?php if(isset($_POST['rois4']) && $_POST['rois4'] =='no' ){echo "checked";}?> >
                <label for="no27">N</label>
            </td>
            <td id="category"><p>Exit paths and stairways are free of clutter</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes28" name="rois5" value="yes" <?php if(isset($_POST['rois5']) && $_POST['rois5'] =='yes' ){echo "checked";}?> >
                <label for="yes28">Y</label>
                <input type="radio" id="no28" name="rois5" value="no" <?php if(isset($_POST['rois5']) && $_POST['rois5'] =='no' ){echo "checked";}?> >
                <label for="no28">N</label>
            </td>
            <td id="category"><p>Combustibles are 3ft away from any heat source</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes29" name="rois6" value="yes" <?php if(isset($_POST['rois6']) && $_POST['rois6'] =='yes' ){echo "checked";}?> >
                <label for="yes29">Y</label>
                <input type="radio" id="no29" name="rois6" value="no" <?php if(isset($_POST['rois6']) && $_POST['rois6'] =='no' ){echo "checked";}?> >
                <label for="no29">N</label>
            </td>
            <td id="category"><p>No extension cords under rugs or doorways</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes30" name="rois7" value="yes" <?php if(isset($_POST['rois7']) && $_POST['rois7'] =='yes' ){echo "checked";}?> >
                <label for="yes30">Y</label>
                <input type="radio" id="no30" name="rois7" value="no" <?php if(isset($_POST['rois7']) && $_POST['rois7'] =='no' ){echo "checked";}?> >
                <label for="no30">N</label>
            </td>
            <td id="category"><p>Candles placed on noncombustible surface</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes31" name="rois8" value="yes" <?php if(isset($_POST['rois8']) && $_POST['rois8'] =='yes' ){echo "checked";}?> >
                <label for="ye31">Y</label>
                <input type="radio" id="no31" name="rois8" value="no" <?php if(isset($_POST['rois8']) && $_POST['rois8'] =='no' ){echo "checked";}?> >
                <label for="no31">N</label>
            </td>
            <td id="category"><p>Home has fire extinguisher</p></td>
        </tr>
    </table>
    <?php if (!empty($errRois)) {echo "<span class ='error'>$errRois</span>"; } ?>


    <br>
    <h3>Inspection Results</h3>

    <input type="radio" id="ch1" name="inspectResults" value="noFLSHazard" <?php if(isset($_POST['inspectResults']) && $_POST['inspectResults'] =='noFLSHazard' ){echo "checked";}?>>
    <label for="ch1">No FLS Hazards were identified.</label><br>
    <input type="radio" id="ch2" name="inspectResults" value="FLSHazard" <?php if(isset($_POST['inspectResults']) && $_POST['inspectResults'] =='FLSHazard' ){echo "checked";}?>>
    <label for="ch2">FLS Hazards identified, schedule follow-up.</label><br>
    <?php if (!empty($errResult)) {echo "<span class ='error'>$errResult</span>"; } ?>

    <h3>NOTICE OF VIOLATION(S): FLS hazards were identified, a follow-up inspection is required. The owner, agent, or party in control of the occupancy may appeal this order within 30 days to the Building Code Board of Appeals.</h3>
    <br>
    <label for="fuiDate">Follow-Up Inspection Date:</label>
    <input type="text" id="fuiDate" name="followUpDate" rows="1" maxlength="255" value="<?php if (isset($followUpDate)) {echo htmlspecialchars($followUpDate, ENT_QUOTES, "UTF-8");}?>">
    <?php if (!empty($errDate)) {echo "<span class ='error'>$errDate</span>"; } ?>

    <p>Follow-Up Occurrence:</p>
    <input type="radio" id="fui2" name="followUp" value="2nd_FollowUp" <?php if(isset($_POST['followUp']) && $_POST['followUp'] =='2nd_FollowUp' ){echo "checked";}?>>
    <label for="fui2">Second: $25</label>
    <input type="radio" id="fui3" name="followUp" value="3rd_FollowUp" <?php if(isset($_POST['followUp']) && $_POST['followUp'] =='3rd_FollowUp' ){echo "checked";}?>>
    <label for="fui3">Third: $50</label>
    <input type="radio" id="fui4" name="followUp" value="4th_FollowUp" <?php if(isset($_POST['followUp']) && $_POST['followUp'] =='4th_FollowUp' ){echo "checked";}?>>
    <label for="fui4">Fourth: $100</label>
    <?php if (!empty($errFollowUp)) {echo "<span class ='error'>$errFollowUp</span>"; } ?>


    <label for="inspectorName">Inspection Completed By: </label>
    <input type="text" name="inspector" id="inspectorName" maxlength="100" value="<?php if (isset($inspector)) {echo htmlspecialchars($inspector, ENT_QUOTES, "UTF-8");}?>" > <br>
    <?php if (!empty($errInspect)) {echo "<span class ='error'>$errInspect</span>"; } ?>

    <label for="propertyRep">Property Representative Name: </label>
    <input type="text" name="represent" id="propertyRep" maxlength="100" value="<?php if (isset($represent)) {echo htmlspecialchars($represent, ENT_QUOTES, "UTF-8");}?>"> <br>
    <?php if (!empty($errRepresent)) {echo "<span class ='error'>$errRepresent</span>"; } ?>

    <label for="signature-pad">Property Representative Signature: </label>

    <div class="wrapper">
        <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
    </div><br>

    <button id="clear">Clear</button>
    <br><br>

    <label for="submit">Submit:</label>
    <input type="submit" name="submit" id="submit" value="submit">


</form>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="javascript/signature.js"></script>

<?php
}//close showform
require_once "footer.php";
?>