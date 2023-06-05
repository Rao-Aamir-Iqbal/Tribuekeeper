

	<?php 
	
// 		ini_set('session.cookie_secure', false);
// 		ini_set('session.cookie_httponly', true);
// 		ini_set('session.use_only_cookies', 1);

// 		session_start();
//      session_regenerate_id();
		require_once "connect.php";
		$HTTP_HOST = $_SERVER['HTTP_HOST'];
		$REQUEST_SCHEME = $_SERVER['REQUEST_SCHEME'];

	?>

	<meta charset="utf-8">
	<title> Tributekeeper - Dashboard </title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link rel="stylesheet" href="/admin-panel/vendors/styles/style.css">

	<!-- Datatables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
	<link rel="stylesheet" href="/DataTables/datatables.css" />