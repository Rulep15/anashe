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
        <div class="wrapper" style=" background-color:#1E282C;">
            <?php require '../../estilos/cabecera.ctp'; ?>
            <?php require '../../estilos/izquierda.ctp'; ?>
            <div class="content-wrapper" style="background-color: black;">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-edit"></i>
                                    <h3 class="box-title">Modificar Presupuesto</h3>
                                    <div class="box-tools">
                                        <a href="presupuesto_index.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="presupuesto_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <?php $resultado = consultas::get_datos("SELECT * FROM v_presupuesto WHERE id_presupuesto =" . $_GET['vidpresupuesto']); ?>
                                        <div class="form-group">
                                            <input type="hidden" name="voperacion"  value="2">
                                            <input type="hidden" name="vcodigo" value="<?php echo $resultado[0]['id_presupuesto']; ?>"/> 
                                            <input class="form-control" type="hidden" name="vfecha" value="<?php echo $resultado[0]['fecha']; ?>"/>
                                            <input class="form-control" type="hidden" name="vestado" value="<?php echo $resultado[0]['estado']; ?>"/>
                                            <input class="form-control" type="hidden" name="vusuario" value="<?php echo $resultado[0]['usu_cod']; ?>"/> 
                                            <input class="form-control" type="hidden" name="vtotal" value="<?php echo $resultado[0]['total']; ?>"/> 
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Validez</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="date" name="vvalidez" required="" value="<?php echo $resultado[0]['validez']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label">Total</label>
                                                <div class="col-lg-8">
                                                    <input class="form-control" type="number" name="vtotal" required="" value="<?php echo $resultado[0]['total']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Razon Social</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $ciudad = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY prv_cod"); ?>
                                                        <select class="select2" name="vrazon" required="" style="width: 320px;">  
                                                            <?php
                                                            if (!empty($ciudad)) {
                                                                foreach ($ciudad as $c) {
                                                                    ?>
                                                                    <option value="<?php echo $c['prv_cod']; ?>"><?php echo $c['prv_razon_social']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos una razon social</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-sm-2 col-xs-2">Pedido</label>
                                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                                    <div class="input-group">
                                                        <?php $tipopersona = consultas::get_datos("SELECT * FROM compras_pedidos ORDER BY id_pedido"); ?>
                                                        <select class="select2" name="vpedido" required="" style="width: 320px;">
                                                            <?php
                                                            if (!empty($tipopersona)) {
                                                                foreach ($tipopersona as $tper) {
                                                                    ?>
                                                                    <option value="<?php echo $tper['id_pedido']; ?>"><?php echo $tper['observacion']; ?></option>
                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <option value="">Debe seleccionar al menos un pedido</option>             
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: center;">
                                        <button class="btn btn-warning" type="submit">Modificar</button>
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