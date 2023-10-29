<!DOCTYPE html>
<html>
<head>
    <title>Usuarios Registrados</title>
</head>
<body>
    <h1>Usuarios Registrados</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Edad</th>
            <th>Editar</th>
        </tr>
        <?php
        // Conectar a la base de datos (PDO)
        $dsn = 'mysql:host=localhost;dbname=EntregaPHPBasica';
        $usuario = 'root';
        $contraseña = 'root';

        try {
            $conexion = new PDO($dsn, $usuario, $contraseña);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta para recuperar los usuarios
            $consulta = $conexion->prepare("SELECT * FROM usuarios");
            $consulta->execute();
            $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);

            // Iterar a través de los usuarios y mostrarlos en la tabla
            foreach ($usuarios as $usuario) {
                echo "<tr>";
                echo "<td>{$usuario['ID']}</td>";
                echo "<td>{$usuario['nombre']}</td>";
                echo "<td>{$usuario['email']}</td>";
                echo "<td>{$usuario['edad']}</td>";
                echo "<td><a href='editar_usuario.php?id={$usuario['ID']}'>Editar</a></td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "Error en la conexión o consulta: " . $e->getMessage();
        }
        ?>
    </table>
</body>
</html>
