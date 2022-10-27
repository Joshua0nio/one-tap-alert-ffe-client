<?php
$DB_NAME = 'onetapalertffe';
$DB_USERNAME = 'gentech';
$DB_PASSWORD = 'gentech123';
$DB_HOSTNAME = '167.172.153.87';
$DB_DIALECT = 'mysql';

$conn = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
