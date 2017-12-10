<?php

  session_start();

  $number = $_POST['accountnumber'];
  $title = $_POST['title'];
  $amount = $_POST['amount'];

  $_SESSION['number'] = $number;
  $_SESSION['title'] = $title;
  $_SESSION['amount'] = $amount;

  header('Location: potwierdzenie.php');
?>
