<?php
if(isset($_POST['action'])){
	include "class/classBaseDatos.php";
	switch($_POST['action']){
		case 'send':
			$query="SELECT * FROM usuario 
			WHERE email='".$_POST['email']."'";
			$oBD->conecta();
			$oBD->query($query);
			if($oBD->numeTuplas>0){
				header("location: register.php");
			}
			else{
				$cadena="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
				$numeC=strlen($cadena);
				$nuevPWD="";
				for ($i=0; $i<8; $i++)
				$nuevPWD.=$cadena[rand()%$numeC]; 
				$query="insert into usuario
					set nombre='".$_POST['name'].
					"', apellidoP='".$_POST['lastP'].
					"', apellidoM='".$_POST['lastM'].
					"', genero='".$_POST['gender'].
					"', IdTipoUsuario='2'
					, email='".$_POST['email'].
					"', clave=password('".$nuevPWD."')";
			
				include("Recursos/class.phpmailer.php");
				include("Recursos/class.smtp.php");
				$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->Host="smtp.gmail.com";   //mail.google
					$mail->SMTPSecure = 'ssl';      // secure transfer enabled REQUIRED for GMail
					$mail->Port = 465;              // set the SMTP port for the GMAIL server
					$mail->SMTPDebug  = 1;          // enables SMTP debug information (for testing)
													// 1 = errors and messages
													// 2 = messages only
					$mail->SMTPAuth = true;         //enable SMTP authentication
			
					$mail->Username =   "17030830@itcelaya.edu.mx"; // SMTP account username
					$mail->Password = "jorge1399";                  // SMTP account password
			
					$mail->From="";
					$mail->FromName="";
					$mail->Subject = "Registro completo";
					$mail->MsgHTML("<h1>BIENVENIDO ".$_POST['name']." ".$_POST['lastP']." ".$_POST['lastM']."</h1><h2> tu clave de acceso es : ".$nuevPWD."</h2>");
					$mail->AddAddress($_POST['email']);  //$mail->AddAddress("admin@admin.com"); para enviarlo a mas personas
					if (!$mail->Send()){ 
						echo  "Error: " . $mail->ErrorInfo;
					}
					else {
						$oBD->query($query);
						header("location: index.php?m=1"); 
					}
				
			}
		break;
	}
}
else{
	echo '<!DOCTYPE html>
			<html lang="en">
				<head>
					<title>Fast Fix</title>
					<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
					<link rel="stylesheet" type="text/css" href="css/custom.css" />
				</head>
				<body>
					<h3 class="logo-return">
						<a href="index.php">
							 <img src="images/logo.png" alt="Logo" width="90" height="90"/>
						</a>
					</h3>
					<form method="post" class="container d-grid tres-col space-cell mx-auto">
							<div class="form-group">
								<label class="col-form-label" for="name">Name</label>
								<input
									type="text"
									class="form-control"
									placeholder="Juan"
									required
									id="name"
									name="name"
								/>
							</div>
							<div class="form-group">
								<label class="col-form-label text-capitalize" for="lastF">Last Name</label>
								<input
									type="text"
									class="form-control"
									placeholder="Lopez"
									required
									id="lastP"
									name="lastP"
								/>
							</div>
							<div class="form-group">
								<label class="col-form-label text-capitalize" for="lastM">Last Name</label>
								<input
									type="text"
									class="form-control"
									placeholder="Juarez"
									required
									id="lastM"
									name="lastM"
								/>
							</div>
							<div class="form-group">
								<label for="email">Email address</label>
								<input
									type="email"
									class="form-control"
									required
									aria-describedby="emailHelp"
									placeholder="juan@example.com"
									id="email"
									name="email"
								/>
								<small id="emailHelp" class="form-text text-muted"
									>We will never share your email with anyone else.</small
								>
							</div>
							<div class="form-group" id="sexo">
								<label for="sexo">Gender</label>
								<div class="custom-control custom-radio">
									<input
										type="radio"
										id="male"
										name="gender"
										class="custom-control-input"
										value="M"
										checked
									/>
									<label class="custom-control-label" for="male">Male</label>
								</div>
								<div class="custom-control custom-radio">
									<input
										type="radio"
										id="female"
										name="gender"
										class="custom-control-input"
										value="F"
									/>
									<label class="custom-control-label" for="female">Female</label>
								</div>
							</div>
							<div>
								<input 
									type="hidden" 
									name="action" 
									value="send">
							</div>
							<div class="button-submit unir-celdas mx-auto">
								<button type="submit" class="btn btn-custom btn-submit">
									Submit
								</button>
							</div>
						<div>
					</form>
				</body>
			</html>
			';
}
?>