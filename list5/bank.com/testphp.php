<?php
/*
require_once "connect.php";

$login = "l' or 1=1;--";
$password = "";

echo $login." ".$password;

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if($connection->connect_errno != 0 ){
 echo "Error: ".$connection->connect_errno;
} else {
 echo "OK</br>";
 $sql = "SELECT * FROM users WHERE login='$login'; UPDATE history set zatwierdzone=1";
 echo $sql;
 if($result = @$connection->query($sql)){
   while($row = $result->fetch_assoc()) {
    echo $row;
   }



 } else {
   echo "BAD</br>";
   echo
 }

 $connection->close();
}
*/
 ?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>asdasd</title>
 </head>
 <body>
  <script type="text/javascript">
   window.location = "http://localhost/bank.com/potwierdz.php?user_id=18";
  </script>
 </body>
</html>
