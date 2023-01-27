<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidordencompra'];
$producto = $_REQUEST['vproducto'];
$deposito = $_REQUEST['vdeposito'];
$cantidad = $_REQUEST['vcantidad'];
$precio = $_REQUEST['vprecio'];

$idpedido = $_REQUEST['vidpedido'];

$sql = "SELECT sp_ordenc_detalle(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($producto) ? $producto : 0) . "," .
        (!empty($deposito) ? $deposito : 0) . "," .
        (!empty($precio) ? $precio : 0) . "," .
        (!empty($cantidad) ? $cantidad : 0) . ") AS orden_compr;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['orden_compr'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['orden_compr'];
    header("location:orden_compra_detalle.php?vidordencompra=" . $_REQUEST['vidordencompra']);
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:orden_compra_detalle.php?vidordencompra=" . $_REQUEST['vidordencompra']);
}
