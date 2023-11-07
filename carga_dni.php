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

// Verificar cuántos DNI ha cargado el usuario
$sql = "SELECT COUNT(*) as total FROM dni_registrados WHERE usuario_id = (SELECT id FROM usuarios WHERE dni = $dni)";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_registros = $row["total"];

// Verificar si el usuario ha alcanzado el límite de 20 registros
if ($total_registros >= 20) {
    echo "Ya ha alcanzado el límite de 20 registros.";
} else {
    // Si no ha alcanzado el límite, permitir la carga de un nuevo DNI
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nuevo_dni = $_POST["dni"];
        // Resto del código de procesar_carga_dni.php
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

   
    <title>Carga de DNI</title>
    <?php include "head.php" ?>
</head>


<body>
<?php include "nav.php" ?>
<style> 
h1 {
    text-align:center;
    background-color: black;
    color:white;
}
body{
    text-align:center;
}

table {
  margin-left: auto;
  margin-right: auto;
  }

.container{
    background-color:#CEECF5;
    text-align: center;
    border-style: solid;
    border-radius: 50px;
    
    padding: 15px;
    


}
</style>

<div class="container p-5 my-5 border">

<h1>Bienvenido, <?php echo $nombre . " " . $apellido; ?></h1>



    
    <p>DNI: <?php echo $dni; ?></p>

    <form action="procesar_carga_dni.php" method="post">
        <label for="dni">INGRESAR DNI:</label>
        <input type="number" id="dni" name="dni" required><br>
<br>
        <button type="submit" class="btn btn-success">Cargar</button>
        
    </form>
    <script>
<?php
if (isset($_GET['message'])) {
    echo "alert('" . $_GET['message'] . "');";
}
?>
</script>


<br>

<table class='table-responsive-lg table-bordered'>
    <tr>
        <th>#</th>
        <th>DNI</th>
    </tr>
    <?php
    // Obtener los DNI cargados por el usuario
    $sql = "SELECT dni FROM dni_registrados WHERE usuario_id = (SELECT id FROM usuarios WHERE dni = $dni)";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $contador = 1;
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>$contador</td>
                    <td>". $row["dni"]. "</td>
                  </tr>";
            $contador++;
        }
    } else {
        echo "<tr><td colspan='2'>No se han cargado DNI.</td></tr>";
    }
    ?>
</div>
</table>
</body>
</html>
