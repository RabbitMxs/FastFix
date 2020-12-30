<?php
class baseDatos{
    var $conexion;
    var $bloque;
    var $numeTuplas;
	var $clave;
    var $error;
    var $server = "localhost";
    var $user = "userTest";
    var $pass = "1234";
    var $bd = "fastfix";

    function baseDatos(){
    }
    
    function conecta(){
		$this->conexion=mysqli_connect($this->server,$this->user,$this->pass,$this->bd);
	}

    function cierraBD(){
		mysqli_close($this->conexion);
    }
    
    function query($query){
		$this->conecta();
		$this->bloque=mysqli_query($this->conexion,$query);
		$error=mysqli_error($this->conexion);
		if($error>""){
			echo $query." => ".$error;
			exit;
		}
		$this->cierraBD();

		if(strpos(strtoupper($query), "SELECT")!==false){//0==falso !=0 verdadero
			$this->numeTuplas=mysqli_num_rows($this->bloque);
		}else{
			$this->numeTuplas=0;
		}
		return $this->bloque;
    }
    
    function sacaTupla($query){
		$this->query($query);
		$this->numeTuplas=mysqli_num_rows($this->bloque);
		return mysqli_fetch_object($this->bloque);

	}

	function mostTabla($query,$iconos=array(),$estilo="table-danger",$ancho=array()){ 
		global $oBD;
		$registros=$this->query($query);
		$result ='<table border="2" class="table '.$estilo.' container space-items">';
		$cols=mysqli_num_fields($registros);
	   
	 //cabecera inicio
		$result.= '<tr class="table-secondary">';
		//agrega los espacios en la cabecera para los iconos
		//foreach ($iconos as $value) 	     
		  $result.= '<td colspan="'.count($iconos).'">
			  <form method="post">
				<input type="hidden" name="accion" value="formNew">
				<input type="image" width="32px" src= "../images/add.svg">
			  </form>
		  </td>';
	 
		for ($c=0; $c <$cols ; $c++) { 
		   $campo=mysqli_fetch_field_direct($registros,$c);
		   $result.= '<td>'.$campo->name.'</td>';
		}
		$result.= "</tr>";
	 //cabecera fin 
 
		 for ($r=0; $r<$this->numeTuplas; $r++)
		  { $result.= '<tr>';
	   //agrega columnas para inconos
		   $registro=mysqli_fetch_array($registros);
		   if (in_array("edit",$iconos)) {
			 $result.='<td width="5%">
			 <form method="post">
				<input type="hidden" name="accion" value="formEdit">
				<input type="hidden" name="id" value="'.$registro['id'].'">
				<input type="image" width="32px" src= "../images/edit.svg">
				</form>
 
			 
			 </td>';
		   }
		   if (in_array("delete",$iconos)) {
			 $result.= '<td width="5%">
				<form method="post">
				<input type="hidden" name="accion" value="delete">
				<input type="hidden" name="id" value="'.$registro['id'].'">
				<input type="image" width="30px" src= "../images/delete.svg">
				</form>
			 </td>';
		   }
			for ($c=0; $c<$cols; $c++)
			  $result.= '<td  style="width:'.$ancho[$c].';">'.$registro[$c].'</td>';
			$result.= '</tr>';
		  }
		 $result.= '</table>';
		 return $result;
	 }  
 
	 public function consListBox($tabla,$PK,$nombreCampoDesplegar,$nameCampoForm,$idRegistroSeleccionado=0){
	 $result ='<select class="form-control" name="'.$nameCampoForm.'">';
	 $result.='<option value="0" >Selecciona</option>';
	 $registros=$this->query("SELECT " .$PK. " as PK, ".$nombreCampoDesplegar." as despliega from ".$tabla." order by ".$nombreCampoDesplegar);
	 foreach ($registros as $registro) {
		 $result.='<option value="'.$registro['PK'].'" 
		 '.(($registro['PK']==$idRegistroSeleccionado)?"selected":""). ' >'.$registro['despliega'].'</option>';
	 }
 
	 $result.='</select>';
	 return $result;
	 }
}
$oBD = new baseDatos();
?>