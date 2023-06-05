<?php
 session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!isset($_GET['memorial_id'])) {
	header("location: /login");
}
$memorial_id = $_GET['memorial_id'];
$_SESSION['user_id'] = $memorial_id;
$user_id = $_SESSION['user_id'];
$username = $_GET['username'];
header("location:/public_profile/$username");
