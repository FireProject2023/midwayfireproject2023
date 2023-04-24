<?php


$pagename = "Log In";
require_once "header.php";
$currentfile = "login.php";

//initial variables
$showform = 1;
$errexists = 0;
$erreml = "";
$errpwd = "";

//form processing
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    //local variables & sanitization
    $eml = strtolower(trim($_POST['eml']));
    $pwd = $_POST['pwd'];

    //error checking & validation
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

    //General error message
    if ($errexists == 1) {
        echo "<p class='error'>There are errors. Please make changes and resubmit.</p>";
    } else {
        //No errors, log user in
        //query database
        $sql = "SELECT * FROM signup where eml = '$eml'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $dbpwd = $row['pwd'];

        //verify password
        if (password_verify($pwd, $dbpwd)) {
            //hide form
            $showform = 0;
            $_SESSION['ID'] = $row['ID'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['eml'] = $row['eml'];
            $_SESSION['pwd'] = $row['pwd'];
            $_SESSION['status'] = $row['status'];
            //log user in
            header("Location: confirm.php?state=2");

        } else {
            echo "<p class='error'>Incorrect password. Please try again.</p>";
        }


    }
}

if ($showform == 1) {
    ?>

    <p>Please enter your email and password to log in. All fields are required.</p>

    <form name="login" id="login" method="post" action="<?php echo $currentfile; ?>">
        <label for="eml">Email</label> <br>
        <input type="email" name="eml" id="eml" placeholder="Email Address" maxlength="255" value="<?php if (isset($eml)) {echo $eml;}?>">
        <?php if (!empty($erreml)) {echo "<span class ='error'>$erreml</span>"; } ?>
        <br><br>
        <label for="pwd">Password</label> <br>
        <input type="password" name="pwd" id="pwd" placeholder="Password (8+ characters)" maxlength="255" >
        <?php if (!empty($errpwd)) {echo "<span class ='error'>$errpwd</span>"; } ?>
        <br>

        <br><input type="submit" name="submit" id="submit" value="Log In">

    </form>

    <h3>Don't have an account?</h3> <a class="link" href='signup.php'>Request an account</a>

    <?php
}//close showform
require_once "footer.php";
?>