<?php

class ExcempleModel extends GenericDAO {

    const table = "nameTable"; //required attribute, this is the table name
    const namePrimaryKey = "namePrimaryKey"; //required attribute, this is the PrimaryKey name

    private $id;
    private $name;
    private $password;

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPassword($password) {
        $this->password = $password;
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
