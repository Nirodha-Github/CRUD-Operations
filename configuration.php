<?php

# For windows = 3306
# Use db name instead of Database_name

try {
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=Database_name', 
   'root', '');
} 
catch (Exception $e) {
	exit("Error:".$e -> getMessage());
	
}


?>
