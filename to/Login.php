<?php
//não retirar esta linha
date_default_timezone_set("Brazil/East");
/**
 * Description of Login
 *
 * @author Eduardo
 */
class Login {

    public function autenticar() {
        $v = new TGui("formularioDeLogin");
        $v->renderizarLogin();
    }

    public function confirmarAutenticacao() {
        $login = isset($_POST['login']) ? $_POST['login'] : FALSE;
        $senha = isset($_POST['password']) ? $_POST['password'] : FALSE;

        if (!$login || !$senha) {
            echo "login ou senha incorreto";
            return false;
        }

        $du = new DaoUsuario();
        $ret = $du->autenticar($login, $senha);

        if ($ret || trim($ret) != "") {
            $usu = $du->listarPorId($ret);
            $idUsuario = $usu->getIdUsuario();
            $nome = $usu->getNome();
            $idCategUsu = $usu->getIdCategUsu();
            $idDirUsu = $usu->getIdDireito();
            session_start();
            $_SESSION['idUsuario'] = $idUsuario;
            $_SESSION['usuario'] = $nome;
            $_SESSION['categoriaUsu'] = $idCategUsu;
            $_SESSION['direitoUsu'] = $idDirUsu;
            header("location: " . URL);
        } else {
            session_start();
            session_destroy();
            header("location: " . URL);
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("location: " . URL);
    }

}
