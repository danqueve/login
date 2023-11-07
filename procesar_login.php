<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Obtener el DNI del formulario
    $dni = $_POST["dni"];

    // Verificar si el usuario existe
    $sql = "SELECT * FROM usuarios WHERE dni = $dni";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El usuario existe, redirigir a la página de carga de DNI
        session_start();
        $_SESSION["dni"] = $dni; // Guardar el DNI en una sesión
        header("Location: carga_dni.php");
        exit();
    } else {
        echo "Usuario no encontrado. Por favor, regístrese.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si se intenta acceder a este archivo directamente sin enviar el formulario, redirigir al login
    header("Location: login.php");
    exit();
}
?>
