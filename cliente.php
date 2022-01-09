<?php
header('Content-Type: text/html; charset=UTF-8');
session_start(); 
require "bbdd.php"; 
$_SESSION['display_cliente'] = TRUE;
$_SESSION['display_productos'] = FALSE;
$_SESSION['display_compras'] = FALSE;


$columns = array('DNI','Nombre','Apellidos', 'Email', 'Telefono', 'Direccion', 'Codigo_postal');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if ($result = mysqli_query($db, "SELECT * FROM CLIENTE WHERE Borrado = 0 ORDER BY $column $sort_order")) {
  
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';


?>
<!DOCTYPE html>
<html>
<!--<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>-->
<head>
</head>

<body>

  <?php
    if(isset($_GET['search'])) {
      $fields = array('DNI', 'Nombre', 'Apellidos', 'Email', 'Telefono', 'Direccion', 'Codigo_Postal');
      $conditions = array();

      foreach($fields as $field) {
        //if the field is set and not empty
        if(isset($_POST[$field]) && $_POST[$field] != '') {
          $conditions[] = " $field = '" . mysqli_real_escape_string($db,$_POST[$field]) . "'";
        }
      }
      $query = "SELECT * FROM CLIENTE";
      if(count($conditions) > 0) {
        $query .= " WHERE " . implode(" AND ", $conditions);
      }
      echo $query;
      $result = mysqli_query($db, $query);
    }
  ?>

<table>
  <h1>Búsqueda</h1>
  <tr>
    <th>DNI</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Email</th>
    <th>Teléfono</th>
    <th>Direccion</th>
    <th>Código Postal</th>
    </tr>

    <form action="cliente.php?search=" method="post">
    <td><input type='text' name='DNI'></td>
    <td><input type='text' name='Nombre'></td>
    <td><input type='text' name='Apellidos'></td>
    <td><input type='text' name='Email'></td>
    <td><input type='text' name='Telefono'></td>
    <td><input type='text' name='Direccion'></td>
    <td><input type='text' name='Codigo_Postal'></td>
    <td><button>Insert</button></td>
    </form>
  </table>

  <table>
  <h1>Tabla Cliente</h1>
  <tr>
    <th><a href="cliente.php?column=DNI&order=<?php echo $asc_or_desc; ?>">DNI<i class ="<?php echo $column == 'DNI' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="cliente.php?column=Nombre&order=<?php echo $asc_or_desc; ?>">Nombre<i class ="<?php echo $column == 'Nombre' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="cliente.php?column=Apellidos&order=<?php echo $asc_or_desc; ?>">Apellidos<i class ="<?php echo $column == 'Apellidos' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="cliente.php?column=Email&order=<?php echo $asc_or_desc; ?>">Email<i class ="<?php echo $column == 'Email' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="cliente.php?column=Telefono&order=<?php echo $asc_or_desc; ?>">Teléfono<i class ="<?php echo $column == 'Telefono' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="cliente.php?column=Direccion&order=<?php echo $asc_or_desc; ?>">Direccion<i class ="<?php echo $column == 'Direccion' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    <th><a href="cliente.php?column=Codigo_postal&order=<?php echo $asc_or_desc; ?>">Código Postal<i class ="<?php echo $column == 'Codigo_postal' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    </tr>
  <?php
  # $query = mysqli_query($db, "SELECT * FROM CLIENTE ORDER BY $order $sort");

?>
  <tr>
  <form action="insert.php?" method="post">
    <td><input type='text' name='enterDNI'></td>
    <td><input type='text' name='enterNombre'></td>
    <td><input type='text' name='enterApellidos'></td>
    <td><input type='text' name='enterEmail'></td>
    <td><input type='text' name='enterTelefono'></td>
    <td><input type='text' name='enterDireccion'></td>
    <td><input type='text' name='enterCodigo_Postal'></td>
    <td><button>Search</button></td>
    </form>
  </tr>
<?php

  while($data = mysqli_fetch_assoc($result)) {

  ?>
  <tr>
    <td <?php echo $column == 'DNI' ? $add_class : ''; ?>><?php echo $data['DNI'];?></td>
    <td <?php echo $column == 'Nombre' ? $add_class : ''; ?>><?php echo $data['Nombre'];?></td>
    <td <?php echo $column == 'Apellidos' ? $add_class : ''; ?>><?php echo $data['Apellidos'];?></td>
    <td <?php echo $column == 'Email' ? $add_class : ''; ?>><?php echo $data['Email'];?></td>
    <td <?php echo $column == 'Telefono' ? $add_class : ''; ?>><?php echo $data['Telefono'];?></td>
    <td <?php echo $column == 'Direccion' ? $add_class : ''; ?>><?php echo $data['Direccion'];?></td>
    <td <?php echo $column == 'Codigo_postal' ? $add_class : ''; ?>><?php echo $data['Codigo_postal'];?></td>
    <td ><a href="edit.php?id=<?php echo $data['DNI']; ?>">Edit</a></td>
    <td ><a href="delete.php?id=<?php echo $data['DNI']; ?>">Delete</a></td>
  </tr>

  <?php
  }


  ?>
  </table>
  
  <?php if ($result->num_rows == 0) {
    ?>
    <p>No se han encontrado resultados</p>
    <?php
  }?>

<a href="index.php">return</a>
</body>

</html>
<?php
$result->free();
} 

?>
<?php
mysqli_close($db);
?>