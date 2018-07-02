<?php

/**
 * Description of Login
 *
 * @author Eduardo
 */
class Login {

    public function access() {
        $v = new TGui("formLogin");
        $v->renderizarExterno();
    }

    public function autenticar() {
        $login = isset($_POST['user']) ? $_POST['user'] : FALSE;
        $senha = isset($_POST['password']) ? $_POST['password'] : FALSE;

        $du = new Usuario();
        $du->setLogin($login);
        $ret = $du->listarPorLogin();

        echo '<pre>';
        print_r($ret);
        echo '</pre>';

        if (empty($ret)) {
            session_start();
            session_destroy();
            header("location: " . URL);
        } else {
            if ($ret->getSenha() == $senha) {
                $idUsuario = $ret->getIdUsuario();
                $nome = $ret->getLogin();
                session_start();
                $_SESSION['idUsuario'] = $idUsuario;
                $_SESSION['usuario'] = $nome;
                header("location: " . URL);
            } else {
                session_start();
                session_destroy();
                header("location: " . URL);
            }
        }
//        if ($ret || trim($ret) != "") {
//            $usu = $du->listarPorId($ret);
//            $idUsuario = $usu->getIdUsuario();
//            $nome = $usu->getNome();
//            $idCategUsu = $usu->getIdCategUsu();
//            $idDirUsu = $usu->getIdDireito();
//            session_start();
//            $_SESSION['idUsuario'] = $idUsuario;
//            $_SESSION['usuario'] = $nome;
//            $_SESSION['categoriaUsu'] = $idCategUsu;
//            $_SESSION['direitoUsu'] = $idDirUsu;
//            header("location: " . URL);
//        } else {
//            
//        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("location: " . URL);
    }

}
