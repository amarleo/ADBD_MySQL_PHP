<?php
session_start(); 
require "bbdd.php";
?>
<!DOCTYPE html>
<html>
<head>
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
      echo $display_cliente;
  ?>
  <form method="POST">
    <input type="text" name = "DNI" value="<?php echo $data['DNI'];?>">
    <input type="text" name = "Nombre" value="<?php echo $data['Nombre'];?>">
    <input type="text" name = "Apellidos" value="<?php echo $data['Apellidos'];?>">
    <input type="text" name = "Email" value="<?php echo $data['Email'];?>">
    <input type="text" name = "Telefono" value="<?php echo $data['Telefono'];?>">
    <input type="text" name = "Direccion" value="<?php echo $data['Direccion'];?>">
    <input type="text" name = "Codigo_postal" value="<?php echo $data['Codigo_postal'];?>">
    <input type="submit" name="update" value="Update">
  </form>
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
  <form method="POST">
    <input type="text" name = "Nombre" value="<?php echo $data['Nombre'];?>">
    <input type="text" name = "Familia" value="<?php echo $data['Familia'];?>">
    <input type="text" name = "Descripcion" value="<?php echo $data['Descripcion'];?>">
    <input type="text" name = "Dimensiones" value="<?php echo $data['Dimensiones'];?>">
    <input type="text" name = "Peso" value="<?php echo $data['Peso'];?>">
    <input type="text" name = "PVP" value="<?php echo $data['PVP'];?>">
    <input type="text" name = "Image" value="<?php echo $data['Image'];?>">
    <input type="text" name = "Stock" value="<?php echo $data['Stock'];?>">
    <input type="submit" name="update" value="Update">
  </form>
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
  <form method="POST">
    <input type="text" name = "ID_Compra" value="<?php echo $data['ID_Compra'];?>">
    <input type="text" name = "CLIENTE_DNI" value="<?php echo $data['CLIENTE_DNI'];?>">
    <input type="text" name = "PRODUCTOS_ID_Producto" value="<?php echo $data['PRODUCTOS_ID_Producto'];?>">
    <input type="submit" name="update" value="Update">
  </form>
  <?php
    }

    if(isset($_POST['update'])) {
      $newCliente_DNI = $_POST['CLIENTE_DNI'];
      $newPRODUCTOS_ID_Producto = $_POST['PRODUCTOS_ID_Producto'];

      $editarCompra = "UPDATE COMPRA SET CLIENTE_DNI = '$newCliente_DNI', PRODUCTOS_ID_Producto = '$newPRODUCTOS_ID_Producto' WHERE ID_Compra = '$id'";

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