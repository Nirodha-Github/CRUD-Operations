<?php
require_once "pdo.php";
session_start();


if ( isset($_POST['cancel'] ) ) {
    //Redirect the browser to index.php
    header("Location: read.php");
    return;
}

//insert data

if(isset($_POST['insert'])) {

    // Data validation
    if (strlen($_POST['name']) < 1 || strlen($_POST['email']) < 1||strlen($_POST['phonenumber']) < 1 || strlen($_POST['feedback']) < 1) {
        $_SESSION['error'] = 'All fields are required';
    }

    else if ( filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)===false) {
        $_SESSION['error'] = 'Please enter valid email address';

    } 
        else{
            
              $name= $_POST['name'];
              $phonenumber= $_POST['phonenumber'];
              $email= $_POST['email'];
              $feedback= $_POST['feedback'];

              $sql = "INSERT INTO user (Name,PhoneNumber,EmailId,Feedback)
              VALUES (:name, :phonenumber, :email, :feedback)";
              $stmt = $pdo->prepare($sql);
              $stmt -> bindParam(':name',$name,PDO::PARAM_STR);
              $stmt -> bindParam(':phonenumber',$phonenumber,PDO::PARAM_STR);
              $stmt -> bindParam(':email',$email,PDO::PARAM_STR);
              $stmt -> bindParam(':feedback',$feedback,PDO::PARAM_STR);
              $stmt->execute();
              $_SESSION['success'] = 'Data Inserted';
              header( 'Location: read.php' ) ;
              return;
  }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>CRUD Operation</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>CRUD Operation </title>
</head>
<body class="bg-dark">
<div class="container row shadow-sm border alert-secondary" style="margin: 5% 10%;">
<div class="col-12 col-sm  p-5">
<div  class="card  p-5">  
<h1 align="center">Insert Data</h1>
<hr>
<?php

echo("<h1>Welcome  ".htmlentities($_SESSION['email'])." !</h1>");

if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }

?>
<form method="post">
<p>Name:<input type="name" name="name" size="40"/></p>
<p>Email:<input type="email" name="email" size="40"/></p>
<p>Phonenumber:<input type="tel" name="phonenumber" size="35"/></p>
<p>Feedback:<input type="textArea" name="feedback" rows="10"/></p>
<input type="submit" name='insert' value="Insert"></a>
<input type="submit" name="cancel" value="Cancel"></a>
</form>
<p>
</div>
</div>
</div>  
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
</html>
