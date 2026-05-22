<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_tk_maessar";

$conn = @mysqli_connect($host, $user, $pass, $db);
$conn_error = !$conn ? mysqli_connect_error() : null;
?>