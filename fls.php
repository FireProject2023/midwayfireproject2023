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

<form>
/* display business info here */
    <h3>ACCESS/EGRESS/EXITS</h3>
    <table id="accessEgress">
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes1" name="yesNo1" value="yes">
                <label for="yes1">Y</label>
                <input type="radio" id="no1" name="yesNo1" value="no">
                <label for="no1">N</label>
            </td>
            <td id="category"><p>All exit doors shall operate properly when building is occupied.</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes2" name="yesNo2" value="yes">
                <label for="yes2">Y</label>
                <input type="radio" id="no2" name="yesNo2" value="no">
                <label for="no2">N</label>
            </td>
            <td id="category"><p>All designated exit isles, exit doors, and exit discharges shall remain free of obstruction at all times</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes3" name="yesNo3" value="yes">
                <label for="yes3">Y</label>
                <input type="radio" id="no3" name="yesNo3" value="no">
                <label for="no3">N</label>
            </td>
            <td id="category"><p>All required exit signs shall be properly maintained.</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes4" name="yesNo4" value="yes">
                <label for="yes4">Y</label>
                <input type="radio" id="no4" name="yesNo4" value="no">
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
                <input type="radio" id="yes5" name="yesNo5" value="yes">
                <label for="yes5">Y</label>
                <input type="radio" id="no5" name="yesNo5" value="no">
                <label for="no5">N</label>
            </td>
            <td id="category"><p>36in front and 30in side clearance maintained for: Electric Panels, Water Heaters, HVAC Equipment, & Cooking Equipment</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes6" name="yesNo6" value="yes">
                <label for="yes6">Y</label>
                <input type="radio" id="no6" name="yesNo6" value="no">
                <label for="no6">N</label>
            </td>
            <td id="category"><p> Extension cords shall not be plugged into appliances, utilized as permanent wiring, or extended through ceilings, walls, or doorway</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes7" name="yesNo7" value="yes">
                <label for="yes7">Y</label>
                <input type="radio" id="no7" name="yesNo7" value="no">
                <label for="no7">N</label>
            </td>
            <td id="category"><p> Power strips shall be FM or UL Listed, and have built-in surge protection</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes8" name="yesNo8" value="yes">
                <label for="yes8">Y</label>
                <input type="radio" id="no8" name="yesNo8" value="no">
                <label for="no8">N</label>
            </td>
            <td id="category"><p> All electrical wall plugs, switch plates, and junction boxes shall be properly covered</p></td>
        </tr>
    </table>

    <label for="electricComments">Notes/Comments:</label> <br>
    <textarea id="electricComments" name="electricComments" rows="5"></textarea>

    <h3>MISC FIRE SAFETY ISSUES</h3>
    <table id="miscFPS">
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes9" name="yesNo9" value="yes">
                <label for="yes9">Y</label>
                <input type="radio" id="no9" name="yesNo9" value="no">
                <label for="no9">N</label>
            </td>
            <td id="category"><p>Center room storage clearance shall be 18in from the bottom of sprinkler heads or 24in below ceiling in non-sprinkler buildings</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes10" name="yesNo10" value="yes">
                <label for="yes10">Y</label>
                <input type="radio" id="no10" name="yesNo10" value="no">
                <label for="no10">N</label>
            </td>
            <td id="category"><p>Interior and exterior of structure is free of clutter, boxes, paper, & trash</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes11" name="yesNo11" value="yes">
                <label for="yes11">Y</label>
                <input type="radio" id="no11" name="yesNo11" value="no">
                <label for="no11">N</label>
            </td>
            <td id="category"><p>Fueled equipment and fuel storage containers are not stored inside of the occupancy</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes12" name="yesNo12" value="yes">
                <label for="yes12">Y</label>
                <input type="radio" id="no12" name="yesNo12" value="no">
                <label for="no12">N</label>
            </td>
            <td id="category"><p>Knox boxes in occupancies are in proper working order, and all building keys are clearly marked with key tags</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes13" name="yesNo13" value="yes">
                <label for="yes13">Y</label>
                <input type="radio" id="no13" name="yesNo13" value="no">
                <label for="no13">N</label>
            </td>
            <td id="category"><p>Business address is displayed on the front of the building and rear door</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes14" name="yesNo14" value="yes">
                <label for="yes14">Y</label>
                <input type="radio" id="no14" name="yesNo14" value="no">
                <label for="no14">N</label>
            </td>
            <td id="category"><p>Specialty rooms are properly labeled (Alarm System, Sprinkler Riser Room, Electrical Room, Pool Chemicals, and Elevator Controls)</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes15" name="yesNo15" value="yes">
                <label for="yes15">Y</label>
                <input type="radio" id="no15" name="yesNo15" value="no">
                <label for="no15">N</label>
            </td>
            <td id="category"><p>All compressed gas cylinders are secured</p></td>
        </tr>
    </table>

    <label for="miscComments">Notes/Comments:</label> <br>
    <textarea id="miscComments" name="miscComments" rows="5"></textarea>

    <h3>FPS & EQUIPMENT INSPECTIONS SHALL BE CURRENT</h3>
    <table id="miscFPS">
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes16" name="yesNo16" value="yes">
                <label for="yes16">Y</label>
                <input type="radio" id="no16" name="yesNo16" value="no">
                <label for="no16">N</label>
            </td>
            <td id="category"><p>Fire extinguisher inspections are current & mounted properly</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes17" name="yesNo17" value="yes">
                <label for="yes17">Y</label>
                <input type="radio" id="no17" name="yesNo17" value="no">
                <label for="no17">N</label>
            </td>
            <td id="category"><p>6 month kitchen hood suppression system inspection is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes18" name="yesNo18" value="yes">
                <label for="yes18">Y</label>
                <input type="radio" id="no18" name="yesNo18" value="no">
                <label for="no18">N</label>
            </td>
            <td id="category"><p>Yearly fire sprinkler system inspection is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes19" name="yesNo19" value="yes">
                <label for="yes19">Y</label>
                <input type="radio" id="no19" name="yesNo19" value="no">
                <label for="no19">N</label>
            </td>
            <td id="category"><p>Yearly fire alarm system is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes20" name="yesNo20" value="yes">
                <label for="yes20">Y</label>
                <input type="radio" id="no20" name="yesNo20" value="no">
                <label for="no20">N</label>
            </td>
            <td id="category"><p>Maintain a 3-foot clearance in all directions around all fire protection equipment, system connection, and fire hydrants on site</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes21" name="yesNo21" value="yes">
                <label for="yes21">Y</label>
                <input type="radio" id="no21" name="yesNo21" value="no">
                <label for="no21">N</label>
            </td>
            <td id="category"><p>Kitchen hood ventilation system is clean and operational</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes22" name="yesNo22" value="yes">
                <label for="yes22">Y</label>
                <input type="radio" id="no22" name="yesNo22" value="no">
                <label for="no22">N</label>
            </td>
            <td id="category"><p>Yearly fire standpipe system inspection is current</p></td>
        </tr>

        <tr>
            <td id="yesNo">
                <input type="radio" id="yes23" name="yesNo23" value="yes">
                <label for="yes23">Y</label>
                <input type="radio" id="no23" name="yesNo23" value="no">
                <label for="no23">N</label>
            </td>
            <td id="category"><p>All system inspection reports are available on site</p></td>
        </tr>
    </table>

    <label for="currentComments">Notes/Comments:</label> <br>
    <textarea id="currentComments" name="currentComments" rows="5"></textarea>

    <h3>SMOKE ALARM & RESIDENTIAL OCCUPANCY INSPECTIONS</h3>
    <label for="numAlarm">Number of operating smoke alarms: </label>
    <input type="number" id="numAlarm" name="numAlarm" min="0" max="50"> <br>
    <p>Number of smoke alarms ... </p>
    <label for="numMissing">Missing: </label>
    <input type="number" id="numMissing" name="numMissing" min="0" max="50">
    <label for="numMissingBattery">Missing Battery: </label>
    <input type="number" id="numMissingBattery" name="numMissingBattery" min="0" max="50">
    <label for="numDisconnect">Disconnected from power: </label>
    <input type="number" id="numDisconnect" name="numDisconnect" min="0" max="50">
    <label for="num10">10-year smoke alarms: </label>
    <input type="number" id="num10" name="num10" min="0" max="50">
    <br><br>
    <table>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes24" name="yesNo24" value="yes">
                <label for="yes24">Y</label>
                <input type="radio" id="no24" name="yesNo24" value="no">
                <label for="no24">N</label>
            </td>
            <td id="category"><p>Reviewed educational package</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes25" name="yesNo25" value="yes">
                <label for="yes25">Y</label>
                <input type="radio" id="no25" name="yesNo25" value="no">
                <label for="no25">N</label>
            </td>
            <td id="category"><p>Reviewed home escape plan guideline</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes26" name="yesNo26" value="yes">
                <label for="yes26">Y</label>
                <input type="radio" id="no26" name="yesNo26" value="no">
                <label for="no26">N</label>
            </td>
            <td id="category"><p>House numbers are visible</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes27" name="yesNo27" value="yes">
                <label for="yes27">Y</label>
                <input type="radio" id="no27" name="yesNo27" value="no">
                <label for="no27">N</label>
            </td>
            <td id="category"><p>Exit paths and stairways are free of clutter</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes28" name="yesNo28" value="yes">
                <label for="yes28">Y</label>
                <input type="radio" id="no28" name="yesNo28" value="no">
                <label for="no28">N</label>
            </td>
            <td id="category"><p>Combustibles are 3ft away from any heat source</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes29" name="yesNo29" value="yes">
                <label for="yes29">Y</label>
                <input type="radio" id="no29" name="yesNo29" value="no">
                <label for="no29">N</label>
            </td>
            <td id="category"><p>No extension cords under rugs or doorways</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes30" name="yesNo30" value="yes">
                <label for="yes30">Y</label>
                <input type="radio" id="no30" name="yesNo30" value="no">
                <label for="no30">N</label>
            </td>
            <td id="category"><p>Candles placed on noncombustible surface</p></td>
        </tr>
        <tr>
            <td id="yesNo">
                <input type="radio" id="yes31" name="yesNo31" value="yes">
                <label for="ye31">Y</label>
                <input type="radio" id="no31" name="yesNo31" value="no">
                <label for="no31">N</label>
            </td>
            <td id="category"><p>Home has fire extinguisher</p></td>
        </tr>

    </table>

    <br>
    <h3>Inspection Results</h3>

    <input type="checkbox" id="ch1" name="noFLSHazard" value="noFLSHazard">
    <label for="ch1">No FLS Hazards were identified.</label><br>
    <input type="checkbox" id="ch2" name="fixedFLSHazard" value="fixedFLSHazard">
    <label for="ch2">All FLS Hazards identified were corrected</label><br>

    <input type="checkbox" id="ch3" name="hazardIdentified" value="hazardIdentified">
    <label for="ch3">NOTICE OF VIOLATION(S): FLS hazards were identified, a follow-up inspection is required. The owner, agent, or party in control of the occupancy may appeal this order within 30 days to the Building Code Board of Appeals.</label>
    <br>
    <label for="fuiDate">Follow-Up Inspection Date:</label>
    <input type="text" id="fuiDate" name="fuiDate" rows="1">
    <p>Follow-Up Occurrence:</p>
    <input type="radio" id="fui2" name="fuInspect2" value="2nd_FollowUp">
    <label for="fui2">Second: $25</label>
    <input type="radio" id="fui3" name="fuInspect3" value="3rd_FollowUp">
    <label for="fui3">Third: $50</label>
    <input type="radio" id="fui4" name="fuInspect4" value="4th_FollowUp">
    <label for="fui4">Fourth: $100</label>

    <p>Inspection complete by: </p>
    <input type="text" name="propertyRep" id="propertyRep" maxlength="100" > <br>
    <label for="propertyRep">Property Representative Name: </label>
    <input type="text" name="propertyRep" id="propertyRep" maxlength="100" >
    <canvas id="signature-pad"></canvas>

</form>
<?php
}//close showform
require_once "footer.php";
?>