<header class="main-header">   
    <a href="#" class="logo">
        <span class="logo-mini"><b>Anashe</b></span>
        <span class="logo-lg">Anashe</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Menu emergente derecho --> 
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/anashe/img/sistema/hackerr.jpeg"<?php
                        if (!empty($_SESSION['usu_foto'])) {
                            echo $_SESSION['usu_foto'];
                        } else {
                            echo "/anashe/img/sistema/hackerr.jpeg";
                        }
                        ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $_SESSION['usu_nick']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="/anashe/img/sistema/hackerr.jpeg"<?php
                            if (!empty($_SESSION['usu_foto'])) {
                                echo $_SESSION['usu_foto'];
                            } else {
                                echo "/anashe/img/sistema/hackerr.jpeg";
                            }
                            ?> 
                                 class="img-circle" alt="User Image">
                            <p>
                                <small> <b> CARGO: </b> 
                                    <?php
                                    if (!empty($_SESSION['gru_cod'])) {
                                        echo $_SESSION['gru_nombre'];
                                    } else {
                                        echo "ERROR 69, CONTACTE AL 911";
                                    }
                                    ?>
                                </small>

                                <small><b>SUCURSAL: </b>
                                    <?php
                                    if (!empty($_SESSION['sucur_descri'])) {
                                        echo $_SESSION['sucur_descri'];
                                    } else {
                                        echo "CENTRAL";
                                    }
                                    ?>
                                </small>
                            </p>
                        </li>
                        <!-- acciones dentro del menu emergente-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/anashe/ayuda/manual_anashe.pdf" target="_blank"class="btn btn-default" style="color:blue;"> Ayuda </a>
                            </div>
                            <div class="pull-right">
                                <a href="/anashe" class="btn btn-default" style="color: red;"> Salir </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>