<?php
    include "header.php";
    include "menu.php";
    include "../class/classBaseDatos.php";
    if(isset($_POST['action'])){
		switch ($_POST['action']){
            case "create":
                $query="INSERT INTO cotizacion set  fecha=CURRENT_DATE, idUsuario='".$_SESSION['id']."', idTipoCotizacion='1'";
                $oBD->query($query);
                $idCot=$oBD->lastid;
                foreach ($_POST as $variable => $valor){
                    if ($variable!="action"){
                        $query="INSERT INTO compcotizacion set idCotizacion='".$idCot."', idComponente='".$valor."'";
                        $oBD->query($query);
                    }
                }
                $query= "SELECT sum(c.costo) as total from compcotizacion cm
                    INNER JOIN componente c on c.id=cm.idComponente
                    where cm.idCotizacion=".$idCot;
                $resgistro=$oBD->sacaTupla($query);
                $query="UPDATE cotizacion set  total=".$resgistro->total." where id=".$idCot;
                $oBD->query($query);

                $resgistro=$oBD->sacaTupla("SELECT total from cotizacion where id=".$idCot);	
                echo '<form method="post" class="container d-grid dos-col space-cell mt-7">
            <div class="container d-grid una-col space-cell">
                <div>
                <label>CPU</label>';
                echo $oBD->consList("componente","id","CONCAT(nombre,' - $',costo)","procesador",1,isset($_POST['procesador'])?$_POST['procesador']:0);
            echo '</div>
                <div>
                <label>RAM</label>';
                echo $oBD->consList("componente","id","CONCAT(nombre,' - $',costo)","ram",8,isset($_POST['ram'])?$_POST['ram']:0);
            echo '</div>
                <div>
                <label>HDD</label>';
                echo $oBD->consList("componente","id","CONCAT(nombre,' - $',costo)","hdd",10,isset($_POST['hdd'])?$_POST['hdd']:0);
            echo '</div>
                <div>
                <label>GPU</label>';
                echo $oBD->consList("componente","id","CONCAT(nombre,' - $',costo)","gpu",3,isset($_POST['gpu'])?$_POST['gpu']:0);
            echo '</div>
                </div>
                <div class="my-auto">
                <input 
                    type="hidden" 
                    name="action" 
                    value="create">
                <button type="submit" class="btn btn-custom d-sm-block btn-lg text-capitalize mx-auto" style="width: 50%;">
                    Quote
                </button>
                <div class="input-group mb-3 space-items mx-auto" style="width: 50%;">
                    <span class="input-group-text">$</span>
                    <input type="text" class="form-control" value="'.$resgistro->total.'">
                </div>
                </div>
                </form>';
            break;
        }
    }
    else{
        echo '<form method="post" class="container d-grid dos-col space-cell mt-7">
            <div class="container d-grid una-col space-cell">
                <div>
                <label>CPU</label>';
                echo $oBD->consList("componente","id","CONCAT(nombre,' - $',costo)","procesador",1);
        echo '</div>
            <div>
            <label>RAM</label>';
            echo $oBD->consList("componente","id","CONCAT(nombre,' - $',costo)","ram",8);
        echo '</div>
            <div>
            <label>HDD</label>';
            echo $oBD->consList("componente","id","CONCAT(nombre,' - $',costo)","hdd",10);
        echo '</div>
            <div>
            <label>GPU</label>';
            echo $oBD->consList("componente","id","CONCAT(nombre,' - $',costo)","gpu",3);
        echo '</div>
        </div>
        <div class="my-auto">
        <input 
            type="hidden" 
            name="action" 
            value="create">
        <button type="submit" class="btn btn-custom d-sm-block btn-lg text-capitalize mx-auto" style="width: 50%;">
            Quote
        </button>
        </div>
        </form>';
    }
?>