<?php
require_once "pdo.php";
session_start();


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
<h2 align="center">Home Page-Read Data</h2>
<hr>
<?php

if(isset($_SESSION['email']) && strlen($_SESSION['email'])>=1){
    if(isset($_SESSION['success'])) {
        echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
        unset($_SESSION['success']);
        echo('<table border="1">'."\n");
            //Data Select 
            $sql="SELECT * FROM user where EmailId=:eml";
            $stmt = $pdo->prepare($sql);
            $stmt -> bindParam(':eml',$_SESSION['email'],PDO::PARAM_STR);
            $stmt-> execute();
            echo("<tr><th>Name</th><th>PhoneNumber</th><th>EmailId</th><th>Feedback</th><th>Action</th></tr>");            
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                 echo "<tr><td>";
                 echo(htmlentities($row['Name']));
                 echo("</td><td>");
                 echo(htmlentities($row['PhoneNumber']));
                 echo("</td><td>");
                 echo(htmlentities($row['EmailId']));
                 echo("</td><td>");
                 echo(htmlentities($row['Feedback']));
                 echo("</td><td>");  
                 echo('<a href="update.php?id='.$row['Id'].'">Update</a> / ');
                 echo('<a href="delete.php?id='.$row['Id'].'">Delete</a>');
                 echo("</td></tr>\n");
        }
}
    else{
        echo("<p>No rows found</p>"); 
    }
    echo('<p><a href="create.php">Insert Data</a></p>');
    echo('<p><a href="logout.php">Logout</a></p>');
         
 

}

else{
  echo('<p>Please log in  <a href="login.php">here</a></p>');
  
}
?>
</div>
</div>
</div>
</body>
</html>
