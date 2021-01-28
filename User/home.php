<?php
	include "header.php";
	include "menu.php";
	include "../class/classBaseDatos.php";
	$tabla="cotizacion";
	$query="SELECT c.id, CONCAT('$',c.total) as Total, c.fecha, tc.nombre 
			from ".$tabla." c
			INNER JOIN tipocotizacion tc on tc.idTipoCotizacion=c.idTipoCotizacion
			where c.idUsuario='".$_SESSION['id']."'";

	$registro=$oBD->sacaTupla("SELECT * from usuario WHERE id='".$_SESSION['id']."'");
	if(isset($_POST['action'])){
		switch ($_POST['action']){
			case 'formEdit':
				echo '<form class="container d-grid tres-col space-cell mt-7" method="post">
						<div class="centrar">
							<img src="../images/logo.png" alt="Imagen"/>
						</div>
						<div class="d-grid una-col space-cell">
							<div class="form-group">
								<label for="name">Name</label></br>
								<input 
									type="text" 
									class="form-control" 
									id="name" 
									name="nombre" 
									value="'.$registro->nombre.'"
								>
							</div>
							<div class="form-group">
								<label for="lastF">Last Father</label></br>
								<input 
									type="text" 
									class="form-control" 
									id="lastF" 
									name="apellidoP" 
									value="'.$registro->apellidoP.'"
								>
							</div>
							<div class="form-group">
								<label for="lastM">Last Mother</label></br>
								<input 
									type="text" 
									class="form-control" 
									id="lastM" 
									name="apellidoM" 
									value="'.$registro->apellidoM.'"
								>
							</div>
							<div class="form-group">
								<label for="email">Email</label></br>
								<input 
									type="text" 
									class="form-control" 
									id="email" 
									name="email" 
									value="'.$registro->email.'"
								>
							</div>
						</div>
						<div class="d-grid una-col space-cell">
							<div style="width: 100%;" class="btn-block my-auto btn-lg mx-auto my-auto" method="post">
								<input type="hidden" name="action" value="update">
								<input style="width: 100%;"  class="btn btn-custom d-sm-block btn-lg text-capitalize my-auto" type="submit" value="Aceptar">
							</div>
						</div>
					</form>';
			break;
			
			case 'moreInfo':
				$query="SELECT c.nombre, c.caracteristicas, CONCAT('$',c.costo) as Costo FROM compcotizacion ct 
				INNER JOIN componente c on c.id = ct.idComponente
				WHERE idCotizacion=".$_POST['id'];
				echo '<div class="container">';
				echo '<h2 class="space-items">Quote Details '.$_POST['id'].'</h2>';
				echo $oBD->mostTabla($query,array(),"table-light",array('25%','65%','10%'));

				$query="SELECT total FROM cotizacion WHERE id=".$_POST['id']; 
				$registro=$oBD->sacaTupla($query);
				echo '<div style="display: flex;justify-content: end;font-size: x-large;">
                    <label>Total: $'.$registro->total.'</label>
                </div>';
                echo '</div>';
			break;

			case 'cotizacion':
				echo '<div class="container">';
				echo '<h2 class="space-items">My Quotes </h2>';
				echo $oBD->mostTabla($query,array("delete","more"),"table-light",array('23%','23%','23%','23%'));
				echo '</div>';
			break;
			
			case 'delete':
				$oBD->query("DELETE FROM compcotizacion WHERE idCotizacion=".$_POST['id']);
				$oBD->query("DELETE from ".$tabla." where id=".$_POST['id']);
				echo '<div class="container">';
				echo '<h2 class="space-items">My Quotes </h2>';
				echo $oBD->mostTabla($query,array("delete","more"),"table-light",array('23%','23%','23%','23%'));
				echo '</div">';
			 break;

			case 'newPass':
				include("../Recursos/class.phpmailer.php");
				include("../Recursos/class.smtp.php");
				$cadena="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789123456789";
				$numeC=strlen($cadena);
				$nuevPWD="";
				for ($i=0; $i<8; $i++){
					$nuevPWD.=$cadena[rand()%$numeC];
				}
				$query="UPDATE usuario SET ".
					"clave=password('".$nuevPWD."') WHERE id='".$_SESSION['id']."'";

					$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->Host="smtp.gmail.com";   //mail.google
					$mail->SMTPSecure = 'ssl';      // secure transfer enabled REQUIRED for GMail
					$mail->Port = 465;              // set the SMTP port for the GMAIL server
					$mail->SMTPDebug  = 1;          // enables SMTP debug lightrmation (for testing)
													// 1 = errors and messages
													// 2 = messages only
					$mail->SMTPAuth = true;         //enable SMTP authentication
			
					$mail->Username =   "17030830@itcelaya.edu.mx"; // SMTP account username
					$mail->Password = "jorge1399";                  // SMTP account password
			
					$mail->From="";
					$mail->FromName="";
					$mail->Subject = "Recupera tu contraseña";
					$mail->MsgHTML("<h2>Tu clave de acceso es : ".$nuevPWD."</h2>");
					$mail->AddAddress($registro->email);  //$mail->AddAddress("admin@admin.com"); para enviarlo a mas personas
					if (!$mail->Send()){ 
						echo  "Error: " . $mail->ErrorInfo;
					}
					else {
						$oBD->query($query);
						header("location: ../index.php?m=1"); 
					}
			break;
			case 'update':
				$SubQuery = 'UPDATE usuario set  ';
				foreach ($_POST as $variable => $valor) {
				  if ($variable != "action"){
					$SubQuery.= $variable.'="'.$valor.'", ';
				  }		            
				}
				$SubQuery = substr($SubQuery, 0, -2);
				$SubQuery.= ' WHERE id = "'.$_SESSION['id'].'";';
				$oBD -> query($SubQuery);
				header('location:home.php');
				break;
			   
			  default: echo 'no se ha programado '.$_POST['action'];
			  break;
			
		}
	}
	else{
		echo '<div class="container d-grid tres-col space-cell mt-7">
			<div class="centrar">
				<img src="../images/logo.png" alt="Imagen"/>
			</div>
			<div class="d-grid una-col space-cell">
				<div class="form-group">
					<label>Name</label></br>
					<label>'.$registro->nombre.'</label>
				</div>
				<div class="form-group">
					<label>Last Father</label></br>
					<label>'.$registro->apellidoP.'</label>
				</div>
				<div class="form-group">
					<label>Last Mother</label></br>
					<label>'.$registro->apellidoM.'</label>
				</div>
				<div class="form-group">
					<label>Email</label></br>
					<label>'.$registro->email.'</label>
				</div>
			</div>
			<div class="d-grid una-col space-cell">
				<form style="width: 100%;" class="btn-block my-auto btn-lg mx-auto my-auto" method="post">
					<input type="hidden" name="action" value="cotizacion">
					<input style="width: 100%;" class="btn btn-custom btn-lg btn-block text-capitalize my-auto" type="submit" value="Quotation">
				</form>
				<form style="width: 100%;" class="btn-block my-auto btn-lg mx-auto my-auto" method="post">
					<input type="hidden" name="action" value="formEdit">
					<input style="width: 100%;"  class="btn btn-custom d-sm-block btn-lg text-capitalize my-auto" type="submit" value="Edit Info">
				</form>
				<form style="width: 100%;" class="btn-block my-auto btn-lg mx-auto my-auto" method="post">
					<input type="hidden" name="action" value="newPass">
					<input style="width: 100%;"  class="btn btn-custom d-sm-block btn-lg text-capitalize my-auto" type="submit" value="Change Password">
				</form>
			</div>
		</div>';
	}
?>
		
	</body>
</html>
