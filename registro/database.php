<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "registro";

// Crear conexión
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Verificar conexión
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
