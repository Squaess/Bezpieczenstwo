<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bankujesz</title>
  </head>
  <body>
    <h1>Siamnko!!</h1>
    <?php
    session_start();
    if(!$_SESSION['admin']){
      header("Location: index.php");
    }
    echo "Witaj ".$_SESSION['login'].'[<a href="logout.php">Log out</a>]'."<br/>";
    require_once "connect.php";

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if($connection->connect_errno!=0){
      echo "Error: ".$connection->connect_errno;
    } else {
      $sql = "SELECT  id, user_id, accountnumber, title, amount, Day, zatwierdzone FROM history WHERE zatwierdzone='0'";

      if ($result = @$connection->query($sql)){
        if($result->num_rows > 0){
echo<<<END
         <table border="1" cellpadding="10" cellspacing="0">
         <tr>
         <td>id</td>
         <td>user_id</td>
         <td>acountnumber</td>
         <td>title</td>
         <td>Day</td>
         <td>zatwierdzone</td>
         </tr>
         </table>
END;

          while($row = $result->fetch_assoc()) {
            if($row['zatwierdzone']==0){
              $v0 = $row['id'];
              $v1 = $row['user_id'];
              $v2 = $row['accountnumber'];
              $v3 = $row['title'];
              $v4 = $row['amount'];
              $v5 = $row['Day'];

echo<<<END
<form class="" action="potwierdz.php" method="get">
  <input type="text" name="user_id" value="$v0" readonly>

'$v1' '$v2' '$v3' '$v4' '$v5'
  <input type="submit" value="Potwierdz">
</form>
END;
            }
          }

          $result->free_result();
        } else {
          echo "Brak danych!";
        }
      }
      $connection->close();
    }
    ?>
  </body>
</html>
