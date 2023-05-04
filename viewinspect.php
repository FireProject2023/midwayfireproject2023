<?php

$pagename = "View Inspections";
require_once "header.php";
$currentfile = "viewinspect.php";

//query database for FLS
$sql = "SELECT * FROM formfls WHERE idAddress = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_GET['q']);
$stmt->execute();
$resultFLS = $stmt->fetchAll(PDO::FETCH_ASSOC);

//query database for COT
$sql = "SELECT * FROM formcot WHERE idAddress = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_GET['q']);
$stmt->execute();
$resultCOT = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($resultCOT)) {
    echo "No Change of Tenant forms have been completed for this address.<br>";
} else {
?>
    <h3>Past Change of Tenant Inspections</h3> <br>
    <?php foreach ($resultCOT as $row) { ?>
        <div class="section">
            <h4><?php echo $row['created'];?></h4> <br>
            <p>Type: <?php echo $row['inspectType'];?></p>
            <p>Occurrence: <?php echo $row['inspectOccur'];?></p>
            <p>Status: <?php echo $row['passFail'];?></p>
            <p>Issues Identified: <?php echo $row['areasRequire'];?></p>
            <p>Comments: <?php echo $row['comments'];?></p>
            <p>Inspection Completed By: <?php echo $row['inspector'];?></p>
            <p>Business Rep Present: <?php echo $row['busRep'];?></P>
        </div>
    <?php
    }//close foreach
}//close display COT results

if(empty($resultFLS)) {
    echo "No Fire & Life Safety forms have been completed for this address.";
} else {
?>

<h3>Past Fire & Life Safety Inspections</h3> <br>
<?php foreach ($resultFLS as $row) { ?>
    <div class="section">
    <h4><?php echo $row['created'];?></h4> <br>
    <table>
        <tr><th>EXITS</th><th>Passed</th></tr>
        <tr><td>Exit doors operating?</td><td><?php echo $row['exit1'];?></td></tr>
        <tr><td>Exit-ways clear?</td><td><?php echo $row['exit2'];?></td></tr>
        <tr><td>Exit signs operating?</td><td><?php echo $row['exit3'];?></td></tr>
        <tr><td>Emergency lights operating?</td><td><?php echo $row['exit4'];?></td></tr>
    </table>
        <p>Notes: <?php echo $row['exitComments'];?></p>
        <table>
            <tr><th>Electrical Components</th><th>Passed</th></tr>
            <tr><td>36in front and 30in side clearance maintained?</td><td><?php echo $row['elec1'];?></td></tr>
            <tr><td>Extension cords properly used?</td><td><?php echo $row['elec2'];?></td></tr>
            <tr><td>Power strips are FM/UL certified?</td><td><?php echo $row['elec3'];?></td></tr>
            <tr><td>All outlets properly covered?</td><td><?php echo $row['elec4'];?></td></tr>
        </table>
        <p>Notes: <?php echo $row['elecComments'];?></p>
        <table>
            <tr><th>Misc FLS Issues</th><th>Passed</th></tr>
            <tr><td>Storage clearance 18in below sprinkler or 24in below ceiling?</td><td><?php echo $row['misc1'];?></td></tr>
            <tr><td>Interior & exterior clutter free?</td><td><?php echo $row['misc2'];?></td></tr>
            <tr><td>Fuel stored correctly?</td><td><?php echo $row['misc3'];?></td></tr>
            <tr><td>Knox boxes in working order?</td><td><?php echo $row['misc4'];?></td></tr>
            <tr><td>Address displayed?</td><td><?php echo $row['misc5'];?></td></tr>
            <tr><td>Specialty rooms labeled?</td><td><?php echo $row['misc6'];?></td></tr>
            <tr><td>Compressed gas cylinders secured?</td><td><?php echo $row['misc7'];?></td></tr>

        </table>
        <p>Notes: <?php echo $row['exitComments'];?></p>
        <table>
            <tr><th>FPS Inspections</th><th>Passed</th></tr>
            <tr><td>Fire extinguisher inspection current?</td><td><?php echo $row['fpse1'];?></td></tr>
            <tr><td>6-mont good suppression inspection current? </td><td><?php echo $row['fpse2'];?></td></tr>
            <tr><td>Yearly fire sprinkler inspection current?</td><td><?php echo $row['fpse3'];?></td></tr>
            <tr><td>Yearly fire alarm inspection current?</td><td><?php echo $row['fpse4'];?></td></tr>
            <tr><td>3-foot clearance around fire protection equipment?</td><td><?php echo $row['fpse5'];?></td></tr>
            <tr><td>Kitchen hood ventilation clean? </td><td><?php echo $row['fpse6'];?></td></tr>
            <tr><td>Yearly fire standpipe inspection current?</td><td><?php echo $row['fpse7'];?></td></tr>
            <tr><td>All system inspection report available on site?</td><td><?php echo $row['fpse8'];?></td></tr>
        </table>
        <p>Notes: <?php echo $row['fpseComments'];?></p> <br>
        <p>Smoke Alarms: <?php echo $row['smokeNum'];?></p> <br>
        <p>Missing: <?php echo $row['smokeMiss'];?></p> <br>
        <p>Disconnected: <?php echo $row['smokeDisc'];?></p> <br>
        <p>Missing Battery: <?php echo $row['smokeOld'];?></p> <br>

        <table>
            <tr><th>ROIS</th><th>Passed</th></tr>
            <tr><td>Reviewed Educational package?</td><td><?php echo $row['rois1'];?></td></tr>
            <tr><td>Reviewed home escape plan?</td><td><?php echo $row['rois2'];?></td></tr>
            <tr><td>House numbers visible?</td><td><?php echo $row['rois3'];?></td></tr>
            <tr><td>Exits & stairs free of clutter?</td><td><?php echo $row['rois4'];?></td></tr>
            <tr><td>Combustibles 3ft away from heat sources?</td><td><?php echo $row['rois5'];?></td></tr>
            <tr><td>Extension cords proper?</td><td><?php echo $row['rois6'];?></td></tr>
            <tr><td>Candles on noncombustible surface?</td><td><?php echo $row['rois7'];?></td></tr>
            <tr><td>Fire extinguisher present?</td><td><?php echo $row['rois8'];?></td></tr>
      </table>

        <p>Inspection Results: <?php echo $row['inspectResults'];?></p> <br>
        <p>Follow-Up Date: <?php echo $row['followUpDate'];?></p> <br>
        <p>Follow-Up Occurrence: <?php echo $row['followUp'];?></p> <br>
        <p>Inspector: <?php echo $row['inspector'];?></p> <br>
        <p>Representative: <?php echo $row['represent'];?></p> <br>
        <p>Representative Signature: <?php echo $row['signature'];?></p> <br>
    </div>
<?php
}//close foreach
}//close display FLS results

require_once "footer.php";
?>
