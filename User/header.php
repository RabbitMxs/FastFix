<?php
	session_start();
	//var_dump($_SESSION);
	if(!(isset($_SESSION['nombre'])) || $_SESSION['tipo']=='1'){
		header('location:../index.php?m=50');
	}

?>
<!DOCTYPE html>
<html style="height:100%; margin:0;">
    <head>
        <title>Fast Fix</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="../css/custom.css?v=1.11" />
		<link rel="stylesheet" type="text/css" href="../CSS/jquery-confirm.css?v=1.7">
        <script src="../JS/jquery-3.5.1.min.js"> </script>
		<script src="../JS/bootstrap.js"> </script>
        <script src="../JS/jquery-confirm.js"> </script>
    </head>
    <body style="height:100%; margin:0; background: linear-gradient(180deg, rgba(255,255,255,1) 50%, rgba(169,223,236,1) 87%, rgba(84,191,216,1) 100%);">