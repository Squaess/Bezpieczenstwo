<?php
var_dump([
    SODIUM_LIBRARY_MAJOR_VERSION,
    SODIUM_LIBRARY_MINOR_VERSION,
    SODIUM_LIBRARY_VERSION
]);

// hash the password and return an ASCII string suitable for storage
$password = "Diane";
$hash_str = sodium_crypto_pwhash_str(
    $password,
    SODIUM_CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
    SODIUM_CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
);
echo "</br>".$hash_str;
if(sodium_crypto_pwhash_str_verify($hash_str, $password)){
  echo "</br>"."True"."</br>";
} else {
  echo "</br>"."False";
}

require_once "connect.php";

$connection = @new mysqli($host, $db_user, $db_password, $db_name);

if($connection->connect_errno!=0){
  echo "Error: ".$connection->connect_errno;
} else {

  $sql = "UPDATE users SET password='$hash_str' WHERE user_id='1'";

  if ($result = @$connection->query($sql)) {
      echo "Query ok";
  }

  $connection->close();

}
?>
