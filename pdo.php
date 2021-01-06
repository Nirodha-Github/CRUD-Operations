<?php

# For windows = 3306
# Use db name instead of Learn_Crud

try {
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=Learn_Crud', 
   'root', '');
} 
catch (Exception $e) {
	exit("Error:".$e -> getMessage());
	
}


?>
