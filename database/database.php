<?php

$username = 'root';
$password = '';

// $username = 'z254';
// $password = '3Cdf7AJjH=TK';

$dbname = "citron_bank";
$host = "localhost";

$dsn = "mysql:host=".$host.";dbname=".$dbname.";charset=utf8";

return $database = new PDO($dsn, $username, $password);

