<?php

class GenericDAO {

    private $table;
    private $namePrimaryKey;
    private $primaryKey;
    private $campos;
    private $valor;

    public function setTable($table) {
        $this->table = $table;
    }

    public function getTable() {
        return $this->table;
    }

    public function setNamePrimaryKey($namePrimaryKey) {
        $this->namePrimaryKey = $namePrimaryKey;
    }

    public function getNamePrimaryKey() {
        return $this->namePrimaryKey;
    }

    public function setPrimaryKey($primaryKey) {
        $this->primaryKey = $primaryKey;
    }

    public function getPrimaryKey() {
        return $this->primaryKey;
    }

    /**
     *
     * 	Serve para retornar a última chave do array
     *
     * */
    function endKey($array) {
        end($array);
        return key($array);
    }

    /**
     *
     * 	Metodos do crud
     *
     * */
    public function incluir($array) {

        // preparando os campos e dos valores
        foreach ($array as $key => $value) {

            if (!($key == $this->namePrimaryKey)) {
                if ($key == $this->endKey($array)) {
                    $this->campos .= $key;
                    $this->valor .= ":" . $key;
                } else {
                    $this->campos .= $key . ", ";
                    $this->valor .= ":" . $key . ", ";
                }
            }
        }

        $sql = "INSERT INTO " . $this->table . " (" . $this->campos . ") VALUES(" . $this->valor . ")";
        echo $sql;

        /*
          $conexao = Conexao::getConexao();
          $sth = $conexao->prepare($sql);

          //executando o bind
          foreach ($array as $key => $value) {
          $sth->bindParam(":". $key, $value);
          }

          try {
          $sth->execute();
          return TRUE;
          } catch (Exception $exc) {
          echo $exc->getTraceAsString();
          }
         */
    }

    public function alterar($array) {

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


        echo $sql;
        /*
          $conexao = Conexao::getConexao();
          $sth = $conexao->prepare($sql);
          $sth->bindParam(":". $this->namePrimaryKey, $this->primaryKey);

          //executando o bind
          foreach ($array as $key => $value) {
          $sth->bindParam(":". $key, $value);
          }

          try {
          $sth->execute();
          return TRUE;
          } catch (Exception $exc) {
          echo $exc->getTraceAsString();
          }
         */
    }

    public function deletar($array) {

        $sql = "DELETE FROM " . $this->table . " WHERE " . $this->namePrimaryKey . " = :" . $this->namePrimaryKey;
        echo $sql;
        /*
          $conexao = Conexao::getConexao();
          $sth = $conexao->prepare($sql);
          $sth->bindParam(":". $this->namePrimaryKey, $this->primaryKey);

          try {
          $sth->execute();
          return TRUE;
          } catch (Exception $exc) {
          echo $exc->getTraceAsString();
          }
         */
    }

}

?>