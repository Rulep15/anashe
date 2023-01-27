<?php session_start(); ?>
<!DOCTYPE>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <meta content="width=devicewidth, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php
        include '../../conexion.php';
        require '../../estilos/css_lte.ctp';
        ?>
    </HEAD>
    <BODY class="hold-transition skin-red sidebar-mini">
        <div id="wrapper" style="background-color: #1E282C;">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: black;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <!-- MENSAJE -->
                            <?php if (!empty($_SESSION['mensaje'])) { ?>
                                <?php
                                $mensaje = explode("_/_", $_SESSION['mensaje']);
                                if (($mensaje[0] == 'NOTICIA')) {
                                    $class = "success";
                                } else {
                                    $class = "danger";
                                }
                                ?>
                                <div class="alert alert-<?= $class; ?>" role="alert" id="mensaje">
                                    <i class="ion ion-information-circled"></i>
                                    <?php
                                    echo $mensaje[1];
                                    $_SESSION['mensaje'] = '';
                                    ?>
                                </div>
                            <?php } ?>
                            <!-- MENSAJE -->
                            <h3 style=" color: red;">Orden de Compras Detalle</h3>
                            <!--CABECERA-->
                            <div class="box box-primary">
                                <div class="box-header" style=" background-color: #14d1ff;">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title" style=" color: black;">Cabecera</h3>
                                    <a href="orden_compra_confirmar.php?vidordencompra=<?php echo $_REQUEST['vidordencompra'] ?>"
                                       class="btn btn-success btn-sm" role="button"
                                       data-title="Confirmar" rel="tooltip" data-placement="top">
                                        <span class="glyphicon glyphicon-ok-sign"></span>

                                    </a>
                                    <div class="box-tools">                                        
                                        <a href="orden_compra_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>                                     
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $idpedido = $_REQUEST['vidordencompra'];
                                            $pedidosc = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE nro_orden = $idpedido ");
                                            if (!empty($pedidosc)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>
                                                                <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Usuario</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Estado</th> 
                                                                <th class="text-center">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($pedidosc AS $pc) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $pc['nro_orden']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['prv_razon_social']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['usu_nick']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['fecha_orden']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['orden_estado']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['orden_total']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--CABECERA-->
                            <!--DETALLE DE PRESUPUESTO-->
                            <div class="box box-primary">
                                <div class="box-header" style=" background-color: #14d1ff;">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title" style=" color: black;">Detalles de Presupuesto</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idpedido = $_REQUEST['vidordencompra'];
                                        $pedidoscdetalle = consultas::get_datos("SELECT * FROM v_detalle_presupuesto WHERE id_presu = (SELECT id_presu FROM orden_de_compra WHERE nro_orden = $idpedido)");
                                        if (!empty($pedidoscdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Deposito</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Precio</th>
                                                            <th class="text-center">subtotal</th> 
                                                            <?php if ($pc['orden_estado'] == 'ACTIVO') { ?>
                                                            <?php } ?>    
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pedidoscdetalle AS $pcd) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['dep_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['precio_unit']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['subtotal']; ?></td>
                                                                <td class="text-center"> 

                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>                                  
                                        <?php } else { ?>
                                            <div class="alert alert-danger flat">
                                                <span class="glyphicon glyphicon-info-sign"></span> El presupuesto no tiene detalles...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--DETALLE DE PRESUPUESTO-->
                            <!--DETALLE DE ITEMS-->
                            <div class="box box-primary">
                                <div class="box-header" style=" background-color: #14d1ff;">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title" style=" color: black;">Detalle de Items</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idpedido = $_REQUEST['vidordencompra'];
                                        $pedidoscdetalle = consultas::get_datos("SELECT * FROM v_orden_detalle WHERE nro_orden= $idpedido  AND pro_cod NOT IN (SELECT a.pro_cod FROM detalle_presupuesto a, presupuesto b, orden_de_compra c, detalle_orden d WHERE a.id_presu = b.id_presu AND b.id_presu = c.id_presu AND c.nro_orden = d.nro_orden AND c.nro_orden = $idpedido)");
                                        if (!empty($pedidoscdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Deposito</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Precio</th>
                                                            <th class="text-center">subtotal</th> 
                                                            <?php if ($pc['orden_estado'] == 'ACTIVO') { ?>
                                                                <th class="text-center">Acciones</th>
                                                            <?php } ?>    
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pedidoscdetalle AS $pcd) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['dep_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['precioc']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['subtotal']; ?></td>
                                                                <td class="text-center"> 
                                                                    <?php if ($pc['orden_estado'] == 'ACTIVO') { ?>                                                
                                                                        <a onclick="quitar(<?php echo "'" . $pcd['nro_orden'] . "_" . $pcd['pro_cod'] . "_" . $pcd['id_depo'] . "'" ?>)" class="btn btn-toolbar " role="button" data-title="Eliminar Detalle" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#quitar">
                                                                            <span style="color: red;" class="fa fa-trash"></span>
                                                                        </a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>                                  
                                        <?php } else { ?>
                                            <div class="alert alert-danger flat">
                                                <span class="glyphicon glyphicon-info-sign"></span> El presupuesto no tiene detalles...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--DETALLE DE ITEMS-->
                            <?php if ($pc['orden_estado'] == 'ACTIVO') { ?>
                                <!--AGREGAR DETALLE-->
                                <div class="box box-primary" style="width: 550px; height: 300px;margin: 0 auto;">
                                    <div class="box-header">
                                        <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Agregar Items</h3>
                                    </div>
                                    <div class="box-body no-padding">
                                        <?php if ($pc['orden_estado'] == 'ACTIVO') { ?>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                <form action="orden_compra_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                    <div class="box-body" style="left: 1000px;">
                                                        <input type="hidden" name="voperacion" value="1" />
                                                        <input type="hidden" name="vidordencompra" value="<?php echo $_REQUEST['vidordencompra']; ?>" />
                                                        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Deposito</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <?php $depositos = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_sucursal=" . $_SESSION['id_sucursal']) ?>
                                                                    <select class="select2" name="vdeposito" required="" style="width: 300px;">
                                                                        <?php
                                                                        if (!empty($depositos)) {
                                                                            foreach ($depositos as $deposito) {
                                                                                ?>
                                                                                <option value="<?php echo $deposito['id_depo']; ?>"><?php echo $deposito['dep_descri']; ?></option>
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <option value="">Debe insertar registros...</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Producto</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <?php $productos = consultas::get_datos("SELECT * FROM ref_producto WHERE pro_cod IN (SELECT pro_cod FROM ref_stock)") ?>
                                                                    <select class="select2" name="vproducto" required="" style="width: 300px;" id="idproducto" onchange="obtenerprecio()" onkeyup="obtenerprecio()" onclick="obtenerprecio()">
                                                                        <option></option>
                                                                        <?php
                                                                        if (!empty($productos)) {
                                                                            foreach ($productos as $producto) {
                                                                                ?>
                                                                                <option value ="<?php echo $producto['pro_cod']; ?>"><?php echo $producto['pro_descri']; ?></option>
                                                                                <?php
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <option value="">Debe insertar registros...</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Cantidad</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" name="vcantidad" class="form-control" required="" min="0" value="1" style="width: 300px;" id="idcantidad" onchange="calsubtotal()" onkeydown="calsubtotal()">
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="precio">
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Precio</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <input type="number" name="vprecio" class="form-control" required="" min="1000" value="0" style="width: 300px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" class="btn btn-success center-block">
                                                            <span class="glyphicon glyphicon-plus"></span>Agregar
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--AGREGAR DETALLE-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><strong>Modificar Precio</strong></h4>
                            <form action="presupuesto_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                <input name="voperacion" value="1" type="hidden">
                                <input name="vproducto" id="producto" value="<?php echo $pcd['pro_cod']; ?>" type="hidden">
                                <input name="vdeposito" id="deposito" value="<?php echo $pcd['id_depo']; ?>" type="hidden">
                                <input type="hidden" name="vcantidad" id="cantidad" value="<?php echo $pcd['cantidad']; ?>">
                                <input type="hidden" name="vidpresupuesto" id="codigo">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Precio</label>
                                        <div class="col-lg-4 col-sm-4 col-xs-4">
                                            <input class="form-control"  type="number" onkeypress="return soloNUM(event)" name="vprecio" value="<?php echo $pcd['precio_unit']; ?>" min="1000" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" data-dismiss="modal" class="fa fa-close btn btn-danger"> Cerrar</button>
                                    <button type="submit" class="fa fa-refresh btn btn-success pull-right"> Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL DE QUITAR -->
            <div class="modal fade" id="quitar" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" arial-label="Close">X</button>
                            <h4 class="modal-title custom_align" id="Heading">Atencion!!!</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" id="confirmacion"></div>
                        </div>
                        <div class="modal-footer">
                            <a id="si" role="button" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok-sign"></span>Si
                            </a>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span>No
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL DE QUITAR -->
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </BODY>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <SCRIPT>
        $("#mensaje").delay(1500).slideUp(200, function () {
            $(this).alert('close');
        });

        function quitar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href', 'orden_compra_detalle_control.php?vidordencompra=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&voperacion=2');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el Articulo del detalle <i><strong>' + dat[1] + '</strong></i>?');
        }
        function calsubtotal() {
            var precio = parseInt($('#idprecio').val());
            var cant = parseInt($('#idcantidad').val());
            $('#idsubtotal').val(precio * cant);
        }
        function obtenerprecio() {
            var dat = $('#idproducto').val().split("_");
            if (parseInt($('#idproducto').val()) > 0) {
                $.ajax({
                    type: "GET",
                    url: "/anashe/Compras/orden_compra/listar_precios.php?vidproducto=" + dat[0], cache: false,
                    beforeSend: function () {
                        $('#precio').html('<img src="/anashe/img/sistema/ajax-loader.gif">\n\<strong><i>Cargando...</i></strong>');
                    },
                    success: function (msg) {
                        $('#precio').html(msg);
                        calsubtotal();
                    }

                });
            }
        }
        function editar(datos) {
            var dat = datos.split("_"); //ayuda a quitar el guion
            $('#codigo').val(dat[0]);
            $('#producto').val(dat[1]);
            $('#deposito').val(dat[2]);
            $('#cantidad').val(dat[3]);
        }
    </SCRIPT>
</HTML>
