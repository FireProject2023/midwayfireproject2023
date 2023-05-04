<?php

$pagename = "Member Update";
require_once "header.php";
$currentfile = "update.php";

checkLogin();

//check if user came from address page
if ((isset($_SESSION['referMember']) && $_SESSION['referMember']===TRUE )) {
    $refer=1;
} else {
    $refer="";
}

//get id
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $_SESSION['idMember'] = $_GET['q'];
}

//make sure user came from the Member List
if ($refer != 1)  {
    echo "<p class='error'>You cannot access this page directly.</p>";
    ?>
    <a href="memberlist.php">Return to Member List</a>
    <?php
} else {


    //initial variables
    $showform = 1;
    $errexists = 0;
    $erreml = "";
    $errfname = "";
    $ID = $_SESSION['idMember'];

    //form processing
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //local variables & sanitization
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $eml = trim(strtolower($_POST['eml']));

        //error checking
        if (empty($fname)) {
            $errexists = 1;
            $errfname = "Preferred name was left empty.";
        }

        if (empty($eml)) {
            $errexists = 1;
            $erreml = "Email was left empty.";
        } else {
            //check email
            if (!filter_var($eml, FILTER_VALIDATE_EMAIL)) {
                $errexists = 1;
                $erreml = "Email is not valid";
            } else if ($eml != $_POST['origeml']) {
                $sql = "SELECT * FROM signup WHERE eml = ?";
                $emailexists = checkdup($pdo, $sql, $eml);
                if ($emailexists) {
                    $errexists = 1;
                    $erreml = "The email is taken.";
                }
            }
        }

        //general error message
        if ($errexists == 1) {
            echo "<p class='error'>There are errors. Please make changes and resubmit.</p>";
        } else {
            //no errors, update database
            //updated date
            $updated = date("Y-m-d H:i:s");

            //update database
            $sql = "UPDATE signup SET fname = :fname, lname = :lname, eml = :eml WHERE ID = :ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':fname', $fname);
            $stmt->bindValue(':lname', $lname);
            $stmt->bindValue(':eml', $eml);
            $stmt->bindValue(':ID', $ID);
            $stmt->execute();
            //Success message
            echo "<p class='success'>You have successfully updated your information.</p>";

            //hide form
            $showform = 0;

        }//else control code
    }//submit
    if ($showform == 1) {
        $sql = "SELECT * from signup WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ID', $ID);
        $stmt->execute();
        $row = $stmt->fetch();
        ?>

        <p>Please enter your new information, or leave anything you do not want to change the same. All fields are required.</p>

        <form name="update" id="update" action="<?php echo $currentfile; ?>" method="post">
            <div class="formGroup">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname" placeholder="Preferred Name" maxlength="50" value ="<?php if (isset($fname) && (!empty($fname))) {
                echo htmlspecialchars($fname, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['fname'], ENT_QUOTES, "UTF-8");}?>">
            </div>
            <?php if (!empty($errfname)) {echo "<span class ='error'>$errfname</span>"; } ?>

            <div class="formGroup">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" placeholder="Last Name" maxlength="50" value ="<?php if (isset($lname) && (!empty($lname))) {
                    echo htmlspecialchars($lname, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['lname'], ENT_QUOTES, "UTF-8");}?>">
            </div>
            <?php if (!empty($errlname)) {echo "<span class ='error'>$errlname</span>"; } ?>

            <div class="formGroup">
            <label for="eml">Email:</label>
            <input type="email" name="eml" id="eml" placeholder="Email Address" maxlength="255" value ="<?php if (isset($eml) && (!empty($eml))) {
                echo htmlspecialchars($eml, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['eml'], ENT_QUOTES, "UTF-8");}?>">
            </div>
                <?php if (!empty($erreml)) {echo "<span class ='error'>$erreml</span>"; } ?>
            <br>

            <input type="hidden" name="ID" value="<?php echo $row['ID'];?>">
            <input type="hidden" name="origeml" value="<?php echo $row['eml'];?>">

            <br><label for="submit">Submit:</label>
            <input type="submit" name="submit" id="submit" value="submit">
            <br>
        </form>

        <?php
    }//close showform
}//close refer
require_once "footer.php";
?>