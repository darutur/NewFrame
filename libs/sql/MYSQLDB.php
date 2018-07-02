<?php

/**
 * Método responsável pela conexão com o banco de dados
 */
abstract class MYSQLDB extends PDO {

    private $conn;

    public function __construct() {
        $host = HOST;
        $port = PORT;
        $dbName = DB_NAME;
        $username = USER_NAME;
        $password = PASSWORD;

        $this->conn = new PDO("mysql:host={$host}; port={$port}; dbname={$dbName}", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }

    /**
     * Responsável por retornar a chave do último item no array
     * @param Array $array 
     * @return String
     */
    private function endKey($array) {
        end($array);
        return key($array);
    }

    /**
     * Método para dar bind em vários parâmetros
     * @param Statement $statement Passar o Statement
     * @param Array $parameters Parâmetros para a query
     */
    private function setParams($statement, $parameters = array()) {

        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    /**
     * Método para dar bind em somente um parâmetro
     * @param Statement $statement Passar o Statement
     * @param String $key Nome do campo do parâmetro
     * @param String $value Valor do campo do parâmetro
     */
    private function setParam($statement, $key, $value) {

        //Verifiando se tem os ":" para usar o bind
        if (strrpos($key, ":") === false) {
            $key = ":" . $key;
        }

        $statement->bindParam($key, $value);
    }

    /**
     * Este método é mais utilizado quando se deseja passar a query bruta 
     * com o retorno de um linha de resultado ou uma resposta
     * @param String $rawQuery Query bruta em SQL
     * @param Array $params Parâmetros para a query
     * @return Array Retorna o Statement do resultado de execução
     */
    public function queryOnly($rawQuery, $params = array()) {

        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();

        return $stmt;
    }

    /**
     * Este método é mais utilizado quando se deseja passar a query bruta 
     * com o retorno de várias linhas no resultado
     * @param String $rawQuery Query bruta em SQL
     * @param Array $params Parâmetros para a query
     * @param String $className Informando o nome da classe
     * @return Array Lista do resultado
     */
    public function queryMany($rawQuery, $params = array(), $className = "") {

        $stmt = $this->queryOnly($rawQuery, $params);

        if (empty($className)) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $array = array();
            while ($obj = $stmt->fetchObject($className)) {
                $array[] = $obj;
            }
            if (count($array) > 1) {
                return $array;
            } else if(count($array) == 1){
                return $array[0];
            } else{
                return $array;
            }
        }
    }

    /**
     * Método responsável por realizar a inserção de dados no banco de dados
     * @param String $table Nome da tabéla no banco
     * @param Array $parameters Parâmetros para a query 
     * @return INT Retorna 0 se ocorrer algum erro, senão o ID da inserção
     */
    public function insert($table, $parameters): int {

        $rawQuery = "INSERT INTO " . $table . " (";

        foreach ($parameters as $key => $value) {
            if ($key == $this->endKey($parameters)) {
                $rawQuery .= $key . ") ";
            } else {
                $rawQuery .= $key . ", ";
            }
        }

        $rawQuery .= "VALUES (";

        foreach ($parameters as $key => $value) {
            if ($key == $this->endKey($parameters)) {
                $rawQuery .= ":" . $key . ") ";
            } else {
                $rawQuery .= ":" . $key . ", ";
            }
        }

        $this->conn->beginTransaction();
        try {
            $this->queryOnly($rawQuery, $parameters);
            $lastID = $this->conn->lastInsertId();
            $this->conn->commit();

            return $lastID;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            GlobalFunctions::logMsg($e, "insert_" . $table);
            return 0;
        }
    }

    /**
     * Método responsável por realizar a alteração de dados no banco de dados
     * @param String $table Nome da tabela
     * @param Array $parameters Parâmetros para a query 
     * @param Array $condition Informar a chave primária e o seu valor
     * @return Bool
     */
    public function update($table, $parameters, $condition): bool {

        $rawQuery = "UPDATE " . $table . " SET ";

        foreach ($parameters as $key => $value) {
            if ($key == $this->endKey($parameters)) {
                $rawQuery .= $key . " = :" . $key;
            } else {
                $rawQuery .= $key . " = :" . $key . ", ";
            }
        }

        $rawQuery .= " WHERE " . key($condition) . " = :" . key($condition);

        $mergeParameters = array_merge($parameters, $condition);

        $this->conn->beginTransaction();
        try {
            $this->queryOnly($rawQuery, $mergeParameters);
            $this->conn->commit();

            return TRUE;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            GlobalFunctions::logMsg($e, "update_" . $table);
            return FALSE;
        }
    }

    /**
     * Método responsável por realizar a deleção de dados no banco de dados
     * @param String $table Nome da tabela
     * @param Array $condition Informar a chave primária e o seu valor
     * @return Bool
     */
    public function delete($table, $condition): bool {

        $rawQuery = "DELETE FROM " . $table . " WHERE " . key($condition) . " = :" . key($condition);

        $this->conn->beginTransaction();
        try {
            $this->queryOnly($rawQuery, $condition);
            $this->conn->commit();
            return TRUE;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            GlobalFunctions::logMsg($e, "delete_" . $table);
            return FALSE;
        }
    }

    /**
     * Método responsável por retornar todos os dados de uma tabela
     * @param String $table Nome da tabela
     * @param String $orderBy Informar o campo que deseja ordenação
     * @param String $className Informando o nome da classe
     * @return Array Lista do resultado
     */
    public function selectAll($table, $orderBy = "", $className = "") {

        if (empty($orderBy)) {
            $rawQuery = "SELECT * FROM " . $table;
        } else {
            $rawQuery = "SELECT * FROM " . $table . " ORDER BY " . $orderBy;
        }

        return $this->queryMany($rawQuery, array(), $className);
    }

    /**
     * Método responsável por retornar os dados de uma tabela conforme sua
     * condição
     * @param String $table Nome da tabela
     * @param Array $condition Informar a condição que deseja
     * @param String $className Informando o nome da classe
     * @param String $orderBy Informar o campo que deseja ordenação
     * @return Array Lista do resultado
     */
    public function selectOneCondition($table, $condition, $className = "", $orderBy = "") {

        if (empty($orderBy)) {
            $rawQuery = "SELECT * FROM " . $table . " WHERE " . key($condition) . " = :" . key($condition) . " ORDER BY " . key($condition);
        } else {
            $rawQuery = "SELECT * FROM " . $table . " WHERE " . key($condition) . " = :" . key($condition) . " ORDER BY " . $orderBy;
        }

        return $this->queryMany($rawQuery, $condition, $className);
    }

}
