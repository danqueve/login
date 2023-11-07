<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "ourjxora_alejandro";
$password = "Meri0803";
$dbname = "ourjxora_dirigentes";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Obtener la lista de usuarios y sus datos
$sql = "SELECT dni, apellido, nombre, circuito FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Usuario</title>
</head>
<body>
    <h1>Listado de Usuarios</h1>

    <table border="1">
        <tr>
            <th>DNI</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Circuito</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>". $row["dni"]. "</td>
                        <td>". $row["apellido"]. "</td>
                        <td>". $row["nombre"]. "</td>
                        <td>". $row["circuito"]. "</td>
                      </tr>";
            }
        } else {
            echo "No se encontraron usuarios.";
        }
        ?>
    </table>
</body>
</html>
