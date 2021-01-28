<?php
    include "header.php";
	include "menu.php";
    include "../class/classBaseDatos.php";
    $query="SELECT c.id, c.nombre, c.costo as Costo_Unitario, Count(c.id) as ventas, SUM(c.costo) as total 
    FROM compcotizacion cm 
    join componente c on c.id=cm.idComponente 
    GROUP by c.id";
    echo '<div class="container">';
    echo '<h2 class="space-items">Purchase Quote</h2>';
    echo $oBD->mostTabla($query,array(),"table-light",array('5%','20%','10%','10%','10%'));
?>
</div>
</body>
</html>