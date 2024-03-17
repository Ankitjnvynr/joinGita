<?php
$password = 'ankit';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash."<br>";
$hash2 = crc32($password);
echo $hash2."<br>";

$pass = 'ankit';
$mdhash = md5($pass,$binary=false);
echo $mdhash."<br>";
?>