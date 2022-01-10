<?php
# Si no se va a usar la base de datos se ha de borrar en este fichero.
session_start();
require "bbdd.php"
?>
<!DOCTYPE html>
<html>
<head>
    <title>Práctica: PHP + MySQL</title>
    <h1>Pŕactica: PHP + MySQL</h1>
    <p>Autor: Alejandro Martín de León</p>
    <p>Contacto: alu0101015941@ull.edu.es</p>
</head>
<body>
<div>
  <a href="cliente.php?">Clientes</a>
  <a href="productos.php?">Productos</a>
  <a href="compras.php?">Compras</a>
</div>

</body>
<?php
mysqli_close($db);
?>

</html>