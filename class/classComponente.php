<?php
include "classBaseDatos.php";
class classComponente extends BaseDatos{
    var $tabla="componente";
     var $query="SELECT C.id, C.nombre as Component,
               C.caracteristicas as Characteristics,
               C.costo as Cost, 
               concat(P.nombre,' ',P.apellidoP,' ',P.apellidoM ) as Providers,
               TC.nombre as ComponentType from componente C join proveedor P on C.idProveedor=P.id
															join tipoComponente TC on TC.id=C.idTipoComponente";
    
    function accion($pAction){
        switch ($pAction) {
            case 'list':
                echo $this->listado($this->query,array("new","edit","delete"),"table-info",array('5%','15%','27%','10%','18%','15%'));
            break;
            case 'delete':
                $this->query("DELETE from ".$this->tabla." where id=".$_REQUEST['id']);

             echo '<div class="container">';
             echo '<h2 class="space-items">Components</h2>';
             echo $this->Listado($this->query,array("new","edit","delete"),"table-info",array('5%','15%','27%','10%','18%','15%'));
             echo '</div">';
             break;
            
            case 'formEdit':
                $resgistro=$this->sacaTupla("SELECT * from ".$this->tabla." where id=".$_REQUEST['id']);		

            case 'formNew':

            echo '   
                <form id="formDatos" method="post" class="container d-grid tres-col space-cell mx-auto space-items">
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
            echo $this->consListBox("proveedor","id","concat(nombre,' ',apellidoP,' ',apellidoM )","idProveedor",isset($resgistro->id)?$resgistro->idProveedor:0);
                     
            echo    '</div>
                 <div class="form-group">
                     <label for="typeC">Component Type</label>';
            echo $this->consListBox("tipoComponente","id","nombre","idTipoComponente",isset($resgistro->id)?$resgistro->idTipoComponente:0);

            echo   '</div>
                 <div>
                     <input 
                         type="hidden" 
                         name="action" 
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
                 
             </form>';			
         
             break;

         case 'insert':
             $Subquery="INSERT into ".$this->tabla." set ";
             foreach ($_POST as $variable => $valor) 
                 if ($variable!="action")
                 $Subquery .=$variable."= '".$valor."' , ";
             $subQuery=substr($Subquery,0,-2).";";
             $this->query($subQuery);
             echo '<div class="container">';
             echo '<h2 class="space-items">Components</h2>';
             echo $this->Listado($this->query,array("new","edit","delete"),"table-info",array('5%','15%','27%','10%','18%','15%'));
             echo '</div">';
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
             echo '<div class="container">';
             echo '<h2 class="space-items">Components</h2>';
             echo $this->Listado($this->query,array("new","edit","delete"),"table-info",array('5%','15%','27%','10%','18%','15%'));
             echo '</div">';
             break;
             
         default: echo 'no se ha programado '.$_REQUEST['action'];
         break;
        }
    }

    function listado($query, $iconos=array() , $estilo="table-info",$ancho=array()){
        $registros=$this->query($query);
        $result='<table border="1" class="table '.$estilo.'">';
        $cols=mysqli_num_fields($registros);
        //cabecera
        $result.= '<tr class="table table-warning">';
        if (in_array("new",$iconos)) {
			$result.= '<td colspan="'.(count($iconos)-1).'">
                        <img width="32px" src="../images/add.svg" onclick="componente(\'formNew\')">
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
                    <img width="32px" src="../images/edit.svg" onclick="componente(\'formEdit\', '.$registro['id'].')">
                </td>'; 
            }
            if(in_array("delete",$iconos)){
                $result.= '<td width="3%">
                <img width="32px" src="../images/delete.svg" onclick="componente(\'delete\', '.$registro['id'].')">
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
    $objeto = new classComponente();
    $objeto -> accion($_REQUEST['action']);
}
?>