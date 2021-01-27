<?php
	include "header.php";
	include "menu.php";

?>
<div class="container" id="contenido">
<h2 class="space-items">Users</h2>

<?php
	include "../class/classUsuarios.php";
	$objUsuarios = new classUsuarios();
	$objUsuarios -> accion("list");

?>
</div>
<script src="../Controllers/usuarios.js?v=1.7"></script>
</body>
</html>
