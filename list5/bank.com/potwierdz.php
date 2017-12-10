<?php
require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name);
$id = $_GET['user_id'];
if($connection->connect_errno!=0){
 echo "Error";
} else {
 $sql = "UPDATE history set zatwierdzone=1 WHERE id='$id'";
 echo $id;
 if ($result = @$connection->query($sql)){
  if($result->num_rows > 0){
   header('Location: admin.php');
   echo "OK";
  } else {
   echo "error query rows <= 0";
   header('Location: admin.php');
  }
  $result->free_result();
 } else {
  echo "error bad connection or sql query";
 }
 $connection->close();
}
 ?>
