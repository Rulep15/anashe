<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['operacion'];
$producto = $_REQUEST['vproducto'];
$deposito = $_REQUEST['vdeposito'];
$cantidad = $_REQUEST['vcantidad'];

$sql = "SELECT sp_ref_stock(" . $operacion . "," .
        (!empty($producto) ? $producto : 0) . "," .
        (!empty($deposito) ? $deposito : 0) . "," .
        (!empty($cantidad) ? $cantidad : "VACIO") . ") AS stock;";
$resultado = consultas::get_datos($sql);


if ($resultado[0]['stock'] != NULL) {
    $valor = explode("*" , $resultado[0]['stock']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:". $valor[1].".php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:stock_index.php");
}
?>

