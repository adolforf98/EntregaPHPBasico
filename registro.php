<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <form action="procesar.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>

        <label for="edad">Edad:</label>
        <input type="text" id="edad" name="edad"><br>
        
        <input type="submit" value="Registrar">
        </form>
</body>
</html>