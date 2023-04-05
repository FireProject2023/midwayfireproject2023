<?php

//log user out
session_start();
session_unset();
session_destroy();

header("Location: confirm.php?state=1");
