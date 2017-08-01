<?php

/**
 * Description of TGui
 *
 * @author Eduardo
 */
class TGui {

    private $nome;
    private $dados;

    function __construct($nome) {
        $this->nome = $nome;
        $this->dados = array();
    }

    public function renderizar() {
        include_once '../gui/Cabec.php';
        if (file_exists("../gui/" . $this->nome . ".php")) {
            include_once "../gui/" . $this->nome . ".php";
        } else {
            echo "<img src='". URL ."site/img/erro-404.jpg' />";
        }
        include_once './gui/Rodape.php';
    }
    
    public function renderizarLogin() {
        if (file_exists("../gui/" . $this->nome . ".php")) {
            include_once "../gui/" . $this->nome . ".php";
        } else {
            echo "<img src='". URL ."site/img/erro-404.jpg' />";
        }
    }

    function getDados($objeto = false) {
        if (!$objeto) {
            return $this->dados;
        } else {
            return isset($this->dados[$objeto]) ? $this->dados[$objeto] : FALSE;
        }
    }

    function addDados($nome, $dados) {
        $this->dados[$nome] = $dados;
    }

}
