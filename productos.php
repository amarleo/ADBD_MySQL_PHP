<?php
session_start(); 
$_SESSION['display_productos'] = TRUE;
$_SESSION['display_cliente'] = FALSE;
$_SESSION['display_compras'] = FALSE;
require "bbdd.php"; 

$columns = array('ID_Producto','Nombre','Familia', 'Descripcion', 'Dimensiones', 'Peso', 'PVP', 'Image', 'Stock');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if ($result = mysqli_query($db, "SELECT * FROM PRODUCTOS WHERE Borrado = 0 ORDER BY $column $sort_order")) {
  
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
  <h1>Tabla Productos</h1>
  <tr>
    <th><a href="productos.php?column=ID&order=<?php echo $asc_or_desc; ?>">ID Producto<i class ="<?php echo $column == 'DNI' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="productos.php?column=Nombre&order=<?php echo $asc_or_desc; ?>">Nombre<i class ="<?php echo $column == 'Nombre' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="productos.php?column=Familia&order=<?php echo $asc_or_desc; ?>">Familia<i class ="<?php echo $column == 'Familia' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="productos.php?column=Descripcion&order=<?php echo $asc_or_desc; ?>">Descripcion<i class ="<?php echo $column == 'Descripcion' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="productos.php?column=Dimensiones&order=<?php echo $asc_or_desc; ?>">Dimensiones<i class ="<?php echo $column == 'Dimensiones' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="productos.php?column=Peso&order=<?php echo $asc_or_desc; ?>">Peso<i class ="<?php echo $column == 'Peso' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="productos.php?column=PVP&order=<?php echo $asc_or_desc; ?>">PVP<i class ="<?php echo $column == 'PVP' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="productos.php?column=Image&order=<?php echo $asc_or_desc; ?>">Image<i class ="<?php echo $column == 'Image' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="productos.php?column=Stock&order=<?php echo $asc_or_desc; ?>">Stock<i class ="<?php echo $column == 'Stock' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    </tr>
  <?php
  # $query = mysqli_query($db, "SELECT * FROM PRODUCTOS WHERE Borrado = 0");

?>

<tr>
  <form action="insert.php" method="post">
    <td></td>
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
  while($data = mysqli_fetch_assoc($result))
  {
    #if ($data['Borrado'] == 0) { 
  ?>
  <tr>
    <td <?php echo $column == 'ID_Producto' ? $add_class : ''; ?>><?php echo $data['ID_Producto'];?></td>
    <td <?php echo $column == 'Nombre' ? $add_class : ''; ?>><?php echo $data['Nombre'];?></td>
    <td <?php echo $column == 'Familia' ? $add_class : ''; ?>><?php echo $data['Familia'];?></td>
    <td <?php echo $column == 'Descripcion' ? $add_class : ''; ?>><?php echo $data['Descripcion'];?></td>
    <td <?php echo $column == 'Dimensiones' ? $add_class : ''; ?>><?php echo $data['Dimensiones'];?></td>
    <td <?php echo $column == 'Peso' ? $add_class : ''; ?>><?php echo $data['Peso'];?></td>
    <td <?php echo $column == 'PVP' ? $add_class : ''; ?>><?php echo $data['PVP'];?></td>
    <td <?php echo $column == 'Image' ? $add_class : ''; ?>><?php echo $data['Image'];?></td>
    <td <?php echo $column == 'Stock' ? $add_class : ''; ?>><?php echo $data['Stock'];?></td>
    <td><a href="edit.php?id=<?php echo $data['ID_Producto']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $data['ID_Producto']; ?>">Delete</a></td>
  </tr>

  <?php
  #}
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