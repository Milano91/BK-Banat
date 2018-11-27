<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "milan_boks");

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

if($conn->connect_errno > 0){
  die('Neuspesna konekcija');
}

?>