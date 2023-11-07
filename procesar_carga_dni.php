<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["dni"])) {
    header("Location: login.php");
    exit();
}

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

// Obtener el DNI del usuario
$dni = $_SESSION["dni"];

// Obtener el número de DNI del formulario
$nuevo_dni = $_POST["dni"];

// Verificar cuántos DNI ha cargado el usuario
$sql = "SELECT COUNT(*) as total FROM dni_registrados WHERE usuario_id = (SELECT id FROM usuarios WHERE dni = $dni)";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_registros = $row["total"];

// Verificar si el usuario ha alcanzado el límite de 20 registros
if ($total_registros >= 20) {
    $message = urlencode("Ha alcanzado el límite de 20 registros.");
    header("Location: carga_dni.php?message=$message");
    exit(); // Terminar la ejecución del script
}

// Verificar si el DNI ya fue cargado por otro usuario
$sql = "SELECT * FROM dni_registrados WHERE dni = $nuevo_dni";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $message = urlencode("El DNI $nuevo_dni ya fue cargado por otro usuario.");
    header("Location: carga_dni.php?message=$message");
    exit(); // Terminar la ejecución del script
} else {
    // Insertar el nuevo DNI en la base de datos
    $sql = "INSERT INTO dni_registrados (usuario_id, dni) 
            VALUES ((SELECT id FROM usuarios WHERE dni = $dni), $nuevo_dni)";

    if ($conn->query($sql) === TRUE) {
        $message = urlencode("Número de DNI cargado exitosamente.");
        header("Location: carga_dni.php?message=$message");
        exit(); // Terminar la ejecución del script
    } else {
        echo "Error al cargar el número de DNI: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
