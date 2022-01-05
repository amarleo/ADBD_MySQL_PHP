<?php
session_start(); 
$_SESSION['display_cliente'] = FALSE;
$_SESSION['display_productos'] = FALSE;
$_SESSION['display_compras'] = TRUE;
$db = mysqli_connect('localhost','usuario1','usuario1','proyecto') or die('Error al conectar al servidor MySQL.'); 
?>
<!DOCTYPE html>
<html>
<head>
</head>

<body>

<table>
  <h1>Tabla Compras</h1>
  <tr>
    <th>ID Compra</th>
    <th>DNI Cliente</th>
    <th>ID Producto</th>
  </tr>
  
  <?php $query = mysqli_query($db, "SELECT * FROM COMPRA");?>

<tr>
  <form action="insert.php" method="post">
    <td><input type='text' name='enterID'></td>
    <td><input type='text' name='enterDNI'></td>
    <td><input type='text' name='enterIDPROD'></td>
    <td><button>Insert</button></td>
    </form>
  </tr>

  <?php
  while($data = mysqli_fetch_array($query))
  {
    if ($data['Borrado'] == 0) { 
  ?>
  <tr>
    <td><?php echo $data['ID_Compra'];?></td>
    <td><?php echo $data['CLIENTE_DNI'];?></td>
    <td><?php echo $data['PRODUCTOS_ID_Producto'];?></td>
    <td><a href="edit.php?id=<?php echo $data['ID_Compra']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $data['ID_Compra']; ?>">Delete</a></td>
  </tr>
  
  <?php
  }
}
?>
</table>
<a href="index.php">return</a>
</body>
<?php
mysqli_close($db);
?>
</html>