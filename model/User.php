<?php

/**
 * Description of Usuario
 *
 * @author Eduardo
 */
class User extends GenericDAO {

    const table = "nameTable"; //required attribute
    const namePrimaryKey = "namePrimaryKey"; //required attribute

    private $IdUsuario;
    private $CodAcesso;
    private $Nome;
    private $Senha;

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
        parent::insert(get_object_vars($this));
    }

    /**
     * creating update 
     */
    public function update() {
        $this->__construct();
        parent::update(get_object_vars($this));
    }

    /**
     * creating delete 
     */
    public function delete() {
        $this->__construct();
        parent::delete(get_object_vars($this));
    }

}
