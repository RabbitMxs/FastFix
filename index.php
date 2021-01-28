<?php

if(isset($_POST['action'])){
	switch($_POST['action']){
		case 'login':
			session_start();
			include "class/classBaseDatos.php";
			$query="select * from usuario 
						where email='".$_POST['email']."' 
						and clave= password('".$_POST['pass']."')";
			$oBD->conecta();
			$registro=$oBD->sacaTupla($query);
			$oBD->cierraBD();
			var_dump($registro);
			if($oBD->numeTuplas==1){//si encuentra por lo menos a un usuario con el correo y contraseña
				//$registro=mysqli_fetch_object($bloque);//obtiene el regsitro
				$_SESSION['nombre']=$registro->nombre;
				$_SESSION['tipo']=$registro->idTipoUsuario;
				$_SESSION['id']=$registro->id;
				//$_SESSION['foto']=$registro->id.".".$registro->foto;
				if($registro->idTipoUsuario=='2'){
					header("location: User/home.php");
				}
				if($registro->idTipoUsuario=='1'){
					header("location: Admin/home.php");
				}
				if($registro->idTipoUsuario=='3'){
					header("location: Gerente/home.php");
				}
			}else{//si no encuentra ningun usuario
				header("location: index.php?m=5");
			}
		break;
	}
}
else{
	echo '<!DOCTYPE html>
	<html style="height:100%; margin:0;">
		<head>
			<title>Fast Fix</title>
			<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
			<link rel="stylesheet" type="text/css" href="css/custom.css" />
		</head>
		<body style="height:100%; margin:0; background: linear-gradient(180deg, rgba(255,255,255,1) 50%, rgba(169,223,236,1) 87%, rgba(84,191,216,1) 100%);"> 
			<div class="container d-grid ancho-col una-col">
				<img src="images/logo.png" alt="Fast Fix" class="img-fluid mx-auto" />
				<form method="post" class="d-grid una-col">
					<div>
						<label for="email">Email address</label>
						<input
							type="email"
							class="form-control"
							id="email"
							name="email"
							aria-describedby="emailHelp"
							placeholder="Enter email"
						/>
						<small id="emailHelp" class="form-text text-muted"
							>We will never share your email with anyone else.
						</small>
					</div>
	
					<div>
						<label for="password" class="col-sm-2 col-form-label">Password</label>
						<input type="password" class="form-control" id="password" name="pass"/>
					</div>
					<input 
						type="hidden" 
						name="action" 
						value="login">
					<button type="submit" class="btn btn-custom space-items d-sm-block">
						Submit
					</button>
				</form>';
			session_start();
			session_destroy();
			if(isset($_GET['m'])){
				switch($_GET['m']){
					case 1: echo '<h6 class="space-items mx-auto " >REGISTRO FALLIDO</h6>';
						break;
					case 5: echo '<h6 class="space-items mx-auto">USUARIO NO REGISTRADO</h6>';
						break;
					case 50: echo '<h6 class="space-items mx-auto">NO TE LOGEASTE</h6>';
						break;
					case 60: echo '<h6 class="space-items mx-auto">NO TIENE PRIVILEGIOS PARA ESTAR AQUI</h6>';
						break;
					case 100: echo '<h6 class="space-items mx-auto">SESION TERMINADA</h6>';
						break;	
				}
			}	
			echo'<a
					href="recover.php"
					class="link-secondary text-decoration-none text-capitalize mx-auto space-items"
				>
					forgot password?
				</a>
				<b class="mx-auto">
					<a
						href="register.php"
						class="link-secondary text-decoration-none text-capitalize text-black-50"
					>
						Sing in
					</a>
				</b>
			</div>
		</body>
	</html>
	';
}
?>
