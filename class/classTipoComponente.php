<?php
include "classBaseDatos.php";
class classTipoComponente extends BaseDatos{
    var $tabla="tipocomponente";
    var $query="SELECT id , nombre as Component_type from tipocomponente";

    function accion($pAction){
        switch ($pAction) {
            case 'list':
                echo $this->listado($this->query,array("new","edit","delete"),"table-light",array('30%','50%'));
            break;
            case 'delete':
                $this->query("DELETE from ".$this->tabla." where id=".$_REQUEST['id']);

             echo '<div class="container">';
             echo '<h2 class="space-items">Component Type</h2>';
             echo $this->Listado($this->query,array("new","edit","delete"),"table-light",array('30%','50%'));
             echo '</div>';
                break;
            
            case 'formEdit':
                $resgistro=$this->sacaTupla("SELECT * from ".$this->tabla." where id=".$_REQUEST['id']);		

         case 'formNew':

            echo '<!DOCTYPE html>
            <html lang="en">
                <head>
                    <title>Fast Fix</title>
                    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
                    <link rel="stylesheet" type="text/css" href="css/custom.css" />
                </head>
                <body>
                    <form id="formDatos" method="post" class="container d-grid ancho-col una-col mx-auto space-items">
                        <div>
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
                                name="action" 
                                value="'.(isset($resgistro->id)?'update':'insert').'"/>';

                             if (isset($resgistro->id)) {
                                 echo '<input type="hidden" name="id" value="'.$resgistro->id.'"/> ';
                             }
                             
                       echo' </div>
                    </form>
                </body>
            </html>';			
         
             break;

             case 'insert':
                 $Subquery="INSERT into ".$this->tabla." set ";
                 foreach ($_POST as $variable => $valor) 
                     if ($variable!="action")
                     $Subquery .=$variable."= '".$valor."' , ";
                 $subQuery=substr($Subquery,0,-2).";";
                 $this->query($subQuery);
                 //var_dump($this->query);
                 echo '<div class="container">';
                 echo '<h2 class="space-items">Component Type</h2>';
                 echo $this->Listado($this->query,array("new","edit","delete"),"table-light",array('30%','50%'));
                 echo '</div>';
                 break;

             case 'update':
               $SubQuery = 'UPDATE '.$this->tabla.' set  ';
               foreach ($_POST as $variable => $valor) {
                 if ($variable != "action"){
                   $SubQuery.= $variable.'="'.$valor.'", ';
                 }		            
               }
               $SubQuery = substr($SubQuery, 0, -2);
               $SubQuery.= ' WHERE id = "'.$_REQUEST['id'].'";';
               $this -> query($SubQuery);
               //var_dump($this->query);
               echo '<div class="container">';
             echo '<h2 class="space-items">Component Type</h2>';
             echo $this->Listado($this->query,array("new","edit","delete"),"table-light",array('30%','50%'));
             echo '</div>';
               break;
              
             default: echo 'no se ha programado '.$_REQUEST['accion'];
             break;
		}
    }

    function listado($query, $iconos=array() , $estilo="table-light",$ancho=array()){
        $registros=$this->query($query);
        $result='<table border="1" class="table '.$estilo.'">';
        $cols=mysqli_num_fields($registros);
        //cabecera
        $result.= '<tr class="table table-dark">';
        if (in_array("new",$iconos)) {
			$result.= '<td colspan="'.(count($iconos)-1).'">
                        <img width="32px" src="../images/add.svg" onclick="tipoComponente(\'formNew\')">
                    </td>';
		}else{
			if(!empty($iconos)){
				$result.= '<td colspan="'.count($iconos).'">
				</td>';
			}
		}
        

        for ($c=0; $c < $cols; $c++) {
            $campo=mysqli_fetch_field_direct($registros,$c); 
            $result.= '<td>'.$campo->name.'</td>';
        }
        $result.= "</tr>";
        for ($r=0; $r < $this->numeTuplas; $r++) { 
            $result.= '<tr>';
            $registro=mysqli_fetch_array($registros);
            if(in_array("edit",$iconos)){
                $result.= '<td width="3%">
                    <img width="32px" src="../images/edit.svg" onclick="tipoComponente(\'formEdit\', '.$registro['id'].')">
                </td>'; 
            }
            if(in_array("delete",$iconos)){
                $result.= '<td width="3%">
                <img width="32px" src="../images/delete.svg" onclick="tipoComponente(\'delete\', '.$registro['id'].')">
                </td>'; 
            }
            for ($c=0; $c<$cols; $c++){
				$result.= '<td  style="width:'.$ancho[$c].';">'.$registro[$c].'</td>';
			}
            
            $result.= '</tr>';
        }
        $result.= '</table>';
        return $result;
    }
}
if(isset($_REQUEST['action'])){
    $objeto = new classTipoComponente();
    $objeto -> accion($_REQUEST['action']);
}
?>