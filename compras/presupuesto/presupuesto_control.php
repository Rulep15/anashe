<?php

require '../../conexion.php';
session_start();

$operacion = $_REQUEST['voperacion'];
$codigo = $_REQUEST['vcodigo'];
$proveedor = $_REQUEST['vproveedor'];
$pedido = $_REQUEST['vpedido'];
$usuario = $_REQUEST['vusuario'];
$fecha = $_REQUEST['vfecha'];
$validez = $_REQUEST['vvalidez'];
$descripcion = $_REQUEST['vdescripcion'];


$sql = "SELECT sp_presupuesto(" . $operacion . "," . 
        (!empty($codigo) ? $codigo : 0) . "," .
        (!empty($proveedor) ? $proveedor : 0) . "," .
        (!empty($pedido) ? $pedido : 0) . "," .
        (!empty($usuario) ? $usuario : 0) . ",'" .
        (!empty($descripcion) ? $descripcion : "vacio") . "','" .
        (!empty($validez) ? $validez : '01-01-0001') . "','" .
        (!empty($fecha) ? $fecha : '01-01-0001') . "') AS presupuesto;";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['presupuesto'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['presupuesto'];
    header("location:presupuesto_index.php");
} else {
    $_SESSION['mensaje'] = 'Error:' . $sql;
    header("location:presupuesto_index.php");
}
