<?php
$pagename = "Structure Fire Investigation Worksheet";
require_once "header.php";
$currentfile = "sfi.php";

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

<p>Please enter the following information. All fields are required unless otherwise stated.</p>
<form name="sfi" id="sfi" method="post" action="<?php echo $currentfile; ?>" enctype="multipart/form-data">
<h4>display address info & occupants</h4>

    Structure type drop down menu


</form>

<?php
    }//close showform
    require_once "footer.php"
?>
