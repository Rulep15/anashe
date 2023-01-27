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
        <div class="wrapper" style=" background-color: #1E282C;">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: black;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Confirmar Presupuesto</h3>
                                    <div class="box-tools">
                                        <a href="presupuesto_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="presupuesto_detalle_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_presupuesto WHERE id_presu =" . $_GET['vidpresupuesto']); ?>
                                        <div class="form-group-lg form-group-sm">
                                            <input class="form-control" type="hidden" name="voperacion" value="4">
                                            <div class="form-group">    
                                                <label class="col-lg-2 control-label">N° Presupuesto</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" name="vidpresupuesto" readonly="" value="<?php echo $resultado[0]['id_presu']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">    
                                                <label class="col-lg-2 control-label">Proveedor</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="text" name="vrazon" readonly="" value="<?php echo $resultado[0]['prv_cod']; ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <?php $proveedor = consultas::get_datos("SELECT * FROM compras_pedidos WHERE id_pedido=" . $resultado[0]['id_pedido']); ?>
                                                <label class="col-lg-2 control-label">Pedido</label>
                                                <div class="col-lg-8">
                                                    <input type="hidden" name="vidpedido" value="<?php echo $proveedor[0]['id_pedido']; ?>">
                                                    <input class="form-control" type="text" name="vpedido" readonly="" 
                                                           value="<?php echo $proveedor[0]['id_pedido']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php $usuario = consultas::get_datos("SELECT * FROM ref_usuario WHERE usu_cod=" . $resultado[0]['usu_cod']); ?>
                                                <label class="col-lg-2 control-label">Usuario</label>
                                                <div class="col-lg-8">
                                                    <input type="hidden" name="vusuario" value="<?php echo $usuario[0]['usu_cod']; ?>">

                                                    <input class="form-control" type="text" name="vusuario" readonly="" value="<?php echo $usuario[0]['usu_cod']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Fecha</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="date" name="vfecha" readonly="" value="<?php echo $resultado[0]['fecha']; ?>">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Estado</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="text" name="vestado" readonly="" value="<?php echo $resultado[0]['estado']; ?>">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Validez</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="date" name="vvalidez" readonly="" value="<?php echo $resultado[0]['validez']; ?>">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-4">Total</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-7">
                                                    <input class="form-control" type="number" name="vtotal" readonly="" value="<?php echo $resultado[0]['total']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: right;">
                                        <button class="fa fa-check btn btn-success pull-right" type="submit">Confirmar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </BODY>
    <?php require '../../estilos/js_lte.ctp'; ?>
</HTML>


