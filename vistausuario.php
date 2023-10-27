<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta a la Base de Datos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Usuarios de la Base de Datos</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
            </tr>
            <?php
            // Incluir el archivo PHP con la consulta a la base de datos
            include('consultar_bd.php');

            // Mostrar los resultados en la tabla
            
                echo "<tr>";
                echo "<td>" . $usuario['id'] . "</td>";
                echo "<td>" . $usuario['nombre'] . "</td>";
                echo "<td>" . $usuario['correo'] . "</td>";
                echo "</tr>";
            
            ?>
        </table>
    </div>
</body>
</html>