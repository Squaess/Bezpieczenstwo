<?php
  session_start();
  if(!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
  }
  require_once "connect.php";

  $id = $_SESSION['id'];

  $connection = @new mysqli($host, $db_user, $db_password, $db_name);

  if($connection->connect_errno!=0){
    echo "Error: ".$connection->connect_errno;
  } else {

    $sql = "SELECT  login, password, email, accountnumber, title, amount, Day FROM history inner JOIN users on history.user_id = users.user_id WHERE history.user_id='$id'";
    if ($result = @$connection->query($sql)) {

      if($result->num_rows > 0) {
echo<<<END
         <table border="1" cellpadding="10" cellspacing="0">
         <tr>
         <td>Login</td>
         <td>Haslo</td>
         <td>email</td>
         <td>numerkonta</td>
         <td>tytul</td>
         <td>kwota</td>
         <td>Data</td>
         </tr>
         </table>

END;
        while($row = $result->fetch_assoc()) {
          $v1 = $row['login'];
          $v2 = $row['password'];
          $v3 = $row['email'];
          $v4 = $row['accountnumber'];
          $v5 = $row['title'];
          $v6 = $row['amount'];
          $v7 = $row['Day'];

echo<<<END
 <table border="1" cellpadding="10" cellspacing="0">
 <tr>
 <td>'$v1'</td>
 <td>'$v2'</td>
 <td>'$v3'</td>
 <td>'$v4'</td>
 <td>'$v5'</td>
 <td>'$v6'</td>
 <td>'$v7'</td>
 </tr>
 </table>

END;
        }

echo<<<END
<form action="index.php" method="post">
  <input type="submit" value="Glowna">
</form>
END;
        $result->free_result();
      } else {
        echo "Brak danych!";
      }
    }
    $connection->close();
  }
?>
