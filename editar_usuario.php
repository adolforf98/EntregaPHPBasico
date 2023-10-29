<?php
// Verificar si se proporciona un ID válido a través de la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Conectar a la base de datos
    $dsn = 'mysql:host=localhost;dbname=EntregaPHPBasica';
    $usuario = 'root';
    $contraseña = 'root';

    try {
        $conexion = new PDO($dsn, $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consultar la información del usuario
        $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE ID = :id");
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo "No se encontró un usuario con el ID proporcionado.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error en la conexión o consulta: " . $e->getMessage();
        exit;
    }
} else {
    echo "ID de usuario no válido.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="procesar_edicion.php" method="post">
        <input type="hidden" name="id" value="<?php echo $usuario['ID']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>"><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $usuario['email']; ?>"><br>

        <label for="edad">Edad:</label>
        <input type="text" id="edad" name="edad" value="<?php echo $usuario['edad']; ?>"><br>

        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
