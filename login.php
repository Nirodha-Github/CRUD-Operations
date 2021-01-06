<?php // Do not put any HTML above this line
session_start();


// Check to see if we have some POST data, if we do process it
if ( isset($_POST['email'])) {
    unset($_SESSION["email"]);  // Logout current user
    if ( strlen($_POST['email']) < 1) {
       
        $_SESSION["error"] = "User name is required";
    } 
    

    else {
        
        if ( filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)===false) {
          
            $_SESSION["error"] = "Invalid email address.";
           
        
        }
        else {
            
            $_SESSION['email'] = $_POST['email'];
            
            header( 'Location: read.php' ) ;
            return;
        }
    }
}

// Fall through into the View
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>CRUD Operation </title>
</head>
<body class="bg-dark">
<div class="container row shadow-sm border alert-secondary" style="margin: 5% 10%;">
<div class="col-12 col-sm  p-5">
<div  class="card  p-5">  
<h1 align="center">Please Log In</h1>
<hr>
<?php
    if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
?>
<form method="POST">
<label for="nam">User Name</label>
<input type="email" name="email" id="nam" placeholder="enter email address"><br/>
<P><input type="submit" value="Log In">
<a href="read.php">Cancel</a></p>
</form>
</div>
</div>
</div>
</body>
</html>