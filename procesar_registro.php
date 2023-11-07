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

    // Obtener datos del formulario
    $dni = $_POST["dni"];
    $apellido = $_POST["apellido"];
    $nombre = $_POST["nombre"];
    $celular = $_POST["celular"];
    $circuito = $_POST["circuito"];

    // Verificar si el usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE dni = $dni";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "El usuario ya está registrado.";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (dni, apellido, nombre, celular, circuito)
                VALUES ('$dni', '$apellido', '$nombre', '$celular', '$circuito')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso. Redirigiendo a la página de inicio de sesión...";
            header("refresh:2;url=login.php"); // Redireccionar después de 2 segundos
            exit();
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>