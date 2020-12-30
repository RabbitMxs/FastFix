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
		<link rel="stylesheet" type="text/css" href="../css/custom.css?v=2.1" />
    </head>
    <body>