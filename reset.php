<?php 
//? Archivo que destruye las sesiones y envia de nuevo a la pagina del formulario, por lo tanto el contador de intentos se define a 0.
session_start();
session_destroy();
header("Location:formulario_bien.php");
die();
?>