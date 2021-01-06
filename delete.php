<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['cancel'] ) ) {
    //Redirect the browser to index.php
    header("Location: read.php");
    return;
}

if ( isset($_POST['delete']) && isset($_POST['id']) ) {
    $sql = "DELETE FROM user WHERE Id = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':zip',$_POST['id'],PDO::PARAM_INT);
    $stmt->execute();
    
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: read.php' ) ;
    return;
}

// Guardian: Make sure that id is present
if ( ! isset($_GET['id']) ) {
  $_SESSION['error'] = "Missing id";
  header("Location: delete.php?id=".$row['Id']);
  return;
}

$sql="SELECT * FROM user where Id = :xyz";
$stmt = $pdo->prepare($sql);
$stmt -> bindParam(":xyz",$_GET['id'],PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for id';
    header("Location: delete.php?id=".$row['Id']);
    return;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>cfb758d1 Deleting...</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<title>CRUD Operation </title>
</head>
<body class="bg-dark">
<div class="container row shadow-sm border alert-secondary" style="margin:  5% 10%;">
<div class="col-12 col-sm  p-5">
<div  class="card  p-5">  
<h1 align="center">Delete Data</h1>
<hr>
<p>Confirm: Deleting  <?= htmlentities($row['EmailId']) ?></p>
<form method="post"><input type="hidden" name="id" value="<?= $row['Id'] ?>"> 
  <input type="submit" value="Delete" name="delete">
  <input type="submit" name="cancel" value="Cancel">
</form>
</div>
</div>
</div>
</body>
</html>
