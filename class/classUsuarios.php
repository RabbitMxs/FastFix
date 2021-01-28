<?php
include "classBaseDatos.php";
class classUsuarios extends BaseDatos{
    var $tabla="usuario";
    var $query="SELECT id, concat(nombre,' ',apellidoP,' ',apellidoM ) as Names, email  from usuario where idTipoUsuario=1";

    function accion($pAction){
        switch ($pAction) {
            case 'list':
                echo $this->listado($this->query,array("new","edit","delete"),"table-light",array('10%','25%','55%'));
            break;
            case 'delete':
				$this->query("DELETE from ".$this->tabla." where id=".$_REQUEST['id']);

				echo '<div class="container">';
				echo '<h2 class="space-items">Provider</h2>';
				echo $this->listado($this->query,array("new","edit","delete"),"table-light",array('10%','25%','55%'));
				echo '</div">';
				break;
			
			case 'formEdit':
				$resgistro=$this->sacaTupla("SELECT * from ".$this->tabla." where id=".$_REQUEST['id']);		

		 case 'formNew':

		echo ' 
		<form id="formDatos" method="post" class="container d-grid ancho-col una-col mx-auto space-items">
            <div>
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
				<label for="adress">Email</label>
				<input
					type="text"
					class="form-control"
					id="adress"
					name="email"
					value="'.(isset($resgistro->id)?$resgistro->email:' ').'"
				/>';

				if(!isset($resgistro->id)){
					echo' <div>
					<label for="password">Password</label>
					<input
						type="text"
						class="form-control"
						id="password"
						name="clave"
					/>
				</div>';
				}
		   
			echo'<input 
					type="hidden" 
					name="action" 
					value="'.(isset($resgistro->id)?'update':'insert').'">';
			
			if (isset($resgistro->id)) {
				echo '<input type="hidden" name="id" value="'.$resgistro->id.'"/> ';
			}
			
        echo  '</div>
        </form>';			
		 
			 break;

			 case 'insert':
				 $Subquery="INSERT into ".$this->tabla." set IdTipoUsuario='1', clave=password('".$_POST['clave']."'),";
				 foreach ($_POST as $variable => $valor) 
					 if ($variable!="action" && $variable!="clave")
					 $Subquery .=$variable."= '".$valor."' , ";
				 $subQuery=substr($Subquery,0,-2).";";
				 $this->query($subQuery);
				 echo '<div class="container">';
				echo '<h2 class="space-items">Provider</h2>';
				echo $this->listado($this->query,array("new","edit","delete"),"table-light",array('10%','25%','55%'));
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
			   //var_dump($this->query);
			   echo '<div class="container">';
				echo '<h2 class="space-items">Provider</h2>';
				echo $this->listado($this->query,array("new","edit","delete"),"table-light",array('10%','25%','55%'));
				echo '</div">';
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
                        <img width="32px" src="../images/add.svg" onclick="usuarios(\'formNew\')">
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
                    <img width="32px" src="../images/edit.svg" onclick="usuarios(\'formEdit\', '.$registro['id'].')">
                </td>'; 
            }
            if(in_array("delete",$iconos)){
                $result.= '<td width="3%">
                <img width="32px" src="../images/delete.svg" onclick="usuarios(\'delete\', '.$registro['id'].')">
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
    $objeto = new classUsuarios();
    $objeto -> accion($_REQUEST['action']);
}
?>