<?php
  session_start();

  if(!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BankujeszJakChcesz</title>
  </head>
  <body>
    <?php
    echo "Witaj ".$_SESSION['login'].'[<a href="logout.php">Log out</a>]'."<br/>";
    echo "Twoje haslo to: ".$_SESSION['password']."<br/>";
    echo "Twoj email to: ".$_SESSION['email']."<br/>";
    ?>

    <form action="przelew.php" method="post">
      Numer Konta:
      <input type="text" name="accountnumber">
      </br>

      Kwota:
      <input type="text" name="amount">
      </br>

      Tytul:
      <input type="text" name="title">
      </br>
      <input type="submit" value="Przelej">
    </form>
    </br>
    <form action="history.php" method="post">
      <input type="submit" value="Historia">
    </form>
    <?php
    if(isset($_SESSION['error2']))
      echo $_SESSION['error2'];
     ?>
  </body>
</html>
