<?php
include(configuration.php);

if(isset($_POST['insert'])){

   //getting post values
   $name=$_POST['fullname'];
   $phnNo=$_POST['phonenumber'];
   $email=$_POST['emailId'];
   
   $sql="INSERT INTO user(Name,PhoneNUmber,EmailId) VALUES(:name,:phone,:email)";
   
   $query= $pdo -> prepare($sql);
   
   $stmt -> bindParam(':name',$phnNo,PDO::PARAM_STR);
   $stmt -> bindParam(':phone',$phonenumber,PDO::PARAM_STR);
   $stmt -> bindParam(':email',$email,PDO::PARAM_STR);
    
   $stmt->execute();

  $lastinsertid=$pdo -> lastInsertId();
  if($lastinsertid){
       echo "Data Inserted";
        }
        
 else{
      echo "Something went wrong";
        }
}

?>
