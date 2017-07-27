<?php

/**
 * Description of Usuario
 *
 * @author Eduardo
 */
class Usuario {
    /**
     *
     * @var int identificador do registro
     */
    private $IdUsuario;
    /**
     *
     * @var string login do usuário
     */
    private $CodAcesso;
    /**
     *
     * @var string nome do usuário
     */
    private $Nome;
    /**
     *
     * @var string senha do usuário
     */
    private $Senha;
    /**
     *
     * @var int id da cetegoria do usuário
     */
    private $IdCategUsu;
    /**
     *
     * @var int id do direito do usuário
     */
    private $IdDireito;

    function getIdUsuario() {
        return $this->IdUsuario;
    }

    function getCodAcesso() {
        return $this->CodAcesso;
    }

    function getNome() {
        return $this->Nome;
    }

    function getSenha() {
        return $this->Senha;
    }

    function getIdCategUsu() {
        return $this->IdCategUsu;
    }

    function getIdDireito() {
        return $this->IdDireito;
    }

    function setIdUsuario($IdUsuario) {
        $this->IdUsuario = $IdUsuario;
    }

    function setCodAcesso($CodAcesso) {
        $this->CodAcesso = $CodAcesso;
    }

    function setNome($Nome) {
        $this->Nome = $Nome;
    }

    function setSenha($Senha) {
        $this->Senha = $Senha;
    }

    function setIdCategUsu($IdCategUsu) {
        $this->IdCategUsu = $IdCategUsu;
    }

    function setIdDireito($IdDireito) {
        $this->IdDireito = $IdDireito;
    }


}
