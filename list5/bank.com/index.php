<?php
  session_start();

  if(isset($_SESSION['logged']) && $_SESSION['logged']==true){
    if($_SESSION['admin']==false){
      header('Location: form.php');
      exit();
    } else {
      header('Location: admin.php');
      exit();
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BankujeszJakChcesz</title>

  </head>
  <body>
    <p id="demo"></p>
    <form class="" action="zaloguj.php" method="post">
      Podaj login: <br/>
      <input type="text" name="login">
      <br/><br/>
      Podaj haslo: <br/>
      <input type="password" name="password"> <br/>
      <input type="submit" value="Zaloguj">
    </form>
    <?php
    if(isset($_SESSION['error']))
      echo $_SESSION['error'];
echo<<<END
<a href="adminloguj.php">Administrator<>
END;
     ?>
  </body>
</html>
