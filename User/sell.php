<?php
    include "header.php";
    include "menu.php";
    include "../class/classBaseDatos.php";
    if(isset($_POST['action'])){
		switch ($_POST['action']){
        }
    }
    else{
        echo '<form method="post" class="container d-grid dos-col space-cell mt-7">
            <div class="container d-grid una-col space-cell">
                <div>
                <label>Procesador</label>';
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
        <button type="submit" class="btn btn-custom d-sm-block btn-lg text-capitalize mx-auto" style="width: 50%;">
            Submit
        </button>
        </div>
        </form>';
    }
?>