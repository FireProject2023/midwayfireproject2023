<?php
$pagename = "Add Address";
require_once "header.php";
$currentfile = "addaddress.php";

//check if user is logged in
checkLogin();

?>

<h3>Business Info</h3>
<label for="busName">Business Name:</label><br>
<input type="text" name="busName" id="busName" placeholder="Business Name" maxlength="255" value="<?php if (isset($busName)) {echo htmlspecialchars($busName, ENT_QUOTES, "UTF-8");}?>">
<br><br>
<label for="complex">Complex:</label><br>
<input type="text" name="complex" id="complex" placeholder="Complex" maxlength="255" value="<?php if (isset($complex)) {echo htmlspecialchars($complex, ENT_QUOTES, "UTF-8");}?>">
<br><br>
<label for="address">Address:</label><br>
<input type="text" name="address" id="address" placeholder="Address" maxlength="255" value="<?php if (isset($address)) {echo htmlspecialchars($address, ENT_QUOTES, "UTF-8");}?>">
<br><br>
<label for="busPhone">Business Phone:</label><br>
<input type="text" name="busPhone" id="busPhone" placeholder="(555)555-5555" maxlength="255" value="<?php if (isset($busPhone)) {echo htmlspecialchars($busPhone, ENT_QUOTES, "UTF-8");}?>">
<br><br>
<label for="cellPhone">Cell Phone:</label><br>
<input type="text" name="cellPhone" id="cellPhone" placeholder="cellPhone" maxlength="255" value="<?php if (isset($cellPhone)) {echo htmlspecialchars($cellPhone, ENT_QUOTES, "UTF-8");}?>">
<br><br>
<label for="busEml">Business Email:</label><br>
<input type="text" name="busEml" id="busEml" placeholder="busEml" maxlength="255" value="<?php if (isset($busEml)) {echo htmlspecialchars($busEml, ENT_QUOTES, "UTF-8");}?>">
<br><br>

<?php

require_once "footer.php";

?>
