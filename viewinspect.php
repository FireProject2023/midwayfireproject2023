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
    </div>
<?php
}//close foreach
}//close display FLS results

require_once "footer.php";
?>
