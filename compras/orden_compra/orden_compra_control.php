<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vidorden'];
$proveedor = $_REQUEST['vproveedor'];
$fecha = $_REQUEST['vfecha'];
$estado = $_REQUEST['vestado'];
$usuario = $_REQUEST['vusuario'];
$presu = $_REQUEST['vidpresupuesto'];
if ($presu != 0 ){
    $presupuesto = $_REQUEST['vidpresupuesto'];
}  else {
    $presupuesto = "NULL";
}



$sql = "SELECT sp_orden_compras(" . $operacion . "," .
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($proveedor) ? $proveedor : 0) . ",'" .
        (!empty($fecha) ? $fecha : "01-01-0001") . "','" .
        (!empty($estado) ? $estado : "VACIO") . "'," .
        (!empty($usuario) ? $usuario : 0) . "," .
        $presupuesto . ") AS orden_compra;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['orden_compra'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['orden_compra'];
    header("location:orden_compra_index.php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:orden_compra_index.php");
}
