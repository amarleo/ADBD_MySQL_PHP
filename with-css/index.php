<?php
# Si no se va a usar la base de datos se ha de borrar en este fichero.
session_start();
require "bbdd.php"
?>
<style>
  <?php include 'CSS/index.css'; ?>
</style>
<!DOCTYPE html>
<html>
<head>
    <title>Práctica: PHP + MySQL</title>
</head>
<body>
<div class = "index">
  <h1>Práctica: PHP + MySQL</h1>
  <p>Autor: Alejandro Martín de León</p>
  <p>Contacto: alu0101015941@ull.edu.es</p>
  <a href="cliente.php?">Clientes</a>
  <a href="productos.php?">Productos</a>
  <a href="compras.php?">Compras</a>
</div>

</body>
<?php
mysqli_close($db);
?>

</html>