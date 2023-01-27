<?php session_start(); ?>
<!DOCTYPE>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=devicewidht, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>

<?php
include './conexion.php';
require './estilos/css_lte.ctp';
?>

<body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper" style="background-color: #1E282C;" >
        <?php require './estilos/cabecera.ctp'; ?>
        <?php require './estilos/izquierda.ctp'; ?>
        <div class="content-wrapper" style="background-color: black;">
            <section class="content-header">
                <section class="content">
                    <h3 style="color: red;">
                        Bienvenido al Sistema <?php echo '- ' . $_SESSION['nombres']; ?>
                        <br>        
                        <img src="./img/sistema/anashe.png" style="width: 200px; height: 200px;" >
                    </h3>                                  
                    
                </section>
            </section>
        </div>
    </div>
    <?php require './estilos/pie.ctp'; ?>
</body>
<?php require './estilos/js_lte.ctp'; ?>

</html>