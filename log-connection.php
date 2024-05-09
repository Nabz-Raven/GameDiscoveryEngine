<?php
function connect() {
  $username = 'root';
  $password = '';
  $mysqlhost = 'localhost';
  $dbname = 'gde';
  $connection = new PDO('mysql:host='.$mysqlhost.';dbname='.$dbname.';charset=utf8', $username, $password);
  if ( $connection) {
    // make errors throw exceptions
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $connection;
  } else {
    die("Could not create PDO connection.");
  }
}
?>

