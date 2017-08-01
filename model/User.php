<?php

/**
 * Description of Usuario
 *
 * @author Eduardo
 */
class User extends GenericDAO {

    const table = "usuario"; //required attribute
    const namePrimaryKey = "idUsuario"; //required attribute

    private $idUsuario;
    private $codAcesso;
    private $nome;
    private $senha;

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getCodAcesso() {
        return $this->codAcesso;
    }

    function getNome() {
        return $this->nome;
    }

    function getSenha() {
        return $this->senha;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setCodAcesso($codAcesso) {
        $this->codAcesso = $codAcesso;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }
    
    /**
     * Methods that have to be standard for all models
     */
    public function __construct() {
        parent::setTable(self::table);   // Enter the table name
        parent::setNamePrimaryKey(self::namePrimaryKey);  // Enter the field name that is the primary key of the table
        parent::setPrimaryKey($this->getIdUsuario());  // To inform the value of the primary key of the table
    }

    /**
     * creating insert 
     */
    public function insert() {
        $this->__construct();
        return parent::insertDAO(get_object_vars($this));
    }

    /**
     * creating update 
     */
    public function update() {
        $this->__construct();
        return parent::updateDAO(get_object_vars($this));
    }

    /**
     * creating delete 
     */
    public function delete() {
        $this->__construct();
        return parent::deleteDAO(get_object_vars($this));
    }
    
}
