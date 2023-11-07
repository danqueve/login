<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["dni"])) {
    header("Location: login.php");
    exit();
}

// Obtener el DNI del usuario
$dni = $_SESSION["dni"];

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

// Obtener los datos del usuario
$sql = "SELECT apellido, nombre FROM usuarios WHERE dni = $dni";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$apellido = $row["apellido"];
$nombre = $row["nombre"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $nombre . " " . $apellido; ?></h1>
    <p>Apellido: <?php echo $apellido; ?></p>
    <p>Nombre: <?php echo $nombre; ?></p>
    <p>DNI: <?php echo $dni; ?></p>

    <!-- Aquí puedes mostrar el resto de la información del usuario si lo deseas -->
    
</body>
</html>
