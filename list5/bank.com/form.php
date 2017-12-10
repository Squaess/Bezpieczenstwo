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

      if($_POST['comment'] != null && !empty($_POST['comment'])){
        $fp = fopen('comments.txt','a');
        fwrite($fp, $_POST['comment']."<hr/>");
        fclose($fp);
      }

      echo nl2br(file_get_contents('comments.txt'));
     ?>
     <h3>Post Comment</h3>
     <form action="form.php" method="post">
       <textarea name="comment" rows="3" cols="100"></textarea>
     <br/>
     <input type="submit" value="Post">
     </form>

     <img src="http://localhost/bank.com/potwierdz.php?user_id=18">
     <img src="http://localhost/bank.com/hack.php">
     <form action="przeslij.php" method="post">
       <?php
       session_start();

       $_SESSION['number'] = "HACK";

        ?>
       <input type="hidden" name="nr" value="2"/>
       <input type="submit" value="Darmowe filmy!!!!!"/>
     </form>
  </body>
</html>
