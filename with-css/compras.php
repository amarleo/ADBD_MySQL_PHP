<?php
session_start(); 
$_SESSION['display_cliente'] = FALSE;
$_SESSION['display_productos'] = FALSE;
$_SESSION['display_compras'] = TRUE;
require "bbdd.php"; 

$columns = array('ID_Compra','CLIENTE_DNI','PRODUCTOS_ID_Producto', 'Cantidad');
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
<style>
  <?php include 'CSS/tables.css'; ?>
</style>
</head>

<body>
<?php
    if(isset($_GET['search'])) {
      $fields = array('ID_Compra','CLIENTE_DNI','PRODUCTOS_ID_Producto', 'Cantidad');
      $conditions = array();

      foreach($fields as $field) {
        //if the field is set and not empty
        if(isset($_POST[$field]) && $_POST[$field] != '') {
          $conditions[] = " $field = '" . mysqli_real_escape_string($db,$_POST[$field]) . "'";
        }
      }
      $query = "SELECT * FROM COMPRA";
      if(count($conditions) > 0) {
        $query .= " WHERE " . implode(" AND ", $conditions);
      }
      $result = mysqli_query($db, $query);
    }
  ?>

<table class = "styled-table">
  <h1>Búsqueda</h1>
  <tr>
    <th>ID_Compra</th>
    <th>DNI_Cliente</th>
    <th>ID_Producto</th>
    <th>Cantidad</th>
    <th></th>
    </tr>

    <form action="compras.php?search" method="post">
    <td><input type='text' name='ID_Compra'></td>
    <td><input type='text' name='CLIENTE_DNI'></td>
    <td><input type='text' name='PRODUCTOS_ID_Producto'></td>
    <td><input type='text' name='Cantidad'></td>
    <td><button>Search</button></td>
    </form>
  </table>

<table class = "styled-table search-table">
  <h1>Tabla Compras</h1>
  <tr>
    <th><a class = "table-title" href="compras.php?column=ID_Compra&order=<?php echo $asc_or_desc; ?>">ID Compra<i class ="<?php echo $column == 'ID_Compra' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a class = "table-title" href="compras.php?column=CLIENTE_DNI&order=<?php echo $asc_or_desc; ?>">DNI Cliente<i class ="<?php echo $column == 'CLIENTE_DNI' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a class = "table-title" href="compras.php?column=PRODUCTOS_ID_Producto&order=<?php echo $asc_or_desc; ?>">ID Producto<i class ="<?php echo $column == 'PRODUCTOS_ID_Producto' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a class = "table-title" href="compras.php?column=Cantidad&order=<?php echo $asc_or_desc; ?>">Cantidad<i class ="<?php echo $column == 'Cantidad' ? '-' . $up_or_down : ''; ?>"></i></a></th>  
    <th></th>
    <th></th>
  </tr>
  
  <?php # $query = mysqli_query($db, "SELECT * FROM COMPRA");?>

<tr>
  <form action="insert.php" method="post">
    <td></td>
    <td><input type='text' name='enterDNI'></td>
    <td><input type='text' name='enterIDPROD'></td>
    <td><input type='text' name='enterCantidad'></td>
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
    <td <?php echo $column == 'Cantidad' ? $add_class : ''; ?>><?php echo $data['Cantidad'];?></td>

    <td><a class="edit" href="edit.php?id=<?php echo $data['ID_Compra']; ?>">Edit</a></td>
    <td><a class="delete" href="delete.php?id=<?php echo $data['ID_Compra']; ?>">Delete</a></td>
  </tr>
  
  <?php
  }
}
?>
</table>

<?php if ($result->num_rows == 0) {
    ?>
    <p>No se han encontrado resultados</p>
    <?php
  }?>

<a class = "return" href="index.php">return</a>
</body>
<?php
$result->free();
} 
mysqli_close($db);
?>
</html>