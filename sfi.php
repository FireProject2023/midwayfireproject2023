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
echo "<a href='formstart.php'>Submit another form</a>";
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
    <label for="structure">Structure Involved:</label>

    <label for="structureRes">Residential Structure:</label>
    <select id="structureRes" name="structureRes">

        <option value="single_fam">Single Family</option>
        <option value="mobile_home">Mobile Home</option>
        <option value="single_wide">Single Wide</option>
        <option value="double_wide">Double Wide</option>
        <option value="duplex">Duplex</option>
        <option value="town_house">Town House</option>
        <option value="apartment">Apartment</option>
    </select>



</form>

<?php
    }//close showform
    require_once "footer.php"
?>
