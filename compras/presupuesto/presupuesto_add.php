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
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-plus"></i>
                                    <h3 class="box-title">Registrar Presupuesto</h3>
                                    <div class="box-tools">
                                        <a href="presupuesto_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="presupuesto_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class=row">
                                            <input type="hidden" name="voperacion"  value="1">
                                            <input type="hidden" name="vcodigo" value="0"/> 

                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Proveedor</label>
                                                <div class="col-lg-5 col-sm-4 col-xs-4">
                                                    <!--                                                    <div class="input-group">-->
                                                    <?php $razon = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY prv_cod"); ?>
                                                    <select class="form-control" name="vproveedor" required="" >
                                                        <?php
                                                        if (!empty($razon)) {
                                                            foreach ($razon as $r) {
                                                                ?>
                                                                <option value="<?php echo $r['prv_cod']; ?>"><?php echo $r['prv_razon_social']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe seleccionar al menos un proveedor</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Pedido</label>
                                                <div class="col-lg-5 col-sm-4 col-xs-4">
                                                    <!--                                                    <div class="input-group">-->
                                                    <?php $sucur = consultas::get_datos("SELECT * FROM compras_pedidos WHERE estado = 'CONFIRMADO'"); ?>
                                                    <select class="form-control" name="vpedido" required="" >
                                                        <?php
                                                        if (!empty($sucur)) {
                                                            foreach ($sucur as $m) {
                                                                ?>
                                                                <option value="<?php echo $m['id_pedido']; ?>"><?php echo $m['id_pedido'] . ' ' . $m['descri'] . ' ' . $m['fechac']; ?></option>
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
                                            <input type="hidden" name="vusuario" class="form-control"  required="" value="<?php echo $_SESSION['usu_cod']; ?>">

                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                                <div class="col-lg-5 col-sm-4 col-xs-4">
                                                    <input type="date" name="vfecha" class="form-control" readonly="" value="<?php echo date("Y-m-d"); ?>" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Validez</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="date" name="vvalidez"value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Descripcion</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" name="vdescripcion" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer" style="text-align: right;">
                                        <button class="fa fa-save btn btn-success" type="submit"> Registrar</button>
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
    <script>
        /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });
        //LETRAS
        function soloLetras(e)
        {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toString();
            letras = "ABCDEFGHIJKLMNÃ‘OPQRSTUVWXYZÃ�Ã‰Ã�Ã“ÃšabcdefghijklmnÃ±opqrstuvwxyzÃ¡Ã©Ã­Ã³Ãº";

            especiales = [8, 13, 32];
            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial)
            {
                //alert("Ingresar solo letras");
                return false;
            }
        }
    </script>
</HTML>
