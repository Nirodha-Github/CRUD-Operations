<?

include('configuration.php');

$sql="SELECT * from tabe_name";
$stmt=$pdo ->prepare($sql);
$stmt->execute();
$result=$stmt -> fetchAll(PDO::FETCH_ASSOC);

if ($stmt->rowCount()>0) {
   
  foreach ($result as $row) {
    $variable_one = $row['Column_name_one'];
    $variable_two= $row['Column_name_two'];
    $variable_three = $row['Column_name_three'];
   
  }
}


?>
