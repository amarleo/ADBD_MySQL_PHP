<?php
session_start();
$db = mysqli_connect('localhost','usuario1','usuario1','proyecto') or die('Error al conectar al servidor MySQL.');
?>
<!DOCTYPE html>
<html>
<head>
    <title>hola</title>
</head>

<body>

<?php

$display_cliente = $_SESSION['display_cliente'];
$display_productos = $_SESSION['display_productos'];
$display_compras = $_SESSION['display_compras'];



if (isset($display_cliente) && $display_cliente == TRUE) {
    $dni = $_GET['id'];
    $borrarCliente = "UPDATE CLIENTE SET Borrado = 1 WHERE DNI = '$dni'";
    if(mysqli_query($db, $borrarCliente)){
        echo "Deleted successfully DNI = '$dni'";
    } else{
        echo "ERROR: Could not able to execute $borrarCliente. " . mysqli_error($db);
    }
}

if (isset($display_productos) && $display_productos == TRUE) {
    $id = $_GET['id'];
    $borrarProducto = "UPDATE PRODUCTOS SET Borrado = 1 WHERE ID_Producto = '$id'";
    if(mysqli_query($db, $borrarProducto)){
        echo "Deleted successfully ID = '$id'";
    } else{
        echo "ERROR: Could not able to execute $borrarProducto. " . mysqli_error($db);
    }
}

if (isset($display_compras) && $display_compras == TRUE) {
    $id = $_GET['id'];
    $borrarCompra = "UPDATE COMPRA SET Borrado = 1 WHERE ID_Compra = '$id'";
    if(mysqli_query($db, $borrarCompra)){
        echo "Deleted successfully ID = '$id'";
    } else{
        echo "ERROR: Could not able to execute $borrarCompra. " . mysqli_error($db);
    }
}

?>

</body>
<?
mysqli_close($db);
?>
</html>