<?php
$pagename = "Change Password";
require_once "header.php";
$currentfile = "changepwd.php";

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
    $errpwd = "";
    $ID = $_SESSION['idMember'];

    //form processing
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //create local variable
        $pwd = $_POST['pwd'];

        //error check password
        $passlength = strlen($pwd);
        if (empty($pwd)) {
            $errexists = 1;
            $errpwd = "Missing password.";
        }
        //check length
        else if ($passlength < 8 || $passlength >72) {
            $errexists = 1;
            $errpwd = "The password must be between 8 and 72 characters.";
        }

        //General error message
        if ($errexists == 1) {
            echo "<p class='error'>There are errors. Please make changes and resubmit.</p>";
        } else {
            //no errors, insert into database
            //hash password
            $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
            //get updated date
            $updated = date("Y-m-d H:i:s");
            //insert into database
            $sql = "UPDATE signup SET pwd = :pwd WHERE ID = :ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':pwd', $hashedpwd);
            $stmt->bindValue(':ID', $ID);
            $stmt->execute();

            //Check if admin & make sure the admin is not updating their own info
            if ($_SESSION['status'] == 1 && $ID != 3) {
                //Success message
                echo "<p class='success'>You have successfully updated this user's password.</p>";
            } else {
                //force logout
                session_start();
                session_unset();
                session_destroy();

                header("Location: confirm.php?state=3");
            }//logout

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

        <p>Please enter your new password: </p>

        <form name="changepwd" id="changepwd" action="<?php echo $currentfile; ?>" method="post">
            <label for="pwd">Password:</label>
            <input type="password" name="pwd" id="pwd" placeholder="Password (8+ characters)" maxlength="255">
            <?php if (!empty($errpwd)) {echo "<span class ='error'>$errpwd</span>"; } ?>

            <input type="hidden" name="ID" value="<?php echo $row['ID'];?>">
            <br><label for="submit">Submit:</label>
            <input type="submit" name="submit" id="submit" value="submit">
            <br>
        </form>

        <?php
    }//showform
}//close refer
require_once "footer.php";
?>