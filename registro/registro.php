<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css_registro.css">
</head>
<body>
<form action="registro.php" method="POST">
    <input type="text" name="nombre" placeholder="Ingrese su nombre" required><br>
    <input type="text" name="apellido" placeholder="Ingrese su apellido" required><br>
    <input type="password" name="clave" placeholder="Ingrese su contrseña" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="telefono" placeholder="Ingrese su numero de telefono" required><br>
    <input type="text" name="direccion" placeholder="Direccion" required><br>
    <input type="submit" value="Enviar">
    <input type="reset" value="limpiar">
    </form>

</body>
</html>



<?php    require 'database.php';    ?>

<?php
session_start();
include "database.php";

if(isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['clave']) && isset($_POST['apellido']) && isset($_POST['telefono']) && isset($_POST['direccion'])) {
    $nombre = mysqli_real_escape_string($conn, trim($_POST['nombre']));
    $apellido = mysqli_real_escape_string($conn, trim($_POST['apellido']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $clave = password_hash(mysqli_real_escape_string($conn, trim($_POST['clave'])), PASSWORD_DEFAULT);
    $telefono = mysqli_real_escape_string($conn, trim($_POST['telefono']));
    $direccion = mysqli_real_escape_string($conn, trim($_POST['direccion']));

    // Validar que el correo electrónico tenga un formato válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Formato de email inválido";
        exit;
    }

    // Validar que el teléfono tenga un formato válido (10 dígitos)
    if (!preg_match("/^[0-9]{10}$/", $telefono)) {
        echo "Error: Formato de teléfono inválido";
        exit;
    }

    // Obtener la fecha actual en el formato deseado
    $fecha_reg = date("d/m/Y");

    $sql = "INSERT INTO registro (Nombre, Apellido, Email, telefono, direccion, clave, fecha_reg) VALUES ('$nombre','$apellido','$email','$telefono','$direccion','$clave','$fecha_reg')";

    if (mysqli_query($conn, $sql)) {
        echo "Registro Exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
