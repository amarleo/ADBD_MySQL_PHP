<?php
session_start(); 
$_SESSION['display_productos'] = TRUE;
$_SESSION['display_cliente'] = FALSE;
$_SESSION['display_compras'] = FALSE;
$db = mysqli_connect('localhost','usuario1','usuario1','proyecto') or die('Error al conectar al servidor MySQL.'); ?>
<!DOCTYPE html>
<html>
<head>
</head>

<body>

<table>
  <h1>Tabla Productos</h1>
  <tr>
    <th>ID Producto</th>
    <th>Nombre</th>
    <th>Familia</th>
    <th>Descripcion</th>
    <th>Dimensiones</th>
    <th>Peso</th>
    <th>PVP</th>
    <th>Image</th>
    <th>Stock</th>
    <th>Borrado</th>
    </tr>
  <?php
  $query = mysqli_query($db, "SELECT * FROM PRODUCTOS");

?>

<tr>
  <form action="insert.php" method="post">
    <td><input type='text' name='enterID'></td>
    <td><input type='text' name='enterNombre'></td>
    <td><input type='text' name='enterFamilia'></td>
    <td><input type='text' name='enterDescripcion'></td>
    <td><input type='text' name='enterDimensiones'></td>
    <td><input type='text' name='enterPeso'></td>
    <td><input type='text' name='enterPVP'></td>
    <td><input type='text' name='enterImage'></td>
    <td><input type='text' name='enterStock'></td>
    <td><button>Insert</button></td>
    </form>
  </tr>

  <?php
  while($data = mysqli_fetch_array($query))
  {
    if ($data['Borrado'] == 0) { 
  ?>
  <tr>
    <td><?php echo $data['ID_Producto'];?></td>
    <td><?php echo $data['Nombre'];?></td>
    <td><?php echo $data['Familia'];?></td>
    <td><?php echo $data['Descripcion'];?></td>
    <td><?php echo $data['Dimensiones'];?></td>
    <td><?php echo $data['Peso'];?></td>
    <td><?php echo $data['PVP'];?></td>
    <td><?php echo $data['Image'];?></td>
    <td><?php echo $data['Stock'];?></td>
    <td><?php echo $data['Borrado'];?></td>
    <td><a href="edit.php?id=<?php echo $data['ID_Producto']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $data['ID_Producto']; ?>">Delete</a></td>
  </tr>
  
  <?php
  }
}
?>
</body>
<?php
mysqli_close($db);
?>
</html>