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

// Verificar si el usuario es superusuario
$sql = "SELECT es_superusuario FROM usuarios WHERE dni = $dni";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$es_superusuario = $row["es_superusuario"];

// Obtener la información de los usuarios y sus cargas
if ($es_superusuario) {
    $sql = "SELECT u.dni, u.apellido, u.nombre, u.circuito, d.dni as dni_cargado
            FROM usuarios u
            LEFT JOIN dni_registrados d ON u.id = d.usuario_id
            ORDER BY u.dni";
} else {
    $sql = "SELECT dni, apellido, nombre, circuito
            FROM usuarios
            WHERE dni = $dni";
}

$result = $conn->query($sql);

$usuarios = array();

while($row = $result->fetch_assoc()) {
    $usuarios[$row["dni"]]["apellido"] = $row["apellido"];
    $usuarios[$row["dni"]]["nombre"] = $row["nombre"];
    $usuarios[$row["dni"]]["circuito"] = $row["circuito"];

    if ($row["dni_cargado"]) {
        $usuarios[$row["dni"]]["cargas"][] = $row["dni_cargado"];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php include "head.php" ?>
    <title>Ver Cargas</title>
</head>
<body>
<?php include "nav.php" ?>    
<h1>Cargas por Usuario</h1>
    

<?php
    foreach ($usuarios as $dni_usuario => $info) {
        echo "<h2>DNI: $dni_usuario - {$info['apellido']}, {$info['nombre']} - Circuito: {$info['circuito']}</h2>";

        if (isset($info["cargas"])) {
            echo "<div class='table-responsive-lg'>";
            echo "<table class='table table-bordered'>";
            echo "<thead>
                    <tr>
                        <th>#</th>
                        <th>DNI Cargado</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            $contador = 1;
            foreach ($info["cargas"] as $dni_cargado) {
                echo "<tr>
                        <td>$contador</td>
                        <td>$dni_cargado</td>
                      </tr>";
                $contador++;
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>No se encontraron cargas para este usuario.</p>";
        }
    }
    ?>
    
</body>
</html>
