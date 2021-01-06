<?php
require_once "pdo.php";
session_start();




if ( isset($_POST['cancel'] ) ) {
    //Redirect the browser to index.php
    header("Location: read.php");
    return;
}

if(isset($_POST['update'])) {

    // Data validation
    if ( strlen($_POST['name']) < 1 || strlen($_POST['email']) < 1 || !isset($_POST['phonenumber'])  ||  !isset($_POST['feedback'])) {
        $_SESSION['error'] = 'All fields are required';
         header("Location: update.php?id=".$_REQUEST['id']);
        return;
    }

    else 
        if ( filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)===false) {
            $_SESSION['error'] = 'Please enter valid email';
            header("Location: update.php?id=".$_REQUEST['id']);
            return;
    }
        else if ( !isset($_GET['id']) ) {
        // Guardian: Make sure that id is present
               $_SESSION['error'] = "Missing id";
               header("Location: update.php?id=".$_REQUEST['id']);
               return;
}

             else{

              $id= $_POST['id'];
              $name= $_POST['name'];
              $phonenumber= $_POST['phonenumber'];
              $email= $_POST['email'];
              $feedback= $_POST['feedback'];

               $sql = "UPDATE user SET Name = :name,
               EmailId = :email, PhoneNumber = :phonenumber, Feedback = :feedback 
               WHERE Id = :id";
               $stmt = $pdo->prepare($sql);
               $stmt -> bindParam(':id',$id,PDO::PARAM_INT);
               $stmt -> bindParam(':name',$name,PDO::PARAM_STR);
               $stmt -> bindParam(':phonenumber',$phonenumber,PDO::PARAM_STR);
               $stmt -> bindParam(':email',$email,PDO::PARAM_STR);
               $stmt -> bindParam(':feedback',$feedback,PDO::PARAM_STR);
               $stmt->execute();
               $_SESSION['success'] = 'Record updated';
               header( 'Location: read.php' ) ;
               return;
             }
}


$stmt = $pdo->prepare("SELECT * FROM user where Id = :xyz");

$stmt->bindParam(":xyz",$_GET['id'],PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for id';
    header("Location: update.php?id=".$_REQUEST['id']);
    return;

            
    }

  
$n = htmlentities($row['Name']);
$p = htmlentities($row['PhoneNumber']);
$e = htmlentities($row['EmailId']);
$f = htmlentities($row['Feedback']);
$rid = $row['Id'];
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
<div class="container row shadow-sm border alert-secondary" style="margin: 3% 10%;">
<div class="col-12 col-sm  p-5">
<div  class="card  p-5">  
<h1 align="center">Update Data</h1>
<hr>
<?php
// Flash pattern
if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }

?>
<form method="post">
<p>Name<input type="text" name="name" size="40" value="<?= $n?>"></p>
<p>Email<input type="email" name="email" size="40" value="<?= $e?>"></p>
<p>Phonenumber<input type="tel" name="phonenumber" size="10" value="<?= $p?>"></p>
<p>Feedback<input type="textArea" name="feedback" size="10" value="<?= $f?>"/></p>
<input type="hidden" name="id" value="<?= $rid ?>">
<input type="submit" name="update" value="Update">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
</div>
</div>
</div>
</body>
</html>
