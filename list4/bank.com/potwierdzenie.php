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
    echo "Tytul: ".$_SESSION['title'].'</br>';
    echo "Kwota: ".$_SESSION['amount'].'</br>';
    echo "Nr konta: ".$_SESSION['number'].'</br>';
    echo "<form action='przeslij.php' method='post'><input type='submit' value='Potwierdz'></form>";
    ?>
  </body>
</html>
