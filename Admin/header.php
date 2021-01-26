<?php
	session_start();
	//var_dump($_SESSION);
	if(!(isset($_SESSION['nombre'])) || $_SESSION['tipo']=='2'){
		header('location:../index.php?m=50');
	}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fast Fix</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="../css/custom.css?v=2.3" />
		<link rel="stylesheet" type="text/css" href="../CSS/jquery-confirm.css?v=1.7">
        <script src="../JS/jquery-3.5.1.min.js"> </script>
		<script src="../JS/bootstrap.js"> </script>
        <script src="../JS/jquery-confirm.js"> </script>
	</head>
    <body>