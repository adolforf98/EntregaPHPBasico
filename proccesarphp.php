<?php
// consultabd.php
$dsn = 'mysql:host=localhost;dbname=EntregaPHPBasica';
$usuario = 'root';
$contraseña = 'root';


if (empty($nombre) || empty($email)) {
    echo "Por favor, complete todos los campos del formulario.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "La dirección de correo electrónico no es válida.";
} else {
try {
    $conexion = new PDO($dsn, $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Conexión exitosa a la base de datos."; // Verificar la conexión exitosa
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage(); // Mostrar mensaje de error
}
try {
    $consulta = $conexion->prepare("SELECT * FROM usuarios");
    $consulta->execute();
    $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
}
?>