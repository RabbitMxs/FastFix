<?php
include "header.php";
include "menu.php";
include "../class/classBaseDatos.php";
$tabla="componente";
$query="SELECT C.id, C.nombre as Component,
               C.caracteristicas as Characteristics,
               C.costo as Cost, 
               concat(P.nombre,' ',P.apellidoP,' ',P.apellidoM ) as Providers,
               TC.nombre as ComponentType from ".$tabla." C join proveedor P on C.idProveedor=P.id
															join tipoComponente TC on TC.id=C.idTipoComponente";
?>

<?php

   if (isset($_POST['accion'])) {
	   	switch ($_POST['accion']) {
	   		case 'delete':
	   			$oBD->query("DELETE from ".$tabla." where id=".$_POST['id']);

				echo $oBD->mostTabla($query,array("new","edit","delete"),"table-info",array('5%','15%','27%','10%','18%','15%'));
	   			break;
	   		
	   		case 'formEdit':
				   $resgistro=$oBD->sacaTupla("SELECT * from ".$tabla." where id=".$_POST['id']);		

	    	case 'formNew':

			echo '   
			   <form method="post" class="container d-grid tres-col space-cell mx-auto space-items">
					<div class="form-group">
						<label class="col-form-label" for="component">Component</label>
						<input
							type="text"
							class="form-control"
							id="componente"
							name="nombre"
							value="'.(isset($resgistro->id)?$resgistro->nombre:' ').'"
						/>
					</div>
					<div class="form-group">
						<label class="col-form-label text-capitalize" for="cost">Cost</label>
						<input
							type="text"
							class="form-control"
							id="cost"
							name="costo"
							value="'.(isset($resgistro->id)?$resgistro->costo:' ').'"
						/>
					</div>
					<div class="form-group">
						<label for="provider">Provider</label>';
					echo $oBD->consListBox("proveedor","id","concat(nombre,' ',apellidoP,' ',apellidoM )","idProveedor",isset($resgistro->id)?$resgistro->idProveedor:0);
						
		   echo    '</div>
					<div class="form-group">
						<label for="typeC">Component Type</label>';
					echo $oBD->consListBox("tipoComponente","id","nombre","idTipoComponente",isset($resgistro->id)?$resgistro->idTipoComponente:0);

			echo   '</div>
					<div>
						<input 
							type="hidden" 
							name="accion" 
							value="'.(isset($resgistro->id)?'update':'insert').'">';

					if (isset($resgistro->id)) {
						echo '<input type="hidden" name="id" value="'.$resgistro->id.'"/> ';
					}

				echo'</div>
					<div class="form-group unir-renglon">
						<label class="col-form-label text-capitalize" for="caracterist">Charasteritics</label>
						<textarea 
						class="form-control"
						id="caracterist"
						name="caracteristicas"
						rows="4" cols="50">'
						.(isset($resgistro->id)?$resgistro->caracteristicas:' ').
						'</textarea>
					</div>
					<div class="button-submit unir-celdas mx-auto">
						<button type="submit" class="btn btn-custom btn-submit">
							Submit
						</button>
					</div>
					<div>
					
	            </form>';			
			
			    break;

			case 'insert':
				$Subquery="INSERT into ".$tabla." set ";
				foreach ($_POST as $variable => $valor) 
					if ($variable!="accion")
					$Subquery .=$variable."= '".$valor."' , ";
				$subQuery=substr($Subquery,0,-2).";";
				$oBD->query($subQuery);
				echo $oBD->mostTabla($query,array("new","edit","delete"),"table-info",array('5%','15%','27%','10%','18%','15%'));
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
				echo $oBD->mostTabla($query,array("new","edit","delete"),"table-info",array('5%','15%','27%','10%','18%','15%'));
				break;
				
			default: echo 'no se ha programado '.$_POST['accion'];
			break;
	   	}

   }else{

   echo $oBD->mostTabla($query,array("new","edit","delete"),"table-info",array('5%','15%','27%','10%','18%','15%'));
  }

?>

</body>
</html>