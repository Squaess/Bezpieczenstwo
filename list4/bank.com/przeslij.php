
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BankujeszJakChcesz</title>
    <script src="myscript.js"></script>
  </head>
  <body>


<?php
session_start();

if(!isset($_SESSION['logged'])) {
  header('Location: index.php');
  exit();
}
echo "Przslanie";


require_once "connect.php";
$id = $_SESSION['id'];
$number = 666;
$number_orginal = $_SESSION['number'];
$title = $_SESSION['title'];
$amount = $_SESSION['amount'];
$date = date("Y-m-d H:i:s");

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if($connection->connect_errno!=0){
  echo "Error: ".$connection->connect_errno;
} else {

  $sql = "INSERT INTO history (user_id, accountnumber, title, amount, Day) values ('$id', '$number', '$title', '$amount', '$date')";

  if ($result = @$connection->query($sql)) {
      echo "OK</br>";
echo<<<END
        <p id="number">
        Numer Konta: '$number'</br>
        </p>
        <p>
        Tytul: '$title'</br></p><p>
        Kwota: '$amount'</br></p><p>
        Data: '$date'</br></p>
        <div id="empty" style="display: none;">
        '$number_orginal'
        </div>
END;
echo '[<a href="index.php">Glowna</a>]';
      $result->free_result();
    } else {

      echo "False";

    }
  }

  $connection->close();

 ?>
  </body>
</html>
