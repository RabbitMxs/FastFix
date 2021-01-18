<?php
include "header.php";
include "menu.php";
include "../class/classBaseDatos.php";
$tabla="proveedor";
$query="SELECT id, concat(nombre,' ',apellidoP,' ',apellidoM ) as Names, direccion as Adress from ".$tabla;
?>
<?php

if (isset($_POST['accion'])) {
		switch ($_POST['accion']) {
			case 'delete':
				$oBD->query("DELETE from ".$tabla." where id=".$_POST['id']);

				echo '<div class="container">';
				echo '<h2 class="space-items">Provider</h2>';
				echo $oBD->mostTabla($query,array("new","edit","delete"),"table-info",array('10%','25%','55%'));
				echo '</div">';
				break;
			
			case 'formEdit':
				$resgistro=$oBD->sacaTupla("SELECT * from ".$tabla." where id=".$_POST['id']);		

		 case 'formNew':

		echo ' 
		<form method="post" class="container d-grid ancho-col una-col mx-auto space-items">
			<div>
			<legend>'.(isset($resgistro->id)?'Actualizar':'Agregar').'</legend>
				<label for="name">Name</label>
				<input
					type="text"
					class="form-control"
					id="name"
					name="nombre"
					value="'.(isset($resgistro->id)?$resgistro->nombre:' ').'"
				/>
			</div>
			<div>
				<label for="lastN1">Last Name</label>
				<input
					type="text"
					class="form-control"
					id="lastN1"
					name="apellidoP"
					value="'.(isset($resgistro->id)?$resgistro->apellidoP:' ').'"
				/>
			</div>
			<div>
				<label for="lastN2">Last Name</label>
				<input
					type="text"
					class="form-control"
					id="lastN2"
					name="apellidoM"
					value="'.(isset($resgistro->id)?$resgistro->apellidoM:' ').'"
				/>
			</div>
			<div>
				<label for="adress">Adress</label>
				<input
					type="text"
					class="form-control"
					id="adress"
					name="direccion"
					value="'.(isset($resgistro->id)?$resgistro->direccion:' ').'"
				/>
				<input 
					type="hidden" 
					name="accion" 
					value="'.(isset($resgistro->id)?'update':'insert').'">';
			
			if (isset($resgistro->id)) {
				echo '<input type="hidden" name="id" value="'.$resgistro->id.'"/> ';
			}
			
		echo  '</div>
			<button type="submit" class="btn btn-custom space-items d-sm-block">Submit</button>
		</form>';			
		 
			 break;

			 case 'insert':
				 $Subquery="INSERT into ".$tabla." set ";
				 foreach ($_POST as $variable => $valor) 
					 if ($variable!="accion")
					 $Subquery .=$variable."= '".$valor."' , ";
				 $subQuery=substr($Subquery,0,-2).";";
				 $oBD->query($subQuery);
				 echo '<div class="container">';
				echo '<h2 class="space-items">Provider</h2>';
				echo $oBD->mostTabla($query,array("new","edit","delete"),"table-info",array('10%','25%','55%'));
				echo '</div">';
				 break;

			 case 'update':
			   $SubQuery = 'UPDATE '.$tabla.' set  ';
			   foreach ($_POST as $variable => $valor) {
				 if ($variable != "accion"){
				   $SubQuery.= $variable.'="'.$valor.'", ';
				 }		            
			   }
			   $SubQuery = substr($SubQuery, 0, -2);
			   $SubQuery.= ' WHERE id = "'.$_POST['id'].'";';
			   $oBD -> query($SubQuery);
			   //var_dump($query);
			   echo '<div class="container">';
				echo '<h2 class="space-items">Provider</h2>';
				echo $oBD->mostTabla($query,array("new","edit","delete"),"table-info",array('10%','25%','55%'));
				echo '</div">';
			   break;
			  
			 default: echo 'no se ha programado '.$_POST['accion'];
			 break;
		}

}else{
	echo '<div class="container">';
	echo '<h2 class="space-items">Provider</h2>';
	echo $oBD->mostTabla($query,array("new","edit","delete"),"table-info",array('10%','25%','55%'));
	echo '</div">';
}

?>

</body>
</html>
