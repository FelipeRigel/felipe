<?php

	die ("CALANDO");
   function connect_db() {
   $servername = "10.0.5.158";
	$userbame = "cinvestav";
	$password = "123";
	$dataBase = "locator2";
	$table = "devices2";

	$enlace = new mysqli($servername, $userbame, $password, $dataBase);
	
    if ($enlace->connect_error) {
        return connect_db2();
    }
    return $enlace;
} 

 function connect_db2() {
   $servername = "10.0.5.232";
	$userbame = "cinvestav1";
	$password = "123";
	$dataBase = "locator2";
	$table = "devices2";

	$enlace = new mysqli($servername, $userbame, $password, $dataBase);
	
    if ($enlace->connect_error) {
        die("Connection failed: " . $enlace->connect_error);
    }
    return $enlace;
}

function close_db($con) {
    $con->close();
}

?>