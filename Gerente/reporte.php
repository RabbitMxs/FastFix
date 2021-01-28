<?php
 include "header.php";
 include "menu.php";
 include "../class/classBaseDatos.php";
 $query="SELECT Year(fecha) as Año, Date_format(fecha, '%M') as Mes, CONCAT('$',SUM(total)) as total 
 FROM cotizacion 
 GROUP BY MONTH(fecha),Year(fecha)
 ORDER BY Year(fecha),MONTH(fecha) ASC";
 echo '<div class="container">';
 echo '<h2 class="space-items">Monthly Reports</h2>';
 echo $oBD->mostTabla($query,array(),"table-light",array('33.33%','33.33%','33.33%'));
?>
</div>
</body>
</html>