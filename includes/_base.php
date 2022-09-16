<?php
session_start();
try {  
	$db = new PDO("mysql:host=localhost;dbname=aga_db","kawede@1","180012@#%&Ab");
} catch(Exception $e) {
	exit('impossible to find the data base');
}
?>