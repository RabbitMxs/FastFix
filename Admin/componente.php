<?php
include "header.php";
include "menu.php";
?>

<div class="container" id="contenido">
<h2 class="space-items">Components</h2>
<?php
	include "../class/classComponente.php";
	$objComponente = new classComponente();
	$objComponente -> accion("list");
?>
</div>
<script src="../Controllers/componente.js?v=1.7"></script>
</body>
</html>