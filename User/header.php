<?php
	session_start();
	if(!isset($_SESSION['nombre']) && $_SESSION['tipo']=='1'){
		header('location:../index.html?m=50');
	}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fast Fix</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="../css/custom.css" />
    </head>
    <body>