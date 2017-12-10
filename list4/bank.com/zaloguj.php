<?php

  session_start();

  if(!isset($_POST["login"]) || (!isset($_POST["password"]))) {
    header('Location: index.php');
    exit();
  }

  require_once "connect.php";

  $login = $_POST["login"];
  $password = $_POST["password"];

  $connection = @new mysqli($host, $db_user, $db_password, $db_name);

  if($connection->connect_errno!=0){
    echo "Error: ".$connection->connect_errno;
  } else {

    $sql = "SELECT * FROM users WHERE login='$login'";

    if ($result = @$connection->query($sql)) {

      if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $hash_str = $row["password"];
          if(sodium_crypto_pwhash_str_verify($hash_str, $_POST['password'])){
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['login'] = $row["login"];
            $_SESSION['email'] = $row["email"];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['logged'] = true;
            unset($_SESSION['error']);
            $result->free_result();
            header('Location: form.php');
            break;
          } else {
            continue;
          }
        }


      } else {
        $_SESSION['error'] = '<span style="color:red">Nieprawidlowy login</span>';

        header('Location: index.php');
      }
    }

    $connection->close();
  }
?>
