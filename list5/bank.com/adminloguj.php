<?php
  session_start();

  if(isset($_SESSION['logged']) && $_SESSION['logged']==true && $_SESSION['admin']==true && isset($_SESSION['admin'])){
    header('Location: admin.php');
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bankujesz jka chcesz</title>
  </head>
  <body>
    <form action="zalogujadmin.php" method="post">
        Login:
        <input type="text" name="login">
        </br>
        Haslo:
        <input type="password" name="password">
        </br>
        <input type="submit" value="Zaloguj">
    </form>
    <?php
    if(isset($_SESSION['error']))
      echo $_SESSION['error'];
     ?>
  </body>
</html>
