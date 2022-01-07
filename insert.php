<?php
session_start(); 
$db = mysqli_connect('localhost','usuario1','usuario1','proyecto') or die('Error al conectar al servidor MySQL.');
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

# Inserción de cliente
if (isset($display_cliente) && ($display_cliente == TRUE)) {
    $enterDNI = $_REQUEST['enterDNI'];
    $enterNombre = $_REQUEST['enterNombre'];
    $enterApellidos= $_REQUEST['enterApellidos'];
    $enterEmail= $_REQUEST['enterEmail'];
    $enterTelefono= $_REQUEST['enterTelefono'];
    $enterDireccion= $_REQUEST['enterDireccion'];
    $enterCodigo_Postal= $_REQUEST['enterCodigo_Postal'];

    $sql = "INSERT INTO CLIENTE VALUES ('$enterDNI','$enterNombre','$enterApellidos','$enterEmail','$enterTelefono','$enterDireccion','$enterCodigo_Postal', 0)";
    if(mysqli_query($db, $sql)){
        echo "<h3>DNI = '$enterDNI' data stored in a database successfully</h3>"; 
    } else{
        echo "ERROR: Ups! Sorry $sql. " 
            . mysqli_error($db);
    }


?>
<a href="cliente.php">return</a>
<?php
}
# Inserción de Producto

if (isset($display_productos) && $display_productos == TRUE) {
    $enterNombre = $_REQUEST['enterNombre'];
    $enterFamilia= $_REQUEST['enterFamilia'];
    $enterDescripcion= $_REQUEST['enterDescripcion'];
    $enterDimensiones= $_REQUEST['enterDimensiones'];
    $enterPeso= $_REQUEST['enterPeso'];
    $enterPVP= $_REQUEST['enterPVP'];
    $enterImage= $_REQUEST['enterImage'];
    $enterStock= $_REQUEST['enterStock'];
    

    $sql = "INSERT INTO PRODUCTOS (Nombre, Familia, Descripcion, Dimensiones, Peso, PVP, Image, Stock, Borrado) VALUES ('$enterNombre','$enterFamilia','$enterDescripcion','$enterDimensiones','$enterPeso','$enterPVP','$enterImage', '$enterStock', 0)";
    if(mysqli_query($db, $sql)){
        echo "<h3>ID = '$enterID' data stored in a database successfully</h3>";
    } else{
        echo "ERROR: Ups! Sorry $sql. " 
            . mysqli_error($db);
    }
?>
<a href="productos.php">return</a>

<?php
}
# Inserción de Compra
if (isset($display_compras) && $display_compras == TRUE) {
    $enterID = $_REQUEST['enterID'];
    $enterDNI = $_REQUEST['enterDNI'];
    $enterIDPROD= $_REQUEST['enterIDPROD'];

    $sql = "INSERT INTO COMPRA (CLIENTE_DNI, Borrado, PRODUCTOS_ID_Producto) VALUES ('$enterDNI', 0, '$enterIDPROD')";
    if(mysqli_query($db, $sql)){
        echo "<h3>ID = '$enterID' data stored in a database successfully</h3>"; 

    } else{
        echo "ERROR: Ups! Sorry $sql. " 
            . mysqli_error($db);
    }
?>
<a href="compras.php">return</a>
<?php
}
?>

</body>
<?php
mysqli_close($db);
?>
</html>