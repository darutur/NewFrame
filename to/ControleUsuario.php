<?php
//não retirar esta linha
date_default_timezone_set("Brazil/East");
/**
 * Description of ControleUsuario
 *
 * @author Eduardo
 */
class ControleUsuario implements IPrivateTO {

    public function lista() {
        $du = new DaoUsuario();
        $pesquisa = isset($_GET['psq']) ? $_GET['psq'] : FALSE;
        if (!$pesquisa || trim($pesquisa) == "") {
            $usuarios = $du->listarTodos();
            $v = new TGui("listaDeUsuarios");
            $v->addDados("usuarios", $usuarios);
            $v->renderizar();
        } else {
            $usuarios = $du->pesquisa($pesquisa);
            $v = new TGui("listaDeUsuarios");
            $v->addDados("usuarios", $usuarios);
            $v->renderizar();
        }
    }

    public function editar($id) {
        $p1 = $id[2];
        $du = new DaoUsuario();
        $usuario = $du->listarPorId($p1);
        $v = new TGui("formularioUsuario");
        $v->addDados("usuario", $usuario);
        $v->renderizar();
    }

    public function novo() {
        $usuario = new Usuario();
        $v = new TGui("formularioUsuario");
        $v->addDados("usuario", $usuario);
        $v->renderizar();
    }

    public function salvar() {
        //Array ( [id] => [nome] => [login] => [senha] => [status] => )
        $usuario = new Usuario();
        $du = new DaoUsuario();

        $codAcesso = isset($_POST['codacesso']) ? $_POST['codacesso'] : FALSE;
        if (!$codAcesso || trim($codAcesso) == "") {
            throw new Exception("O campo Código de acesso é obrigatório.");
        }

        $nome = isset($_POST['nome']) ? $_POST['nome'] : FALSE;
        if (!$nome || trim($nome) == "") {
            throw new Exception("O campo nome é obrigatório.");
        }

        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : FALSE;
        if (!$categoria || trim($categoria) == "") {
            throw new Exception("O campo Categoria é obrigatório.");
        }
        
        $direito = isset($_POST['direito']) ? $_POST['direito'] : FALSE;
        if (!$direito || trim($direito) == "") {
            throw new Exception("O campo Direito é obrigatório.");
        }

        $senha = isset($_POST['senha']) ? $_POST['senha'] : FALSE;
        


        // setando os dados em uma variável usuário
        $usuario->setCodAcesso($codAcesso);
        $usuario->setNome($nome);
        $usuario->setSenha(md5($senha));
        $usuario->setIdCategUsu($categoria);
        $usuario->setIdDireito($direito);

        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
        // se o ID for falso o sistema vai criar um cadastro novo se não vai 
        // alterar
        if (!$id || trim($id) == "") {
            $inserir = $du->incluir($usuario);
            if ($inserir) {
                header("location: " . URL . "controle-usuario/lista");
            }
        } else {
            $usuario->setIdUsuario($id);
            //verificando se a senha está nula, se estiver vou colocar a 
            //senha que já está cadatrada se não será a senha que veio do form
            if (!$senha || trim($senha) == "") {
                $usuBanco = $du->listarPorId($id);
                $senhaUsuBanco = $usuBanco->getSenha();
                $usuario->setSenha($senhaUsuBanco);
            }

            $alterar = $du->alterar($usuario);
            if ($alterar) {
                header('location: ' . URL . 'controle-usuario/lista');
            } else {
                echo 'error';
            }
        }
    }

    public function excluir() {
        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
        if ($id) {
            $du = new DaoUsuario();
            $usuario = $du->listarPorId($id);
            if ($du->excluir($usuario)) {
                header('location: ' . URL . 'controle-usuario/lista');
            } else {
                echo 'Não foi possível excluir o usuário!';
            }
        } else {
            header('location: ' . URL . 'controle-usuario/lista/' . $id);
        }
    }

}
