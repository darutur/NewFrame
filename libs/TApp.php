<?php

/**
 * Description of TApp
 *
 * @author Eduardo
 */
class TApp {

    private $to;
    private $metodo;
    private $params;

    public function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : false;
        $url = rtrim($url, "/");
        if ($url) {

            // cadasrto-de-pessoas / listar-por-codigo / 10
            $arr = explode('/', $url);
            if (isset($arr[0])) {
                //transformar tudo em minusculo
                $to = strtolower($arr[0]);
                $to = explode('-', $to);
                $strTo = '';

                foreach ($to as $k => $v) {
                    $strTo .= strtoupper(substr($v, 0, 1)) . substr($v, 1);
                }
                $this->to = $strTo;
            }

            if (isset($arr[1])) {
                //transformar tudo em minusculo
                $mt = strtolower($arr[1]);
                $mt = explode('-', $mt);
                $strMt = '';

                foreach ($mt as $k => $v) {
                    if ($k == 0) {
                        $strMt .= $v;
                    } else {
                        $strMt .= strtoupper(substr($v, 0, 1)) . substr($v, 1);
                    }
                }
                $this->metodo = $strMt;
            }

            unset($arr[0]);
            unset($arr[1]);

            $this->params = $arr;
        } else {
            //primeira página inicial depois que logar
            $this->to = 'ControleUsuario';
            $this->metodo = 'autenticar';
            $this->params = null;
        }
    }

    public function executar() {


        if (class_exists($this->to)) {
            try {
                $c = new $this->to();

                // A classe IPrivateTO é responsável por informar quem
                // está logado ou não
                if ($c instanceof IPrivateTO) {
                    session_start();
                    $sessao = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : FALSE;
                    if (!$sessao || trim($sessao) == "") {
                        //página de login quando não está logado
                        header("location: " . URL . "login/access");
                    }
                }
                if (method_exists($c, $this->metodo)) {
                    if ($this->params != NULL) {
                        $c->{$this->metodo}($this->params);
                    } else {
                        $c->{$this->metodo}();
                    }
                } else {
                    //tratar erro
                }
            } catch (Exception $ex) {
                echo $ex->getTraceAsString();
            }
        } else {
            // tratar erro
            echo "<img src='" . URL . "site/img/erro-404.jpg' />";
        }
    }

}
