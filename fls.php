<?php
$pagename = "Fire & Life Safety Form";
require_once "header.php";
$currentfile = "fls.php";

//check if user is logged in
checkLogin();

//initial variables
$showform = 1;
$errexists = "";

//form processing
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //local variables & sanitization

    //Error checking & validation

    //General error message
    if ($errexists == 1) {
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    } else {
        //No errors, insert into database
        //query database
        $sql = "";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //insert data into database

        //success message
        echo "<p class='success'>Form successfully submitted.</p>";
        //hide form
        $showform = 0;

    }//close else no errors
}//close if req method is post

//If the form has not been submitted, display the form.
if ($showform == 1) { ?>
<div class="columnleft">

<form>
/* display business info here */
    <h3>ACCESS/EGRESS/EXITS</h3>
    <table id="accessEgress">
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes1" name="yesNoDoor" value="yes">
                <label for="yes1">Y</label>
                <input type="radio" id="no1" name="yesNoDoor" value="no">
                <label for="no1">N</label>
            </td>
            <td id="category"><p>All exit doors shall operate properly when building is occupied.</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes2" name="yesNoExit" value="yes">
                <label for="yes2">Y</label>
                <input type="radio" id="no2" name="yesNoExit" value="no">
                <label for="no2">N</label>
            </td>
            <td id="category"><p>All designated exit isles, exit doors, and exit discharges shall remain free of obstruction at all times</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes3" name="yesNoSign" value="yes">
                <label for="yes3">Y</label>
                <input type="radio" id="no3" name="yesNoSign" value="no">
                <label for="no3">N</label>
            </td>
            <td id="category"><p>All required exit signs shall be properly maintained.</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes4" name="yesNoLight" value="yes">
                <label for="yes4">Y</label>
                <input type="radio" id="no4" name="yesNoLight" value="no">
                <label for="no4">N</label>
            </td>
            <td id="category"><p>All required emergency lights shall be properly maintained</p></td>
        </tr>
    </table>

    <label for="accessComments">Notes/Comments:</label> <br>
    <textarea id="accessComments" name="accessComments" rows="5"></textarea>


    <h3>ELECTRICAL COMPONENTS</h3>
    <table id="electricComp">
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes5" name="yesNoClear" value="yes">
                <label for="yes5">Y</label>
                <input type="radio" id="no5" name="yesNoClear" value="no">
                <label for="no5">N</label>
            </td>
            <td id="category"><p>36in front and 30in side clearance maintained for: Electric Panels, Water Heaters, HVAC Equipment, & Cooking Equipment</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes6" name="yesNoExtens" value="yes">
                <label for="yes6">Y</label>
                <input type="radio" id="no6" name="yesNoExtens" value="no">
                <label for="no6">N</label>
            </td>
            <td id="category"><p> Extension cords shall not be plugged into appliances, utilized as permanent wiring, or extended through ceilings, walls, or doorway</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes7" name="yesNoSign" value="yes">
                <label for="yes7">Y</label>
                <input type="radio" id="no7" name="yesNoSign" value="no">
                <label for="no7">N</label>
            </td>
            <td id="category"><p> Power strips shall be FM or UL Listed, and have built-in surge protection</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes8" name="yesNoLight" value="yes">
                <label for="yes8">Y</label>
                <input type="radio" id="no8" name="yesNoLight" value="no">
                <label for="no8">N</label>
            </td>
            <td id="category"><p> All electrical wall plugs, switch plates, and junction boxes shall be properly covered</p></td>
        </tr>
    </table>

    <h3>MISC FIRE SAFETY ISSUES</h3>
    <table id="miscFPS">
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes9" name="yesNoClear" value="yes">
                <label for="yes9">Y</label>
                <input type="radio" id="no9" name="yesNoClear" value="no">
                <label for="no9">N</label>
            </td>
            <td id="category"><p>Center room storage clearance shall be 18in from the bottom of sprinkler heads or 24in below ceiling in non-sprinkler buildings</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes10" name="yesNoExtens" value="yes">
                <label for="yes10">Y</label>
                <input type="radio" id="no10" name="yesNoExtens" value="no">
                <label for="no10">N</label>
            </td>
            <td id="category"><p>Interior and exterior of structure is free of clutter, boxes, paper, & trash</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes11" name="yesNoSign" value="yes">
                <label for="yes11">Y</label>
                <input type="radio" id="no11" name="yesNoSign" value="no">
                <label for="no11">N</label>
            </td>
            <td id="category"><p>Fueled equipment and fuel storage containers are not stored inside of the occupancy</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes12" name="yesNoLight" value="yes">
                <label for="yes12">Y</label>
                <input type="radio" id="no12" name="yesNoLight" value="no">
                <label for="no12">N</label>
            </td>
            <td id="category"><p>Knox boxes in occupancies are in proper working order, and all building keys are clearly marked with key tags</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes13" name="yesNoLight" value="yes">
                <label for="yes13">Y</label>
                <input type="radio" id="no13" name="yesNoLight" value="no">
                <label for="no13">N</label>
            </td>
            <td id="category"><p>Business address is displayed on the front of the building and rear door</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes14" name="yesNoLight" value="yes">
                <label for="yes14">Y</label>
                <input type="radio" id="no14" name="yesNoLight" value="no">
                <label for="no14">N</label>
            </td>
            <td id="category"><p>Specialty rooms are properly labeled (Alarm System, Sprinkler Riser Room, Electrical Room, Pool Chemicals, and Elevator Controls)</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes15" name="yesNoLight" value="yes">
                <label for="yes15">Y</label>
                <input type="radio" id="no15" name="yesNoLight" value="no">
                <label for="no15">N</label>
            </td>
            <td id="category"><p>All compressed gas cylinders are secured</p></td>
        </tr>
    </table>


    <h3>FPS & EQUIPMENT INSPECTIONS SHALL BE CURRENT</h3>
    <table id="miscFPS">
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes16" name="yesNoClear" value="yes">
                <label for="yes16">Y</label>
                <input type="radio" id="no16" name="yesNoClear" value="no">
                <label for="no16">N</label>
            </td>
            <td id="category"><p>Fire extinguisher inspections are current & mounted properly</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes17" name="yesNoExtens" value="yes">
                <label for="yes17">Y</label>
                <input type="radio" id="no17" name="yesNoExtens" value="no">
                <label for="no17">N</label>
            </td>
            <td id="category"><p>6 month kitchen hood suppression system inspection is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes18" name="yesNoSign" value="yes">
                <label for="yes18">Y</label>
                <input type="radio" id="no18" name="yesNoSign" value="no">
                <label for="no18">N</label>
            </td>
            <td id="category"><p>Yearly fire sprinkler system inspection is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes19" name="yesNoLight" value="yes">
                <label for="yes19">Y</label>
                <input type="radio" id="no19" name="yesNoLight" value="no">
                <label for="no19">N</label>
            </td>
            <td id="category"><p>Yearly fire alarm system is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes20" name="yesNoLight" value="yes">
                <label for="yes20">Y</label>
                <input type="radio" id="no20" name="yesNoLight" value="no">
                <label for="no20">N</label>
            </td>
            <td id="category"><p>Maintain a 3-foot clearance in all directions around all fire protection equipment, system connection, and fire hydrants on site</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes21" name="yesNoLight" value="yes">
                <label for="yes21">Y</label>
                <input type="radio" id="no21" name="yesNoLight" value="no">
                <label for="no21">N</label>
            </td>
            <td id="category"><p>Kitchen hood ventilation system is clean and operational</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes22" name="yesNoLight" value="yes">
                <label for="yes22">Y</label>
                <input type="radio" id="no22" name="yesNoLight" value="no">
                <label for="no22">N</label>
            </td>
            <td id="category"><p>Yearly fire standpipe system inspection is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes23" name="yesNoLight" value="yes">
                <label for="yes23">Y</label>
                <input type="radio" id="no23" name="yesNoLight" value="no">
                <label for="no23">N</label>
            </td>
            <td id="category"><p>All system inspection reports are available on site</p></td>
        </tr>
    </table>

    <h3>SMOKE ALARM & RESIDENTIAL OCCUPANCY INSPECTIONS</h3>
    <label for="numAlarm">Number of operating smoke alarms: </label>
    <input type="number" id="numAlarm" name="numAlarm" min="0" max="50"> <br>
    <p>Number of smoke alarms| </p>
    <label for="numMissing">Missing: </label>
    <input type="number" id="numMissing" name="numMissing" min="0" max="50">
    <label for="numMissingBattery">Missing Battery: </label>
    <input type="number" id="numMissingBattery" name="numMissingBattery" min="0" max="50">
    <label for="numDisconnect">Disconnected from power: </label>
    <input type="number" id="numDisconnect" name="numDisconnect" min="0" max="50">




</form>
</div>

<div class="columnright">
<h3>Business Info</h3>
    <label for="busName">Business Name:</label><br>
    <input type="text" name="busName" id="busName" placeholder="Business Name" maxlength="255" value="<?php if (isset($busName)) {echo htmlspecialchars($busName, ENT_QUOTES, "UTF-8");}?>">
    <br><br>
    <label for="complex">Complex:</label><br>
    <input type="text" name="complex" id="complex" placeholder="Complex" maxlength="255" value="<?php if (isset($complex)) {echo htmlspecialchars($complex, ENT_QUOTES, "UTF-8");}?>">
    <br><br>
    <label for="address">Address:</label><br>
    <input type="text" name="address" id="address" placeholder="Address" maxlength="255" value="<?php if (isset($address)) {echo htmlspecialchars($address, ENT_QUOTES, "UTF-8");}?>">
    <br><br>
    <label for="busPhone">Business Phone:</label><br>
    <input type="text" name="busPhone" id="busPhone" placeholder="(555)555-5555" maxlength="255" value="<?php if (isset($busPhone)) {echo htmlspecialchars($busPhone, ENT_QUOTES, "UTF-8");}?>">
    <br><br>
    <label for="cellPhone">Cell Phone:</label><br>
    <input type="text" name="cellPhone" id="cellPhone" placeholder="cellPhone" maxlength="255" value="<?php if (isset($cellPhone)) {echo htmlspecialchars($cellPhone, ENT_QUOTES, "UTF-8");}?>">
    <br><br>
    <label for="busEml">Business Email:</label><br>
    <input type="text" name="busEml" id="busEml" placeholder="busEml" maxlength="255" value="<?php if (isset($busEml)) {echo htmlspecialchars($busEml, ENT_QUOTES, "UTF-8");}?>">
    <br><br>
</div>


<?php
}//close showform
require_once "footer.php";
?>