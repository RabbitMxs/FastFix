<?php
    include "header.php";
    include "menu.php";
    include "../class/classBaseDatos.php";
    if(isset($_POST['action'])){
		switch ($_POST['action']){
            case 'mobo':
                $array=array($_POST['id']);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                CONCAT('$',C.costo) as Cost  
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=2";
                echo '<div class="container">';
				echo '<h2 class="space-items">Motherboard </h2>';
                echo $oBD->mostProduct($query,"table-light",array('5%','15%','15%','50%','10%'),"ram",'<input type="hidden" name="componentes" value='.serialize($array).'>');
                echo '</div">';
            break;
            case 'ram':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                CONCAT('$',C.costo) as Cost  
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=8";
                echo '<div class="container">';
				echo '<h2 class="space-items">RAM </h2>';
                echo $oBD->mostProduct($query,"table-light",array('5%','15%','15%','50%','10%'),"video",'<input type="hidden" name="componentes" value='.serialize($array).'>');
                echo '</div">';
            break;
            case 'video':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                CONCAT('$',C.costo) as Cost  
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=3";
                echo '<div class="container">';
				echo '<h2 class="space-items">GPU </h2>';
                echo $oBD->mostProduct($query,"table-light",array('5%','15%','15%','50%','10%'),"enfriamiento",'<input type="hidden" name="componentes" value='.serialize($array).'>');
                echo '</div">';
            break;
            case 'enfriamiento':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                CONCAT('$',C.costo) as Cost  
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=6";
                echo '<div class="container">';
				echo '<h2 class="space-items">Coolers </h2>';
                echo $oBD->mostProduct($query,"table-light",array('5%','15%','15%','50%','10%'),"HDD",'<input type="hidden" name="componentes" value='.serialize($array).'>');
                echo '</div">';
            break;

            case 'HDD':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                CONCAT('$',C.costo) as Cost  
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=7";
                echo '<div class="container">';
				echo '<h2 class="space-items">Hard Disk </h2>';
                echo $oBD->mostProduct($query,"table-light",array('5%','15%','15%','50%','10%'),"fuente",'<input type="hidden" name="componentes" value='.serialize($array).'>');
                echo '</div">';
            break;

            case 'fuente':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                CONCAT('$',C.costo) as Cost  
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=5";
                echo '<div class="container">';
				echo '<h2 class="space-items">Power Supply </h2>';
                echo $oBD->mostProduct($query,"table-light",array('5%','15%','15%','50%','10%'),"gabinete",'<input type="hidden" name="componentes" value='.serialize($array).'>');
                echo '</div">';
            break;
            case 'gabinete':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                CONCAT('$',C.costo) as Cost  
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=4";
                echo '<div class="container">';
				echo '<h2 class="space-items">Case</h2>';
                echo $oBD->mostProduct($query,"table-light",array('5%','15%','15%','50%','10%'),"registro",'<input type="hidden" name="componentes" value='.serialize($array).'>');
                echo '</div">';
            break;
            case 'registro':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                $query="SELECT nombre, caracteristicas, CONCAT('$',costo) as Cost FROM componente WHERE id = ".$array[0].
                " OR id = ".$array[1].
                " OR id = ".$array[2].
                " OR id = ".$array[3].
                " OR id = ".$array[4].
                " OR id = ".$array[5].
                " OR id = ".$array[6].
                " OR id = ".$array[7];
                echo '<div class="container">';
				echo '<h2 class="space-items">Purchase Quote</h2>';
                echo $oBD->mostTabla($query,array(),"table-light",array('25%','65%','10%'));
                
                //insert_bd
                $query="INSERT INTO cotizacion set  fecha=CURRENT_DATE, idUsuario='".$_SESSION['id']."', idTipoCotizacion='2'";
                $oBD->query($query);
                $idCot=$oBD->lastid;
                foreach ($array as $variable => $valor){
                        $query="INSERT INTO compcotizacion set idCotizacion='".$idCot."', idComponente='".$valor."'";
                        $oBD->query($query);
                }
                $query= "SELECT sum(c.costo) as total from compcotizacion cm
                    INNER JOIN componente c on c.id=cm.idComponente
                    where cm.idCotizacion=".$idCot;
                $registro=$oBD->sacaTupla($query);
                $query="UPDATE cotizacion set  total=".$registro->total." where id=".$idCot;
                $oBD->query($query);

                echo '<div style="display: flex;justify-content: end;font-size: x-large;">
                    <label>Total: $'.$registro->total.'</label>
                </div>';
                echo '</div>';
            break;
        }
    }
    else{
        $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                CONCAT('$',C.costo) as Cost 
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=1";
        echo '<div class="container">';
        echo '<h2 class="space-items">Processor</h2>';
        echo $oBD->mostProduct($query,"table-light",array('5%','15%','15%','50%','10%'),"mobo");
        echo '</div>';
    }
?>