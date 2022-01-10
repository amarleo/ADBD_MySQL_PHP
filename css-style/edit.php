<?php
session_start(); 
require "bbdd.php";
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
$display_cliente = $_SESSION['display_cliente'];
$display_productos = $_SESSION['display_productos'];
$display_compras = $_SESSION['display_compras'];

# Editar cliente
if (isset($display_cliente) && ($display_cliente == TRUE)) {
  $dni = $_GET['id'];
  $mostrarCliente = "SELECT * FROM CLIENTE WHERE DNI = '$dni'";
  $query = mysqli_query($db,$mostrarCliente);
  if(mysqli_query($db, $mostrarCliente)){
    while($data = mysqli_fetch_array($query)) {
  ?>
  <table class="styled-table">
    <h1>Edit</h1>
  <tr>
    <th>DNI</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Email</th>
    <th>Teléfono</th>
    <th>Direccion</th>
    <th>Código Postal</th>
    <th></th>
    </tr>
  
  <form method="POST">
    <td><input type="text" name = "DNI" value="<?php echo $data['DNI'];?>"></td>
    <td><input type="text" name = "Nombre" value="<?php echo $data['Nombre'];?>"></td>
    <td><input type="text" name = "Apellidos" value="<?php echo $data['Apellidos'];?>"></td>
    <td><input type="text" name = "Email" value="<?php echo $data['Email'];?>"></td>
    <td><input type="text" name = "Telefono" value="<?php echo $data['Telefono'];?>"></td>
    <td><input type="text" name = "Direccion" value="<?php echo $data['Direccion'];?>"></td>
    <td><input type="text" name = "Codigo_postal" value="<?php echo $data['Codigo_postal'];?>"></td>
    <td><input type="submit" name="update" value="Update"></td>
  </form>
  </table>
  <a class ="return" href="cliente.php">Return</a>
  <?php
    }

    if(isset($_POST['update'])) {
      $newDNI = $_POST['DNI'];
      $newNombre = $_POST['Nombre'];
      $newApellidos = $_POST['Apellidos'];
      $newEmail = $_POST['Email'];
      $newTelefono = $_POST['Telefono'];
      $newDireccion = $_POST['Direccion'];
      $newCodigo_postal = $_POST['Codigo_postal'];

      $editarCliente = "UPDATE CLIENTE SET Nombre = '$newNombre', Apellidos = '$newApellidos', Telefono = '$newTelefono', Email = '$newEmail', Telefono = '$newTelefono',Direccion = '$newDireccion', Codigo_postal = '$newCodigo_postal' WHERE DNI = '$dni'";

      if(mysqli_query($db, $editarCliente)){
        echo "Updated Successfully!";
        ?>
        <a href="cliente.php?">return</a>
        <?php
    } else{
        echo "ERROR: Could not able to execute $editarCliente. " . mysqli_error($db);
    }
    }
  } else{
    echo "ERROR: Could not able to execute $mostrarCliente. " . mysqli_error($db);
  }
}

# Editar Productos

if (isset($display_productos) && ($display_productos == TRUE)) {
  $id = $_GET['id'];
  $mostrarProductos = "SELECT * FROM PRODUCTOS WHERE ID_Producto = '$id'";
  $query = mysqli_query($db,$mostrarProductos);
  if(mysqli_query($db, $mostrarProductos)){
    while($data = mysqli_fetch_array($query)) {
  ?>
  <table class = "styled-table">
  <h1>Edit</h1>
  <tr>
    <th>ID_Producto</th>
    <th>Nombre</th>
    <th>Familia</th>
    <th>Descripcion</th>
    <th>Dimensiones</th>
    <th>Peso</th>
    <th>PVP</th>
    <th>Image</th>
    <th>Stock</th>
    <th></th>
    </tr>

  <form method="POST">
   <td><input type="text" name = "Nombre" value="<?php echo $data['Nombre'];?>"></td>
   <td><input type="text" name = "Familia" value="<?php echo $data['Familia'];?>"></td>
   <td><input type="text" name = "Descripcion" value="<?php echo $data['Descripcion'];?>"></td>
   <td><input type="text" name = "Dimensiones" value="<?php echo $data['Dimensiones'];?>"></td>
   <td><input type="text" name = "Peso" value="<?php echo $data['Peso'];?>"></td>
   <td><input type="text" name = "PVP" value="<?php echo $data['PVP'];?>"></td>
   <td><input type="text" name = "Image" value="<?php echo $data['Image'];?>"></td>
   <td><input type="text" name = "Stock" value="<?php echo $data['Stock'];?>"></td>
   <td><input type="submit" name="update" value="Update">
  </form>
    </table>
    <a class ="return" href="productos.php">Return</a>
  <?php
    }

    if(isset($_POST['update'])) {
      $newNombre = $_POST['Nombre'];
      $newFamilia = $_POST['Familia'];
      $newDescripcion = $_POST['Descripcion'];
      $newDimensiones = $_POST['Dimensiones'];
      $newPeso = $_POST['Peso'];
      $newPVP = $_POST['PVP'];
      $newImage = $_POST['Image'];
      $newStock = $_POST['Stock'];

      $editarProducto = "UPDATE PRODUCTOS SET Nombre = '$newNombre', Familia = '$newFamilia', Descripcion = '$newDescripcion', Dimensiones = '$newDimensiones', Peso = '$newPeso', PVP = '$newPVP', Image = '$newImage', Stock = '$newStock' WHERE ID_Producto = '$id'";

      if(mysqli_query($db, $editarProducto)){
        echo "Updated Successfully!";
        ?>
        <a href="productos.php?">return</a>
        <?php
    } else{
        echo "ERROR: Could not able to execute $editarProducto. " . mysqli_error($db);
    }
    }
  } else{
    echo "ERROR: Could not able to execute $mostrarProductos. " . mysqli_error($db);
  }
}


if (isset($display_compras) && ($display_compras == TRUE)) {
  $id = $_GET['id'];
  $mostrarCompras = "SELECT * FROM COMPRA WHERE ID_Compra = '$id'";
  $query = mysqli_query($db,$mostrarCompras);
  if(mysqli_query($db, $mostrarCompras)){
    while($data = mysqli_fetch_array($query)) {
  ?>
  <table class = "styled-table">
  <h1>Edit</h1>
  <tr>
    <th>ID_Compra</th>
    <th>DNI_Cliente</th>
    <th>ID_Producto</th>
    <th>Cantidad</th>
    <th></th>
    </tr>
  <form method="POST">
    <td><input type="text" name = "ID_Compra" value="<?php echo $data['ID_Compra'];?>"></td>
    <td><input type="text" name = "CLIENTE_DNI" value="<?php echo $data['CLIENTE_DNI'];?>"></td>
    <td><input type="text" name = "PRODUCTOS_ID_Producto" value="<?php echo $data['PRODUCTOS_ID_Producto'];?>"></td>
    <td><input type="text" name = "Cantidad" value="<?php echo $data['Cantidad'];?>"></td>
    <td><input type="submit" name="update" value="Update"></td>
  </form>
    </table>
    <a class ="return" href="productos.php">Return</a>
  <?php
    }

    if(isset($_POST['update'])) {
      $newCliente_DNI = $_POST['CLIENTE_DNI'];
      $newPRODUCTOS_ID_Producto = $_POST['PRODUCTOS_ID_Producto'];
      $newCantidad = $_POST['Cantidad'];
      $editarCompra = "UPDATE COMPRA SET CLIENTE_DNI = '$newCliente_DNI', PRODUCTOS_ID_Producto = '$newPRODUCTOS_ID_Producto', Cantidad = '$newCantidad' WHERE ID_Compra = '$id'";

      if(mysqli_query($db, $editarCompra)){
        echo "Updated Successfully!";
        ?>
        <a href="compras.php?">return</a>
        <?php
    } else{
        echo "ERROR: Could not able to execute $editarCompra. " . mysqli_error($db);
    }
    }
  } else{
    echo "ERROR: Could not able to execute $mostrarCompra. " . mysqli_error($db);
  }
}

?>  


</body>
<?php
mysqli_close($db);
?>
</html>