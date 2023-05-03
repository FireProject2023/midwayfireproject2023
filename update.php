<?php

$pagename = "Member Update";
require_once "header.php";
$currentfile = "update.php";

//check where user came from
if (isset($_SERVER['HTTP_REFERER'])) {
    $refer = basename($_SERVER['HTTP_REFERER']);
} else {
    $refer ="";
}

//get id
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['q'])){
    $ID = $_GET['q'];
} else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ID'])) {
    $ID = $_POST['ID'];
    $refer = "list.php";
} else {
    echo "<p class='error'>An error occurred. Please navigate back to the home page and try again.</p>";
    $errexists = 1;
}

//make sure user came from the Member List
if ($refer != "list.php")  {
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

    //form processing
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //local variables & sanitization
        $fname = trim($_POST['fname']);
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
            $sql = "UPDATE signup SET fname = :fname, eml = :eml, updated = :updated WHERE ID = :ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':fname', $fname);
            $stmt->bindValue(':eml', $eml);
            $stmt->bindValue(':updated', $updated);
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
            <label for="fname">New Name:</label>
            <input type="text" name="fname" id="fname" placeholder="Preferred Name" maxlength="50" value ="<?php if (isset($fname) && (!empty($fname))) {
                echo htmlspecialchars($fname, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['fname'], ENT_QUOTES, "UTF-8");}?>">
            <?php if (!empty($errfname)) {echo "<span class ='error'>$errfname</span>"; } ?>
            <br>
            <br>
            <label for="eml">New Email:</label>
            <input type="email" name="eml" id="eml" placeholder="Email Address" maxlength="255" value ="<?php if (isset($eml) && (!empty($eml))) {
                echo htmlspecialchars($eml, ENT_QUOTES, "UTF-8"); } else { echo htmlspecialchars($row['eml'], ENT_QUOTES, "UTF-8");}?>">
            <?php if (!empty($erreml)) {echo "<span class ='error'>$erreml</span>"; } ?>
            <br>

            <input type="hidden" name="ID" value="<?php echo $row['ID'];?>">
            <input type="hidden" name="origname" value="<?php echo $row['fname'];?>">
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