<?php

session_start();
include 'includes/conn.php';

if(!isset($_SESSION['users']) || trim($_SESSION['users']) == ''){
	header('location: index.php');
}

$sql = "SELECT * FROM users WHERE id = '".$_SESSION['users']."' AND user_type_id = '1'";
$query = $conn->query($sql);
$user = $query->fetch_assoc();

$sql = "SELECT * FROM users WHERE id = '".$_SESSION['users']."' AND user_type_id = '4'";
$query = $conn->query($sql);
$user = $query->fetch_assoc();

$sql = "SELECT * FROM users WHERE id = '".$_SESSION['users']."' AND user_type_id = '5'";
$query = $conn->query($sql);
$user = $query->fetch_assoc();
