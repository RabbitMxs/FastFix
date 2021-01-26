<?php
include "header.php";
include "menu.php";

?>
<div class="container" id="contenido">
<h2 class="space-items">Provider</h2>

<?php
	include "../class/classProvedor.php";
	$objProvedor = new classProvedor();
	$objProvedor -> accion("list");

?>
</div>
<script src="../Controllers/provedor.js?v=1.7"></script>
</body>
</html>
