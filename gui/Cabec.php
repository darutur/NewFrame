<html>
    <head>
        <meta charset="utf-8">
        <title>Desenv - Restaurante</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../../estilos/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="../../estilos/style/style.css" rel="stylesheet" type="text/css" id="bootstrap-css"/>
        <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="../../estilos/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../estilos/js/paging.js"></script>
        <script src="../../estilos/js/jsSite.js"></script>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-twitch" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <span class="navbar-twitch-toggle nav-open small-nav"> <span class="logo"><img src="../../estilos/img/logo.png"></span> </span>
                        <span class="navbar-twitch-toggle nav-close"><span class="full-nav"><img src="../../estilos/img/logo_untech.png"></span></span>
                    </a>
                </div>
                <div class="">
                    <ul class="nav navbar-nav">
                <?php 
                                    
                    //pegando os direitors do usuário
                    $dd = new DaoDireito();
                    $direitoUsu = $dd->listarPorId($_SESSION['direitoUsu']);
                    
                    $direitoUsu instanceof Direito;

                    if ($direitoUsu->getDAtend() == 1) {
                      echo '<li>
                                <a href="' . URL . 'controle-atendimento/home">
                                    <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Atendimento"> 
                                        <span class="glyphicon glyphicon-glass"></span> 
                                    </span>
                                    <span class="full-nav"> Atendimento </span>
                                </a>
                            </li>';
                    }
                    
                    if ($direitoUsu->getDCateg() == 1) {
                      echo '<li>
                                <a href="' . URL . 'controle-categ-prod/lista">
                                    <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Categorias"> 
                                        <span class="glyphicon glyphicon-tag"></span> 
                                    </span>
                                    <span class="full-nav"> Categorias </span>
                                </a>
                            </li>';
                    }
                    
                    if ($direitoUsu->getDProd() == 1) {
                      echo '<li>
                                <a href="' . URL . 'controle-produto/lista"">
                                    <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Produtos"> 
                                        <span class="glyphicon glyphicon-cutlery"></span> 
                                    </span>
                                    <span class="full-nav"> Produtos </span>
                                </a>
                            </li>';
                    }
                    
                    if ($direitoUsu->getDMesa() == 1) {
                      echo '<li>
                                <a href="' . URL . 'controle-mesa/lista">
                                    <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Mesas"> 
                                        <span class="glyphicon glyphicon-stop"></span> 
                                    </span>
                                    <span class="full-nav"> Mesas </span>
                                </a>
                            </li>';
                    }
                    if ($direitoUsu->getDECtr() == 1 || $direitoUsu->getDEList() == 1) {
                      echo '<li>
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Estoque"> 
                                        <span class="glyphicon glyphicon-th-large"></span> 
                                    </span>
                                    <span class="full-nav"> Estoque <span class="caret"></span></span>
                                </a>
                            </li>';
                      echo '<div id="collapseTwo" class="panel-collapse collapse nav navbar-nav menu-sub" role="tabpanel" aria-labelledby="headingTwo">';
                        if ($direitoUsu->getDECtr() == 1) {
                            echo '<li>
                                    <a href="' . URL . 'controle-mercadoria/lista">
                                        <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Controle"> 
                                            <span class="glyphicon glyphicon-shopping-cart"></span> 
                                        </span>
                                        <span class="full-nav menu-esq"> Controle </span>
                                    </a>
                                </li>';
                        }
                        if ($direitoUsu->getDEList() == 1) {
                            echo '<li>
                                    <a href="' . URL . 'controle-estoque/lista">
                                        <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Lista de Produtos"> 
                                            <span class="glyphicon glyphicon-th-list"></span> 
                                        </span>
                                        <span class="full-nav menu-esq"> Lista de Produtos </span>
                                    </a>
                                </li>';
                        }
                      echo '</div>';
                    }
                    if ($direitoUsu->getDUsu() == 1) {
                      echo '<li>
                                <a href="' . URL . 'controle-usuario/lista">
                                    <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Usuários"> 
                                        <span class="glyphicon glyphicon-user"></span> 
                                    </span>
                                    <span class="full-nav"> Usuários </span>
                                </a>
                            </li>';
                    }
                    if ($direitoUsu->getDEst() == 1) {
                      echo '<li>
                                <a href="#">
                                    <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Estatísticas"> 
                                        <span class="glyphicon glyphicon-object-align-bottom"></span> 
                                    </span>
                                    <span class="full-nav"> Estatísticas </span>
                                </a>
                            </li>';
                    }
                    if ($direitoUsu->getDConf() == 1) {
                      echo '<li>
                                <a href="' . URL . 'controle-configuracao/lista">
                                    <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Configurações"> 
                                        <span class="glyphicon glyphicon-cog"></span> 
                                    </span>
                                    <span class="full-nav"> Configurações </span>
                                </a>
                            </li>';
                    }
                    if ($_SESSION['idUsuario'] == 1) {
                      echo '<li>
                                <a href="' . URL . 'controle-direito/lista">
                                    <span class="small-nav" data-toggle="tooltip" data-placement="right" title="" data-original-title="Direitos"> 
                                        <span class="glyphicon glyphicon-lock"></span> 
                                    </span>
                                    <span class="full-nav"> Direitos </span>
                                </a>
                            </li>';
                    }
                    ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="cabec_site">
            <p class="pull-right">
                <a href="<?php echo URL; ?>login/logout">
                    <span class="glyphicon glyphicon-remove-circle sair"></span>
                </a>
            </p>
            <p class="area_logo pull-right">

                Seja bem vindo!
                <br/>
                <?php
                echo $_SESSION["usuario"];
                ?>
            </p>
            <p class="area_logo pull-right"><img src="../../estilos/img/user_photo.png" class="img_logo" ></p>
            
        </div>
        <div class="container-fluid">