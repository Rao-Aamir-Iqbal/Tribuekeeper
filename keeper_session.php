<?php
 session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

if (!isset($_GET['keeper_id'])) {
	header("location: /login");
}
$keeper_id = $_GET['keeper_id'];
$_SESSION['user_id'] = $keeper_id;
$user_id = $_SESSION['user_id'];
$username = $_GET['username'];
header("location:/profile/$username");
