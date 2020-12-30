<?php
include "header.php";
include "menu.php";
include "../class/classBaseDatos.php";
$tabla="tipocomponente";
$query="SELECT id , nombre as Component_type from ".$tabla;
?>

<?php

   if (isset($_POST['accion'])) {
	   	switch ($_POST['accion']) {
	   		case 'delete':
	   			$oBD->query("DELETE from ".$tabla." where id=".$_POST['id']);

			    echo $oBD->mostTabla($query,array("edit","delete"),"table-info",array('30%','50%'));
	   			break;
	   		
	   		case 'formEdit':
				   $resgistro=$oBD->sacaTupla("SELECT * from ".$tabla." where id=".$_POST['id']);		

	    	case 'formNew':

	   		echo '<!DOCTYPE html>
			   <html lang="en">
				   <head>
					   <title>Fast Fix</title>
					   <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
					   <link rel="stylesheet" type="text/css" href="css/custom.css" />
				   </head>
				   <body>
					   <form method="post" class="container d-grid ancho-col una-col mx-auto space-items">
						   <div>
							   <legend>'.(isset($resgistro->id)?'Actualizar':'Agregar').'</legend>
							   <label for="type">Component Type</label>
							   <input
								   type="text"
								   class="form-control"
								   id="type"
								   name="nombre"
								   value="'.(isset($resgistro->id)?$resgistro->nombre:' ').'"
							   />
							   <input 
								   type="hidden" 
								   name="accion" 
								   value="'.(isset($resgistro->id)?'update':'insert').'"/>';

							    if (isset($resgistro->id)) {
									echo '<input type="hidden" name="id" value="'.$resgistro->id.'"/> ';
								}
								
						  echo' </div>
						   <button type="submit" class="btn btn-custom space-items d-sm-block">Submit</button>
					   </form>
				   </body>
			   </html>';			
			
			    break;

			    case 'insert':
			    	$Subquery="INSERT into ".$tabla." set ";
			    	foreach ($_POST as $variable => $valor) 
			    		if ($variable!="accion")
			    		$Subquery .=$variable."= '".$valor."' , ";
			    	$subQuery=substr($Subquery,0,-2).";";
					$oBD->query($subQuery);
					//var_dump($query);
					echo $oBD->mostTabla($query,array("edit","delete"),"table-info",array('30%','50%'));
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
				  echo $oBD->mostTabla($query,array("edit","delete"),"table-info",array('30%','50%'));
		          break;
		         
			    default: echo 'no se ha programado '.$_POST['accion'];
			    break;
	   	}

   }else{

   echo $oBD->mostTabla($query,array("edit","delete"),"table-info",array('30%','50%'));
  }

?>

</body>
</html>
