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
            <a class="button" href='login.php'>Log In</a>
        </div>
    </div>



<?php }
//IF USER IS LOGGED IN
else { ?>

    <div class="columnleft">
        <div class="section">
            <h2>Welcome</h2> <br>
            <a class="button" href='formstart.php'>Begin Inspection</a> <br><br><br><br>
            <a class="button" href='search.php'>Search Past Inspections</a>
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