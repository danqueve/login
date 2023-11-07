<!DOCTYPE html>
<html lang="es">
<head>

    <title>Registro de Usuario</title>
    <?php include "head.php" ?>
</head>
<body>
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
</head>
<body>
    <h1>Registro de Usuario</h1>

    <BR>
    <BR></BR>
    <form action="procesar_registro.php" method="post">
    <div class="mb-3">
        <label for="dni">DNI:</label>
        <input type="number" id="dni" name="dni" required><br>
</div>
<div class="mb-3">
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br>
</div>
<div class="mb-3">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        </div>
<div class="mb-3">
        <label for="celular">Celular:</label>
        <input type="text" id="celular" name="celular" required><br>
        </div>
<div class="mb-3">
        <label for="circuito">Circuito:</label>
        <input type="text" id="circuito" name="circuito" required><br>
        </div>
<div class="mb-3">
        
       <button type="submit" class="btn btn-success">REGISTRARSE</button>
    </form>
    <p> Todos los campos son obligatorios</p>
</body>
</html>
