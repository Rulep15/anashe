<?php session_start(); ?>
<!DOCTYPE>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=devicewidth,initial-scale=1, maximum-scale=1,user-scalable=no" name="viewport">
        <?php
        include '../../conexion.php';
        require '../../estilos/css_lte.ctp';
        ?>
    </head>
    <body class="hold-transition skin-red sidebar-mini">
        <div class="wrapper" style="background-color:#1E282C">
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
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Orden de Compra</h3>
                                    <div class="box-tools">
                                        <a href="orden_compra_add.php" class="btn btn-primary pull-right btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="box-body no-padding">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <form action="orden_compra_index.php" method="POST" accept-charset="UTF-8" class="form-horizontal">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                                            <div class="input-group custom-search-form">
                                                                <input type="search" class="form-control" name="buscar" placeholder="Buscar por codigo o proveedor..." autofocus=""/>
                                                                <span class="input-group-btn">
                                                                    <button type="submit" class="btn btn-primary btn-flat" data-title="Buscar" data-placement="bottom" rel="tooltip">
                                                                        <span class="fa fa-search"></span>
                                                                    </button>
                                                                </span>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </form>
                                            <?php
                                            $valor = '';
                                            if (isset($_REQUEST['buscar'])) {
                                                $valor = $_REQUEST['buscar'];
                                            }
                                            $presupuesto = consultas::get_datos("SELECT * FROM v_orden_de_compra WHERE nro_orden > 0 AND (nro_orden||TRIM(UPPER(prv_razon_social))) LIKE TRIM(UPPER('%" . $valor . "%')) ORDER BY nro_orden");
                                            if (!empty($presupuesto)) {
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table col-lg-12 col-md-12 col-xs-12">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">N° Orden</th>
                                                                <th class="text-center">N° Presupuesto</th>
                                                                <th class="text-center">Proveedor</th>
                                                                <th class="text-center">Fecha</th>
                                                                <th class="text-center">Iva Total</th>
                                                                <th class="text-center">Total</th>
                                                                <th class="text-center">Estado</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($presupuesto AS $p) { ?>
                                                                <tr>
                                                                    <td class="text-center"> <?php echo $p['nro_orden']; ?></td>
                                                                    <?php if ($p['id_presu'] == 0) { ?>
                                                                        <td class="text-center"><?php echo ' '; ?></td>
                                                                    <?php } ?>
                                                                    <?php if ($p['id_presu'] > 0) { ?>
                                                                        <td class="text-center"><?php echo $p['id_presu'];; ?></td>
                                                                    <?php } ?>
                                                                    <td class="text-center"> <?php echo $p['prv_razon_social']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['orden_fecha']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['iva_total']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['orden_total']; ?></td>
                                                                    <td class="text-center"> <?php echo $p['orden_estado']; ?></td>
                                                                    <td class="text-center">  
                                                                      <?php if ($p['orden_estado'] == 'ACTIVO' || $p['orden_estado'] == 'ANULADO' || $p['orden_estado'] == 'CONFIRMADO') { ?>                                              
                                                                            <a href="orden_compra_detalle.php?vidordencompra=<?php echo $p['nro_orden']; ?>" class="btn btn-success btn-sm" role="button" data-title="Detalle" rel="tooltip" data-placement="top">
                                                                                <i class="fa fa-list"></i>
                                                                            </a>
                                                                         <?php } ?>
                                                                        <?php if ($p['orden_estado'] == 'CONFIRMADO') { ?>
                                                                            <a href="orden_compra_anular.php?vidordencompra=<?php echo $p['nro_orden']; ?>" class="btn btn-danger btn-sm" role="button" data-title="Anular" rel="tooltip" data-placement="top">
                                                                                <span class="glyphicon glyphicon-ban-circle"></span>
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
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han encontrado registros...

                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>
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
        $("#mensaje").delay(1000).slideUp(200, function(){
            $(this).alert('close');
        });
        
    </script>
</html>




