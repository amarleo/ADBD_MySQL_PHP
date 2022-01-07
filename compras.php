<?php
session_start(); 
$_SESSION['display_cliente'] = FALSE;
$_SESSION['display_productos'] = FALSE;
$_SESSION['display_compras'] = TRUE;
$db = mysqli_connect('localhost','usuario1','usuario1','proyecto') or die('Error al conectar al servidor MySQL.'); 

$columns = array('ID_Compra','CLIENTE_DNI','PRODUCTOS_ID_Producto');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if ($result = mysqli_query($db, "SELECT * FROM COMPRA WHERE Borrado = 0 ORDER BY $column $sort_order")) {
  
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';

?>
<!DOCTYPE html>
<html>
<head>
</head>

<body>

<table>
  <h1>Tabla Compras</h1>
  <tr>
    <th><a href="compras.php?column=ID_Compra&order=<?php echo $asc_or_desc; ?>">ID Compra<i class ="<?php echo $column == 'ID_Compra' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="compras.php?column=CLIENTE_DNI&order=<?php echo $asc_or_desc; ?>">DNI Cliente<i class ="<?php echo $column == 'CLIENTE_DNI' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="compras.php?column=PRODUCTOS_ID_Producto&order=<?php echo $asc_or_desc; ?>">ID Producto<i class ="<?php echo $column == 'PRODUCTOS_ID_Producto' ? '-' . $up_or_down : ''; ?>"></i></a></th>
  </tr>
  
  <?php # $query = mysqli_query($db, "SELECT * FROM COMPRA");?>

<tr>
  <form action="insert.php" method="post">
    <td><input type='text' name='enterID'></td>
    <td><input type='text' name='enterDNI'></td>
    <td><input type='text' name='enterIDPROD'></td>
    <td><button>Insert</button></td>
    </form>
  </tr>

  <?php
  while($data = mysqli_fetch_assoc($result))
  {
    if ($data['Borrado'] == 0) { 
  ?>
  <tr>
    <td <?php echo $column == 'ID_Producto' ? $add_class : ''; ?>><?php echo $data['ID_Compra'];?></td>
    <td <?php echo $column == 'CLIENTE_DNI' ? $add_class : ''; ?>><?php echo $data['CLIENTE_DNI'];?></td>
    <td <?php echo $column == 'PRODUCTOS_ID_Producto' ? $add_class : ''; ?>><?php echo $data['PRODUCTOS_ID_Producto'];?></td>
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
$result->free();
} 
mysqli_close($db);
?>
</html>