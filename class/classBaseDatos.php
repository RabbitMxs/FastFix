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
		if(strpos(strtoupper($query),"SELECT")!==false){//0==falso !=0 verdadero
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
}
$oBD = new baseDatos();
?>