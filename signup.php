<?php

$pagename = "Request Account";
require_once "header.php";
$currentfile = "signup.php";

//initial variables
$showform = 1;
$errexists = 0;
$errfname = "";
$errlname = "";
$erreml = "";
$errpass = "";

//form processing
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    //local variables & sanitization
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $eml = strtolower(trim($_POST['eml']));
    $pwd = $_POST['pwd'];

    //error checking & validation
    //check first name
    if (empty($fname)) {
        $errexists = 1;
        $errfname = "Missing first name.";
    }
    //check last name
    if (empty($lname)) {
        $errexists = 1;
        $errlname = "Missing last name.";
    }

    //check email
    if (empty($eml)) {
        $errexists = 1;
        $erreml = "Missing email.";
    } else if (!filter_var($eml, FILTER_VALIDATE_EMAIL)) {
        $errexists = 1;
        $erreml = "Email is not valid";
    }

    //check password length
    $passlength = strlen($pwd);
    if (empty($pwd)) {
        $errexists = 1;
        $errpwd = "Missing password.";
    } else if ($passlength < 8 || $passlength >72) {
        $errexists = 1;
        $errpwd = "The password must be between 8 and 72 characters.";
    }

    //check for duplicate emails
    $sql = "SELECT * FROM signup WHERE eml = ?";
    $emailexists = checkdup($pdo, $sql, $eml);
    if ($emailexists) {
        $errexists = 1;
        $erreml .= " The email is taken.";
    }

    //general error message
    if ($errexists == 1) {
        echo "<p class='error'>There are errors. Please make changes and resubmit.</p>";
    } else {
        //no errors, add to database
        //hash password
        $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);

        //insert into database
        $sql = "INSERT INTO signup (fname, lname, eml, pwd)
                VALUES (:fname, :lname, :eml, :pwd)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':fname', $fname);
        $stmt->bindValue(':lname', $lname);
        $stmt->bindValue(':eml', $eml);
        $stmt->bindValue(':pwd', $hashedpwd);
        $stmt->execute();

        //Send confirmation email
     //   $emlmsg = '<p>Hello ' . $fname . '! Thank you for requesting an account. Before you are able to login, your admin will need to approve your account.</p>';
     //   $emlsubject = 'Account Request';
     //   require_once '../includes/phpmailer.php';

        //Success message
        echo "<p class='success'>Your account request has been submitted, your account must be approved before logging in.</p>";
        //hide form
        $showform = 0;
    }//else control code
}//submit
if ($showform == 1) {
    ?>

    <p>Please enter the following information to sign up for this website. All fields are required.</p>

    <form name="signup" id="signup" method="post" action="<?php echo $currentfile; ?>">
        <label for="fname">Preferred Name:</label> <input type="text" name="fname" id="fname" placeholder="Preferred Name" maxlength="50" value="<?php if (isset($fname)) {echo htmlspecialchars($fname, ENT_QUOTES, "UTF-8");}?>">
        <?php if (!empty($errfname)) {echo "<span class ='error'>$errfname</span>"; } ?>
        <br>
        <label for="lname">Last Name:</label> <input type="text" name="lname" id="lname" placeholder="Last Name" maxlength="50" value="<?php if (isset($lname)) {echo htmlspecialchars($lname, ENT_QUOTES, "UTF-8");}?>">
        <?php if (!empty($errlname)) {echo "<span class ='error'>$errlname</span>"; } ?>
        <br>
        <label for="eml">Email:</label> <input type="email" name="eml" id="eml" placeholder="Email Address" maxlength="255" value="<?php if (isset($eml)) {echo htmlspecialchars($eml, ENT_QUOTES, "UTF-8");}?>">
        <?php if (!empty($erreml)) {echo "<span class ='error'>$erreml</span>"; } ?>
        <br>
        <label for="pwd">Password:</label> <input type="password" name="pwd" id="pwd" placeholder="Password (8+ characters)" maxlength="255" >
        <?php if (!empty($errpwd)) {echo "<span class ='error'>$errpwd</span>"; } ?>
        <br>
        <br>
        <br><label for="submit">Submit:</label><input type="submit" name="submit" id="submit" value="submit">
        <br>
    </form>

    <?php
}//close showform
require_once "footer.php";
?>