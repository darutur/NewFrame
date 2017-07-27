<?php

class GenericDAO {

    private $table;             //name table
    private $namePrimaryKey;    //name Primary Key
    private $primaryKey;        //value Primary Key
    private $field;             //table field
    private $value;             //table value

    function getTable() {
        return $this->table;
    }

    function getNamePrimaryKey() {
        return $this->namePrimaryKey;
    }

    function getPrimaryKey() {
        return $this->primaryKey;
    }

    function getField() {
        return $this->field;
    }

    function getValue() {
        return $this->value;
    }

    function setTable($table) {
        $this->table = $table;
    }

    function setNamePrimaryKey($namePrimaryKey) {
        $this->namePrimaryKey = $namePrimaryKey;
    }

    function setPrimaryKey($primaryKey) {
        $this->primaryKey = $primaryKey;
    }

    function setField($field) {
        $this->field = $field;
    }

    function setValue($value) {
        $this->value = $value;
    }

    /**
     *
     * 	Used to return the last key of the array
     *
     * */
    function endKey($array) {
        end($array);
        return key($array);
    }

    /**
     *
     * 	Crud methods
     *
     * */
    public function insert($array) {

        // Preparing fields and values
        foreach ($array as $key => $value) {

            if (!($key == $this->namePrimaryKey)) {
                if ($key == $this->endKey($array)) {
                    $this->field .= $key;
                    $this->value .= ":" . $key;
                } else {
                    $this->field .= $key . ", ";
                    $this->value .= ":" . $key . ", ";
                }
            }
        }

        $sql = "INSERT INTO " . $this->table . " (" . $this->campos . ") VALUES(" . $this->valor . ")";

        $con = Connection::getConnection();
        $sth = $con->prepare($sql);

        //executing bind
        foreach ($array as $key => $value) {
            $sth->bindParam(":" . $key, $value);
        }

        try {
            $con->beginTransaction();
            $sth->execute();
            $con->commit();
            $con->lastInsertId();
        } catch (PDOException $e) {
            $con->rollBack();
            GlobalFunctions::logMsg($e, "insert_" . $this->table);
            return 0;
        }
    }

    public function update($array) {

        $sql = "UPDATE " . $this->table . " SET ";

        foreach ($array as $key => $value) {

            if (!($key == $this->namePrimaryKey)) {
                if ($value == end($array)) {
                    $sql .= $key . " = :" . $key . " ";
                } else {
                    $sql .= $key . " = :" . $key . ", ";
                }
            }
        }

        $sql .= "WHERE " . $this->namePrimaryKey . " = :" . $this->namePrimaryKey;

        $con = Connection::getConnection();
        $sth = $con->prepare($sql);

        $sth->bindParam(":" . $this->namePrimaryKey, $this->primaryKey);

        //executando o bind
        foreach ($array as $key => $value) {
            $sth->bindParam(":" . $key, $value);
        }

        try {
            $con->beginTransaction();
            $sth->execute();
            $con->commit();
        } catch (PDOException $e) {
            $con->rollBack();
            GlobalFunctions::logMsg($e, "update_" . $this->table);
            return 0;
        }
    }

    public function delete() {

        $sql = "DELETE FROM " . $this->table . " WHERE " . $this->namePrimaryKey . " = :" . $this->namePrimaryKey;

        $con = Connection::getConnection();
        $sth = $con->prepare($sql);
        
        $sth->bindParam(":" . $this->namePrimaryKey, $this->primaryKey);

        try {
            $con->beginTransaction();
            $sth->execute();
            $con->commit();
        } catch (PDOException $e) {
            $con->rollBack();
            GlobalFunctions::logMsg($e, "delete_" . $this->table);
            return 0;
        }
    }

}

?>