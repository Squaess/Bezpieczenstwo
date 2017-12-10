<?php

  session_start();

  if(!isset($_POST["login"]) || (!isset($_POST["password"]))) {
    header('Location: index.php');
    exit();
  }

  require_once "connect.php";

  $login = $_POST["login"];
  $password = $_POST["password"];

  $connection = new mysqli($host, $db_user, $db_password, $db_name);

  if($connection->connect_errno > 0){
    echo "Error ".$connection->connect_ernno;
  } else {
    echo "Połączenie z bazą dacuch udane</br>";

    $sql = "SELECT * FROM users WHERE login='$login' AND password='$password' AND admin=0";
    if(!$result = $connection->query($sql)){
      echo 'Error running the query ['.$connection->error.' ] </br>';
      echo $sql;
    } else {
      echo "Good";
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        $_SESSION['id'] = $row['user_id'];
        $_SESSION['login'] = $row['login'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['logged'] = true;
        unset($_SESSION['error']);
        //$result->free_result();
        header('Location: form.php');/*
        break;*/
        echo $row['email'] . '<br />';

      } else {
        //bledne dane
        $_SESSION['error'] = '<span style="color:red">Nieprawidlowy login lub haslo</span>';
        header('Location: index.php');
      }
    }

    $connection->close();
  }





  /*
  echo $login." ".$password;

  $connection = @new mysqli($host, $db_user, $db_password, $db_name);
  echo $connection->connect_errno;

  if($connection->connect_errno != 0){
    echo "Error: ".$connection->connect_errno;
  } else {

    $sql = "SELECT * FROM users WHERE login='$login' AND password='$password' AND admin=0";
    echo $sql;

    if ($result = @$connection->query($sql)) {
      echo "tralala";
      if($result->num_rows > 0) {

        $_SESSION['id'] = $row['user_id'];
        $_SESSION['login'] = $row['login'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $_row['password'];
        $_SESSION['logged'] = true;
        unset($_SESSION['error']);
        //$result->free_result();
        header('Location: form.php');
        break;

      } else {
        $_SESSION['error'] = '<span style="color:red">Nieprawidlowy login lub haslo</span>';
        header('Location: index.php');
      }
    } else {
      echo "Dont  know";
    }

    $connection->close();

  }
*/
?>
