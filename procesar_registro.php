<?php
// Verificar si el formulario se envió por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los datos del formulario
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $edad = $_POST["edad"];

    // Validación básica
    if (empty($nombre) || empty($email) || empty($edad)) {
        echo "Por favor, complete todos los campos del formulario.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "La dirección de correo electrónico no es válida.";
    } elseif (!is_numeric($edad) || $edad < 0) {
        echo "La edad debe ser un número válido.";
    } else {
        // Los datos son válidos, proceder a la inserción en la base de datos
        $dsn = 'mysql:host=localhost;dbname=EntregaPHPBasica';
        $usuario = 'root';
        $contraseña = 'root';

        try {
            // Conectar a la base de datos
            $conexion = new PDO($dsn, $usuario, $contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Preparar la consulta de inserción
            $consulta = $conexion->prepare("INSERT INTO usuarios (nombre, email, edad) VALUES (:nombre, :email, :edad)");
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':edad', $edad);

            // Ejecutar la consulta de inserción
            if ($consulta->execute()) {
                echo "Registro exitoso. El usuario ha sido agregado a la base de datos.";
            } else {
                echo "Error al agregar el usuario a la base de datos.";
            }
        } catch (PDOException $e) {
            echo "Error en la conexión o inserción de datos: " . $e->getMessage();
        }
    }
} else {
    echo "Acceso no válido al archivo de procesamiento.";
}
?>
