<?php
// Verificar si el formulario se envió por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los datos del formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $edad = $_POST["edad"];

    // Validación básica
    if (empty($nombre) || empty($email) || empty($edad) || !is_numeric($edad)) {
        echo "Por favor, complete todos los campos del formulario correctamente.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "La dirección de correo electrónico no es válida.";
    } else {
        // Los datos son válidos, proceder a la actualización en la base de datos
        $dsn = 'mysql:host=localhost;dbname=EntregaPHPBasica';
        $usuario = 'root';
        $contraseña = 'root';

        try {
            // Conectar a la base de datos
            $conexion = new PDO($dsn, $usuario, $contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Preparar la consulta de actualización
            $consulta = $conexion->prepare("UPDATE usuarios SET nombre = :nombre, email = :email, edad = :edad WHERE ID = :id");
            $consulta->bindParam(':id', $id);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':edad', $edad);

            // Ejecutar la consulta de actualización
            if ($consulta->execute()) {
                echo "Los cambios se han guardado correctamente.";
            } else {
                echo "Error al actualizar los datos del usuario.";
            }
        } catch (PDOException $e) {
            echo "Error en la conexión o actualización de datos: " . $e->getMessage();
        }
    }
} else {
    echo "Acceso no válido al archivo de procesamiento.";
}
?>
