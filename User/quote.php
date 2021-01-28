<?php
include "header.php";
include "menu.php";
include "../class/classBaseDatos.php";
    if(isset($_POST['action'])){
        switch($_POST['action']){
            case 'quote':
                $query='SELECT nombre from tipocomponente WHERE id='.$_POST['idTipoComponente'];
                $registro=$oBD->sacaTupla($query);

                echo '<div class="container">';
				echo '<h2 class="space-items">'.$registro->nombre.'</h2>';
                $query='SELECT c.id, c.nombre, c.caracteristicas, c.costo FROM componente c
                join  tipocomponente tc on c.idTipoComponente=tc.id
                WHERE tc.id = '.$_POST['idTipoComponente'].' AND  c.tipo="V"';
                echo $oBD->mostProduct($query,"table-light",array('5%', '15%','60%','15%'),"registro",'');
                echo '</div">';
            break;
            case 'registro':
                $query="SELECT nombre, caracteristicas, costo FROM componente WHERE id = ".$_POST['id'];
                echo '<div class="container">';
				echo '<h2 class="space-items">Purchase Quote</h2>';
                echo $oBD->mostTabla($query,array(),"table-light",array('25%','65%','10%'));
                
                //insert_bd
                $query="INSERT INTO cotizacion set  fecha=CURRENT_DATE, idUsuario='".$_SESSION['id']."', idTipoCotizacion='2'";
                $oBD->query($query);
                $idCot=$oBD->lastid;
                $query="INSERT INTO compcotizacion set idCotizacion='".$idCot."', idComponente='".$_POST['id']."'";
                $oBD->query($query);
                $query="SELECT costo FROM componente WHERE id = ".$_POST['id'];
                $registro=$oBD->sacaTupla($query);
                $query="UPDATE cotizacion set  total=".$registro->costo." where id=".$idCot;
                $oBD->query($query);
                echo '<div style="display: flex;justify-content: end;font-size: x-large;">
                    <label>Total: $'.$registro->costo.'</label>
                </div>';
                echo '</div>';
            break;
        }
    }
    else{
        echo '<div class="container space-cell mt-7 centrar" style="width: 30%">
        <form class="container mt-7 centrar" method="post">
            <img  width="250px" src="../images/dibujo.png"/>
            <div style="margin-top: 50px;">
                <div class="form-group">
                    <label for="name" style="font-size: 2rem;">Type Component</label></br>';
        echo $oBD->consListBox("tipoComponente","id","nombre","idTipoComponente",0);
        echo'</div>
                <div style="width: 100%;" class="btn-block my-auto btn-lg mx-auto my-auto" method="post">
                    <input type="hidden" name="action" value="quote">
                    <input style="width: 100%;"  class="btn btn-custom d-sm-block btn-lg text-capitalize my-auto" type="submit" value="Quote">
                </div>
            </div>
        </form>
        
    </div>'; 
    }
?>
</body>
</html>