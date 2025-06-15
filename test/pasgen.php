<?php
$password = 'password2';  // Replace with the password you want to hash
$hash = password_hash($password, PASSWORD_DEFAULT);

echo $hash;
?>