<?php
session_start();
$db = mysqli_connect('localhost','usuario1','usuario1','proyecto') or die('Error al conectar al servidor MySQL.');
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