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
    <script>
        function soloLetras(e) {
            var key = e.keyCode || e.which,
                    tecla = String.fromCharCode(key).toLowerCase(),
                    letras = " Ã¡Ã©Ã­Ã³ÃºabcdefghijklmnÃ±opqrstuvwxyz0123456789",
                    especiales = [8],
                    tecla_especial = false;

            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
    </script>
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
                                    <h3 class="box-title">Registrar Orden de Compra</h3>
                                    <div class="box-tools">
                                        <a href="orden_compra_index.php" class="btn btn-danger pull-right btn-sm">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                </div>
                                <form action="orden_compra_control.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                    <div class="box-body">
                                        <div class=row">
                                            <input type="hidden" name="voperacion"  value="1">
                                            <input type="hidden" name="vestado" value="ACTIVO"> 
                                           <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">N° de Orden</label>
                                                <?php $cp = consultas::get_datos("SELECT COALESCE(MAX(nro_orden),0)+1 AS ultimo FROM orden_de_compra;") ?>
                                                <div class="col-xs-8 col-sm-4 col-xs-4 ">
                                                    <input class="form-control" type="text" name="vidorden" readonly="" value="<?php echo $cp[0]['ultimo']; ?>" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Fecha</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input class="form-control" type="text" name="vfecha" readonly="" value="<?php echo date("d-m-Y"); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Usuario</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <input type="hidden" name="vusuario" value="<?php echo $_SESSION['usu_cod']; ?>">
                                                    <input class="form-control" type="text" name="vusunick" readonly="" value="<?php echo $_SESSION['usu_nick']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" id="prov" >
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Proveedor</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM ref_proveedor ORDER BY prv_cod"); ?>
                                                    <select class="form-control"  name="vproveedor" id="idprov" required="" >
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option value="<?php echo $m['prv_cod']; ?>"><?php echo $m['prv_razon_social']; ?></option>
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
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2"></label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                  

                                                    <label id="two">         
                                                        <input  type="checkbox" style="margin-top: 15px" onchange="tiposelect()" onclick="tiposelect()" name="presupuesto" value="presupuesto" id="pres"/>Presupuesto
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group" style="display: none" id="presu" >
                                                <label class="control-label  col-lg-3 col-sm-2 col-xs-2">Presupuesto</label>
                                                <div class="col-lg-4 col-sm-4 col-xs-4">
                                                    <?php $marcas = consultas::get_datos("SELECT * FROM v_presupuesto WHERE estado = 'CONFIRMADO' ORDER BY prv_cod "); ?>
                                                    <select class="form-control"  name="vidpresupuesto" id="presupuesto" required="" onchange="obtenerpresu()" onclick="obtenerpresu()" >
                                                        <option id="valor" value="0"></option>
                                                        <?php
                                                        if (!empty($marcas)) {
                                                            foreach ($marcas as $m) {
                                                                ?>
                                                                <option value="<?php echo $m['id_presu']; ?>"><?php echo $m['prv_razon_social']; ?><?php echo ' - '; ?><?php echo $m['fecha']; ?><?php echo '  '; ?><?php echo $m['descri']; ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <option value="">Debe confirmar al menos un presupuesto</option>             
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="box-body" id="presu_detalle">
                                                <div class="col-lg-12 col-md-12 col-xs-12">
                                                    <div class="box-header" style="text-align: center;">
                                                        <h3>Detalles Presupuesto </h3>
                                                    </div>
                                                    <div id="presup">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="box-footer" >
                                        <button class="fa fa-save btn btn-success pull-right" type="submit"> Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require '../../estilos/pie.ctp'; ?>
    </body>
    <?php require '../../estilos/js_lte.ctp'; ?>
    <script>
        /*MENSAJE DE INSERT MARCAS, TIPO,. ETC*/
        $("#mensaje").delay(1000).slideUp(200, function () {
            $(this).alert('close');
        });

        function tiposelect() {
             if (document.getElementById('pres').checked) {
                divp = document.getElementById('prov');
                $("#valor").val('0');


                divp.style.display = 'none';

                div4 = document.getElementById('presu');
                div4.style.display = '';

                //DETALLE PRESUPUESTO
                detalle = document.getElementById('presu_detalle');
                detalle.style.display = '';

            } else {
                divp = document.getElementById('prov');
                divp.style.display = '';
                $("#presupuesto").val('0');


                divtwo = document.getElementById('two');
                divtwo.style.display = '';

                div4 = document.getElementById('presu');
                div4.style.display = 'none';

                //DETALLES PRESUPUESTO
                detalle = document.getElementById('presu_detalle');
                detalle.style.display = 'none';
              

            }
        }
        window.onload = tiposelect();

        function obtenerpresu() {
            var dat = $('#presupuesto').val().split("_");
            if (parseInt($('#presupuesto').val()) > 0) {
                $.ajax({
                    type: "GET",
                    url: "/anashe/compras/orden_compra/orden_compra_presu.php?vidpedido=" + dat[0], cache: false,
                    beforeSend: function () {
                    },
                    success: function (msg) {
                        $('#presup').html(msg);


                    }
                });
            }
        }

       
    </script>
</html>