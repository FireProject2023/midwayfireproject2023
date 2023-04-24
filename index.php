<?php

$pagename = "Midway Fire Inspections";
require_once "header.php";
$currentfile = "index.php";


//IF USER IS NOT LOGGED IN
if(!isset($_SESSION['ID'])) { ?>
    <div class="center">
        <div class="section1">
            <h1>Welcome!</h1>
            <h1>Please log in to view content.</h1>
            <br><br>
            <a class="loginbutton" href='login.php'>Log In</a>
        </div>
    </div>



<?php }
//IF USER IS LOGGED IN
else { ?>

    <div class="columnleft">
        <div class="section">
            <h2>Insert info here!</h2>
        </div>
    </div>

    <div class="columnright">
        <div class="section">
            <h2>Insert info here! Maybe: # of inspections completed in year, weather?</h2>
        </div>
    </div>





<?php
}//close else
require_once "footer.php";
?>