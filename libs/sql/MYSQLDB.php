<?php

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
     * @param type $array 
     * @return type String
     */
    private function endKey($array) {
        end($array);
        return key($array);
    }

    /**
     * Método para dar bind em vários parâmetros
     * @param type $statement
     * @param type $parameters 
     */
    private function setParams($statement, $parameters = array()) {

        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    /**
     * Método para dar bind em somente um parâmetro
     * @param type $statement Passar o Statement
     * @param type $key Nome do campo do parâmetro
     * @param type $value Valor do campo do parâmetro
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
     * @param type $rawQuery Query bruta em SQL
     * @param type $params Parâmetros para a query
     * @return array resultado de execução (Statement)
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
     * @param type $rawQuery Query bruta em SQL
     * @param type $params Parâmetros para a query
     * @return array Lista do resultado
     */
    public function queryMany($rawQuery, $params = array()): array {

        $stmt = $this->queryOnly($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Método responsável por realizar a inserção de dados no banco de dados
     * @param type $table Nome da tabéla no banco
     * @param type $parameters Parâmetros para a query 
     * @return type array Lista do resultado
     */
    public function insert($table, $parameters = array()) {

        $rawQuery = "INSERT INTO " .$table. " (";

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

        return $this->queryOnly($rawQuery, $parameters);
    }
    
    /**
     * Método responsável por realizar a alteração de dados no banco de dados
     * @param type $table Nome da tabela
     * @param type $parameters Parâmetros para a query 
     * @param type $condition Informar a chave primária e o seu valor
     * @return type array Lista do resultado
     */
    public function update($table, $parameters = array(), $condition = array()){

    	$rawQuery = "UPDATE " .$table. " SET ";

    	foreach ($parameters as $key => $value) {
    		if ($key == $this->endKey($campos)) {
    			$rawQuery .= $key. " = :" .$key;
    		} else{
    			$rawQuery .= $key. " = :" .$key. ", ";
    		}
    	}

    	$rawQuery.= " WHERE " .key($condition). " = :" .key($condition);
        
        $mergeParameters = array_merge($parameters, $condition);

        return $this->queryOnly($rawQuery, $mergeParameters);
    
    }
    
    /**
     * Método responsável por realizar a deleção de dados no banco de dados
     * @param type $table Nome da tabela
     * @param type $condition Informar a chave primária e o seu valor
     * @return type array Lista do resultado
     */
    public function delete($table, $condition = array()){

    	$rawQuery = "DELETE FROM " .$table. " WHERE " .key($condition). " = :" .key($condition);

    	return $this->queryOnly($rawQuery, $condition);
        
    }
    
    /**
     * Método responsável por retornar todos os dados de uma tabela
     * @param type $table Nome da tabela
     * @param type $orderBy Informar o campo que deseja ordenação
     * @return type array Lista do resultado
     */
    public function selectAll($table, $orderBy = "") {
        
        if(empty($orderBy)){
            $rawQuery = "SELECT * FROM " .$table. " ORDER BY " .$orderBy;
        } else{
            $rawQuery = "SELECT * FROM " .$table;
        }

    	return $this->queryMany($rawQuery);
        
    }
    
    /**
     * Método responsável por retornar os dados de uma tabela conforme sua
     * condição
     * @param type $table Nome da tabela
     * @param type $condition Informar a condição que deseja
     * @param type $orderBy Informar o campo que deseja ordenação
     * @return type array Lista do resultado
     */
    public function selectOneCondition($table, $condition = array(), $orderBy = "") {
        
        if(empty($orderBy)){
            $rawQuery = "SELECT * FROM " .$table. " WHERE " .key($condition). " = :" .key($condition). " ORDER BY " .$orderBy;
        } else{
            $rawQuery = "SELECT * FROM " .$table. " WHERE " .key($condition). " = :" .key($condition). " ORDER BY " .key($condition);
        }
        
    	return $this->queryMany($rawQuery, $condition);
    }

}
