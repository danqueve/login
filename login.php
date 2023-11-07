<!DOCTYPE html>
<html lang="es">
<head>


    <title>Iniciar Sesión</title>
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
<br>
<br>
<br>
<div class="container">
    <br>
    <h1>Iniciar Sesión</h1>

    <form action="procesar_login.php" method="post">
        <label for="dni">DNI:</label>
        <input type="number" id="dni" name="dni" required><br>
<br>

        <input type="submit" value="Iniciar Sesión">
    </form>

</div>
</body>
</html>
