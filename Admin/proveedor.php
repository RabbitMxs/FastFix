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

			    echo $oBD->mostTabla($query,array("edit","delete"),"table-info",array('10%','25%','55%'));
	   			break;
	   		
	   		case 'formEdit':
	   			$resgistro=$oBD->sacaTupla("SELECT * from ".$tabla." where id=".$_POST['id']);	   		

	    	case 'formNew':

	   		echo '	<div class="container">	
					<form method="post" >
					<input type="hidden" name="accion" 
					value="'.(isset($resgistro->id)?'update':'insert').'"> 
					<span style="margin-left: 15%; " class="badge badge-light" style="width: 30%">
						<h2>'.(isset($resgistro->id)?'Actualizar':'Agregar').'</h2></span>
						<br>
						<div class="row" style="padding-left: 2%; ">
							<div class="col-xs-4">
							<label class="col-form-label" for="inputDefault" >Local:</label>';
                     //tabla,llave primaria taabla,nombre del cambo de la tabla a desplegar,nombre del campo del formularios que se construye
							echo $oBD->consListBox("usuario","id","concat(apellidos,' ',nombre)","idLocal",isset($resgistro->id)?$resgistro->idLocal:0);
							
						echo '</div>

						</div>
						<div class="row" style="padding-left: 2%; ">
						<div class="form-group">
							<label class="col-form-label" for="inputDefault">Visitante:</label>';

					        echo $oBD->consListBox("usuario","id","concat(apellidos,' ',nombre)","idVisitante",isset($resgistro->id)?$resgistro->idVisitante:0);
					    echo '</div>
					    </div>	

					    <div class="form-group">
							<label class="col-form-label" for="inputDefault">Puntos:</label>
							<input style="width: 53%;" type="text" class="form-control" name="puntos" value="'.(isset($resgistro->id)?$resgistro->puntos:' ').' "/>
						</div>
						<div class="form-group">
							<label class="col-form-label" for="inputDefault">Fecha:</label>
							<input style="width: 53%;" type="text" class="form-control" name="fecha" value="'.(isset($resgistro->id)?$resgistro->fecha:' ').' "/>
						</div>
						<div class="form-group">
							<label class="col-form-label" for="inputDefault">Partida:</label>
							<input style="width: 53%;" type="text" class="form-control" name="partida" value="'.(isset($resgistro->id)?$resgistro->partida:' ').' "/>
						</div>

						<div class="form-group">
							<label class="col-form-label" for="inputDefault">Ganador</label>';

					        echo $oBD->consListBox("usuario","id","concat(apellidos,' ',nombre)","idGanador",isset($resgistro->id)?$resgistro->idGanador:0);
					    echo '
						</div>
						<div class="row" style="padding-left: 2%; ">
							<div class="col-xs-4">
							<label class="col-form-label" for="inputDefault" >Estatus:</label>';
                     //tabla,llave primaria taabla,nombre del cambo de la tabla a desplegar,nombre del campo del formularios que se construye
							echo $oBD->consListBox("EstatusJuego","Id","Estatus","idEstatus",isset($resgistro->id)?$resgistro->idEstatus:0);
				
						if (isset($resgistro->id)) {
							echo '<input type="hidden" name="id" value="'.$resgistro->id.'" ';
						}

						echo '<br>
						<fieldset class="form-group">
						    <button style="width: 100%; text-align: center;" type="submit" class="btn btn-info">'.(isset($resgistro->id)?'ACTUALIZAR':'AGREGAR').'</button>
						</fieldset>
					</form>
					</div>';			
			
			    break;

			    case 'insert':
			    	$Subquery="INSERT into ".$tabla." set ";
			    	foreach ($_POST as $variable => $valor) 
			    		if ($variable!="accion")
			    		$Subquery .=$variable."= '".$valor."' , ";
			    	$subQuery=substr($Subquery,0,-2).";";
			    	$oBD->query($subQuery);
					echo $oBD->mostTabla($query,array("edit","delete"),"table-info",array('10%','25%','55%'));
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
		          $oBD ->query($SubQuery);
				  echo $oBD->mostTabla($query,array("edit","delete"),"table-info",array('10%','25%','55%'));
		          break;
		         
			    default: echo 'no se ha programado '.$_POST['accion'];
			    break;
	   	}

   }else{

   echo $oBD->mostTabla($query,array("edit","delete"),"table-info",array('10%','25%','55%'));
  }

?>

</body>
</html>
