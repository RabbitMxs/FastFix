<?php
if(isset($_POST['action'])){
	include "class/classBaseDatos.php";
	switch($_POST['action']){
		case 'recover':
			$query="SELECT * FROM usuario 
					WHERE email='".$_POST['email']."'";
			$oBD->conecta();
			$oBD->query($query);
			if($oBD->numeTuplas==0){
				echo $query;
				//header("location: index.php");
			}
			else{
				$cadena="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
				$numeC=strlen($cadena);
				$nuevPWD="";
				for ($i=0; $i<8; $i++){
					$nuevPWD.=$cadena[rand()%$numeC];
				}
				$query="UPDATE usuario SET ".
					"clave=password('".$nuevPWD."')";
			
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
					$mail->Subject = "Recupera tu contraseña";
					$mail->MsgHTML("<h2>Tu clave de acceso es : ".$nuevPWD."</h2>");
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
					<a href="index.html"
						><img src="images/logo.png" alt="Logo" width="90" height="90"
					/></a>
				</h3>
				<form method="post" class="container d-grid ancho-col una-col mx-auto mt-6">
					<div>
						<label for="email">Email address</label>
						<input
							type="email"
							class="form-control"
							id="email"
							name="email"
							placeholder="Enter email"
						/>
						<small id="emailHelp" class="form-text text-muted"
							>We will never share your email with anyone else.
						</small>
						<input 
							type="hidden" 
							name="action" 
							value="recover">
					</div>
					<button type="submit" class="btn btn-custom space-items d-sm-block">Submit</button>
				</form>
			</body>
		</html>
	';
}
?>