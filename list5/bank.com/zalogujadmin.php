<?php
  session_start();

  if(!isset($_POST["login"]) || (!isset($_POST["password"]))) {
    header('Location: index.php');
    exit();
  }

  require_once "connect.php";
  $login = $_POST['login'];
  $password = $_POST['password'];

  $connection = @new mysqli($host, $db_user, $db_password, $db_name);

  if($connection->connect_errno!=0){
    echo "Error: ".$connection->connect_errno;
  } else {

    $sql = "SELECT * FROM users WHERE login='$login' AND password='$password' and admin=1";

    if ($result = @$connection->query($sql)) {

      if($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $_SESSION['id'] = $row['user_id'];
        $_SESSION['login'] = $row["login"];
        $_SESSION['email'] = $row["email"];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['logged'] = true;
        $_SESSION['admin']=true;
        unset($_SESSION['error']);
        $result->free_result();
        header('Location: admin.php');


      } else {
        $_SESSION['error'] = '<span style="color:red">Nieprawidlowy login</span>';

        header('Location: index.php');
      }
    }

    $connection->close();
  }
?>
