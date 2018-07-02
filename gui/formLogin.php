<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
        <link href="../site/css/login.css" rel="stylesheet" type="text/css"/>
        <link href="../site/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

        <script src="../site/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="header">
            <div class="login">
                <img src="../site/img/logo.png" alt=""/>
                <br/>
                <span class="nameLogo">Financeiro</span>
                <form action="/login/autenticar" method="post" name="formLogin" id="formLogin">
                    <input type="text" placeholder="usuário" name="user" required=""><br>
                    <input type="password" placeholder="senha" name="password" required=""><br>
                    <input type="submit" value="Entrar">
                </form>

                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="#" name="esqSenha" id="esqSenha" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Informe o seu usuário abaixo:</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-4">
                                    <input type="text" placeholder="usuário" name="esquser" required=""/>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="esqSenha">
                    <a href="#" data-toggle="modal" data-target="#modal">Esqueceu sua senha?</a>
                </div>
            </div>

        </div>

        <script>
            $('#modal').on('shown.bs.modal', function () {
                $('#modal').trigger('focus')
            })
        </script>
    </body>
</html>
