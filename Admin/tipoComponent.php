<?php
include "header.php";
include "menu.php";
?>
<div class="container" id="contenido">
<h2 class="space-items">Component Type</h2>
<?php
	include "../class/classTipoComponente.php";
	$objTipoComponente = new classTipoComponente();
	$objTipoComponente -> accion("list");
?>
</div>
<script src="../Controllers/tipoComponente.js?v=1.7"></script>
</body>
</html>
