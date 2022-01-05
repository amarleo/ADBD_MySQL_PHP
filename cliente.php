<?php
session_start(); 
$_SESSION['display_cliente'] = TRUE;
$_SESSION['display_productos'] = FALSE;
$_SESSION['display_compras'] = FALSE;
$db = mysqli_connect('localhost','usuario1','usuario1','proyecto') or die('Error al conectar al servidor MySQL.'); 
?>
<!DOCTYPE html>
<html>
<!--<script src="https://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>-->
<head>
</head>

<body>

<table>
  <h1>Tabla Cliente</h1>
  <tr>
    <th>DNI</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Email</th>
    <th>Teléfono</th>
    <th>Direccion</th>
    <th>Código Postal</th>
    </tr>
  <?php
  $query = mysqli_query($db, "SELECT * FROM CLIENTE");

?>
  <tr>
  <form action="insert.php" method="post">
    <td><input type='text' name='enterDNI'></td>
    <td><input type='text' name='enterNombre'></td>
    <td><input type='text' name='enterApellidos'></td>
    <td><input type='text' name='enterEmail'></td>
    <td><input type='text' name='enterTelefono'></td>
    <td><input type='text' name='enterDireccion'></td>
    <td><input type='text' name='enterCodigo_Postal'></td>
    <td><button>Insert</button></td>
    </form>
  </tr>
<?php
  while($data = mysqli_fetch_array($query))
  {
    if ($data['Borrado'] == 0) { 
  ?>
  <tr>
    <td><?php echo $data['DNI'];?></td>
    <td><?php echo $data['Nombre'];?></td>
    <td><?php echo $data['Apellidos'];?></td>
    <td><?php echo $data['Email'];?></td>
    <td><?php echo $data['Telefono'];?></td>
    <td><?php echo $data['Direccion'];?></td>
    <td><?php echo $data['Codigo_postal'];?></td>
    <td><a href="edit.php?id=<?php echo $data['DNI']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $data['DNI']; ?>">Delete</a></td>
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
