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
        <div class="wrapper" style="background-color: #1E282C">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color:black">
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
                            <h3 style="color: red" >Nota Remision - Detalle</h3>
                            <!--CABECERA-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Cabecera</h3>
                                    <?php
                                    $idpedido = $_REQUEST['vidnota'];
                                    $confirmar = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_remision = $idpedido");
                                    if (!empty($confirmar)) {
                                        ?>
                                        <?php foreach ($confirmar AS $con) { ?>
                                        <?php } ?>
                                        <?php if ($con['estado'] == 'ACTIVO') { ?>
                                            <a style="padding: 10px; margin: 1px"  data-toggle="modal" data-target="#confirmar"
                                               onclick="registrar_permisos(<?php echo "'" . $_REQUEST['vidnota'] . "'" ?>);"
                                               class="btn btn-toolbar btn-lg" role="button" rel="tooltip"  data-title="Confirmar" rel="tooltip" data-placement="top">
                                                <span style="color: green" class="glyphicon glyphicon-ok-sign"></span>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                    <div class="box-tools">
                                        <a href="nota_remision_index.php" class="btn btn-toolbar pull-right">
                                            <i style="color: #465F62" class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <?php
                                            $idpedido = $_REQUEST['vidnota'];
                                            $pedidosc = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_remision = $idpedido ");
                                            if (!empty($pedidosc)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N°</th>
                                                                <th class="text-center">Suc Destino</th>
                                                                <th class="text-center">Conductor</th>
                                                                <th class="text-center">Vehiculo</th>
                                                                <th class="text-center">Estado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($pedidosc as $pc) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $pc['id_remision']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['suc_destino']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['nombres']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['auto']; ?></td>
                                                                    <td class="text-center"> <?php echo $pc['estado']; ?></td>
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
                            <!--DETALLE-->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Detalles Items</h3>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <?php
                                        $idpedido = $_REQUEST['vidnota'];
                                        $pedidoscdetalle = consultas::get_datos("SELECT * FROM v_detalle_remision WHERE id_remision=$idpedido");
                                        if (!empty($pedidoscdetalle)) {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Producto</th>
                                                            <th class="text-center">Deposito</th>
                                                            <th class="text-center">Cantidad</th>
                                                            <th class="text-center">Deposito Destino</th>
                                                            <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                                <th class="text-center">Acciones</th>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pedidoscdetalle as $pcd) { ?>
                                                            <tr>
                                                                <td class="text-center"> <?php echo $pcd['pro_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['dep_descri']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['cantidad']; ?></td>
                                                                <td class="text-center"> <?php echo $pcd['dep_destino']; ?></td>
                                                                <td class="text-center">
                                                                    <?php if ($pc['estado'] == 'ACTIVO') { ?>                                                
                                                                        <a onclick="quitar(<?php echo "'". $pcd['id_remision'] . "_" . $pcd['pro_cod'] . "_" . $pcd['id_depo'] . "'" ?>)" class="btn btn-toolbar " role="button" data-title="Eliminar Detalle" data-placement="top" rel="tooltip" data-toggle="modal" data-target="#quitar">
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
                                                <span class="glyphicon glyphicon-info-sign"></span> La Nota de Debito no tiene detalles...
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $idpedido = $_REQUEST['vidnota'];
                            $detalle_debito = consultas::get_datos("SELECT * FROM v_nota_remision WHERE id_remision= $idpedido");
                            if (!empty($detalle_debito)) {
                                ?>
                                <?php foreach ($detalle_debito AS $det) { ?>
                                <?php } ?>
                                <?php if ($det['estado'] == 'ACTIVO') { ?>
                                    <!--AGREGAR DETALLE-->
                                    <div class="box box-primary" style="width: 550px; height: 350px;margin: 0 auto;">
                                        <div class="box-header">
                                            <i class="ion ion-clipboard"></i>
                                            <h3 class="box-title">Agregar Items</h3>
                                        </div>
                                        <div class="box-body no-padding">
                                            <?php if ($pc['estado'] == 'ACTIVO') { ?>
                                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                                    <form action="nota_remision_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                        <div class="box-body" style="left: 1000px;">
                                                            <input type="hidden" name="voperacion" value="1" />
                                                            <input type="hidden" name="vidnota" value="<?php echo $_REQUEST['vidnota']; ?>" />
                                                            <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">

                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Deposito</label>
                                                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                        <?php $depositos = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_sucursal=" . $_SESSION['id_sucursal']) ?>
                                                                        <input type="hidden" name="vdeposito" readonly="" class="form-control" value="<?php echo $depositos[0]['id_depo']; ?>">
                                                                        <input style="width: 300px" type="text" name="vdepositoinicial1" readonly="" class="form-control" value="<?php echo $depositos[0]['dep_descri']; ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Producto</label>
                                                                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                        <?php $productos = consultas::get_datos("SELECT * FROM ref_producto WHERE pro_cod IN (SELECT pro_cod FROM ref_stock)") ?>
                                                                        <select class="select2" name="vproducto" required="" style="width: 300px;" id="idproducto" onchange="obtenerprecio()" onkeyup="obtenerprecio()" onclick="obtenerprecio()">
                                                                            <option  value="0"></option>    
                                                                            <?php
                                                                            if (!empty($productos)) {
                                                                                foreach ($productos as $producto) {
                                                                                    ?>
                                                                                    <option value="<?php echo $producto['pro_cod']; ?>"><?php echo $producto['pro_descri']; ?></option>
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
                                                                        <input type="number" name="vcantidad" class="form-control" required="" max="500" min="1" value="1" style="width: 300px;" id="idcantidad" onchange="calsubtotal()" onkeydown="calsubtotal()">
                                                                    </div>
                                                                </div>
                                                                <label class="control-label col-lg-6 col-sm-6 col-md-6 col-xs-6">Dep Destino</label>
                                                                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                                                                    <?php $depositos = consultas::get_datos("SELECT * FROM ref_deposito WHERE id_sucursal!=" . $_SESSION['id_sucursal']) ?>
                                                                    <select class="select2" name="vdepodestino" required="" style="width: 300px;">
                                                                        <OPTION value="0" ></OPTION>
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
                                                        </div>
                                                        <div class="">
                                                            <button type="submit" class="btn btn-success center-block">
                                                                <span class="glyphicon glyphicon-plus"></span> Agregar
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <!--AGREGAR DETALLE-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- registrar-->
            <div id="confirmar" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" id="detalles_registrar">

                    </div>
                </div>
            </div>
            <!-- registrar-->
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
        })
        function quitar(datos) {
            var dat = datos.split("_");
            $('#si').attr('href', 'nota_remision_detalle_control.php?vidnota=' + dat[0] + '&vproducto=' + dat[1] + '&vdeposito=' + dat[2] + '&voperacion=2');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> Desea quitar el Articulo del detalle <i><strong>' + dat[1] + '</strong></i>?');
        }
        function obtenerprecio() {
            var dat = $('#idproducto').val().split("_");
            if (parseInt($('#idproducto').val()) > 0) {
                $.ajax({
                    type: "GET",
                    url: "/T.A/compras/pedido/listar_precios.php?vidproducto=" + dat[0],
                    cache: false,
                    beforeSend: function () {
                        $('#precio').html('<img src="/T.A/img/sistema/ajax-loader.gif">\n\ <strong><i>Cargando...');
                    },
                    success: function (msg) {
                        $('#precio').html(msg);
                        calsubtotal();
                    }
                });
            }
        }
        function registrar_permisos(datos) {
            var dat = datos.split("_");
            $.ajax({
                type: "GET",
                url: "/T.A/compras/nota_remision/nota_remision_confirmar.php?vidnota=" + dat[0],
                beforeSend: function () {
                    $('#detalles_registrar').html();
                },
                success: function (msg) {
                    $('#detalles_registrar').html(msg);
                }
            });
        }
    </SCRIPT>

</HTML>