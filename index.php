<?php

$pagename = "Midway Fire Inspections";
require_once "header.php";
$currentfile = "index.php";


//IF USER IS NOT LOGGED IN
if(!isset($_SESSION['ID'])) { ?>
    <div class="center">
        <div class="section1">
            <h1>Welcome to Midway Fire Inspections</h1>
            <h1>Please Log In</h1>
            <br><br>
            <a class="button" href='login.php'>Log In</a>
        </div>
    </div>



<?php }
//IF USER IS LOGGED IN
else { ?>

        <div class="section">
            <h1>Welcome</h1> <br>
            <a class="button" href='formstart.php'>Begin Inspection</a> <br><br><br><br>
            <a class="button" href='search.php'>Search Past Inspections</a>
        </div>

<?php
}//close else
require_once "footer.php";
?>