<?php
    include "header.php";
    include "menu.php";
    include "../class/classBaseDatos.php";
    if(isset($_POST['action'])){
		switch ($_POST['action']){
            case 'mobo':
                $array=array($_POST['id']);
                var_dump($array);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                C.costo as Cost 
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=2";
                echo $oBD->mostProduct($query,"table-info",array('5%','15%','15%','50%','10%'),"ram",'<input type="hidden" name="componentes" value='.serialize($array).'>');
            break;
            case 'ram':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                C.costo as Cost 
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=8";
                echo $oBD->mostProduct($query,"table-info",array('5%','15%','15%','50%','10%'),"video",'<input type="hidden" name="componentes" value='.serialize($array).'>');
            break;
            case 'video':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                var_dump($array);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                C.costo as Cost 
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=3";
                echo $oBD->mostProduct($query,"table-info",array('5%','15%','15%','50%','10%'),"enfriamiento",'<input type="hidden" name="componentes" value='.serialize($array).'>');
            break;
            case 'enfriamiento':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                var_dump($array);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                C.costo as Cost 
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=6";
                echo $oBD->mostProduct($query,"table-info",array('5%','15%','15%','50%','10%'),"HDD",'<input type="hidden" name="componentes" value='.serialize($array).'>');
            break;

            case 'HDD':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                var_dump($array);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                C.costo as Cost 
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=7";
                echo $oBD->mostProduct($query,"table-info",array('5%','15%','15%','50%','10%'),"fuente",'<input type="hidden" name="componentes" value='.serialize($array).'>');
            break;

            case 'fuente':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                var_dump($array);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                C.costo as Cost 
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=5";
                echo $oBD->mostProduct($query,"table-info",array('5%','15%','15%','50%','10%'),"gabinete",'<input type="hidden" name="componentes" value='.serialize($array).'>');
            break;
            case 'gabinete':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                var_dump($array);
                $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                C.costo as Cost 
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=4";
                echo $oBD->mostProduct($query,"table-info",array('5%','15%','15%','50%','10%'),"registro",'<input type="hidden" name="componentes" value='.serialize($array).'>');
            break;
            case 'registro':
                $array=unserialize($_POST['componentes']);
                array_push($array,$_POST['id']);
                var_dump($array);
            break;
        }
    }
    else{
        $query="SELECT C.id, C.nombre as Component,
                TC.nombre as ComponentType,
                C.caracteristicas as Characteristics,
                C.costo as Cost 
                from componente C 
                join tipoComponente TC on TC.id=C.idTipoComponente
                where tipo='V' AND idTipoComponente=1";
        echo $oBD->mostProduct($query,"table-info",array('5%','15%','15%','50%','10%'),"mobo");
    }
?>