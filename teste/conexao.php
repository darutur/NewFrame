<?php

/**
 * Classe para abstração com o banco MYSQL
 *
 * @author Eduardo
 */
class Conexao {
    private static $cnx;
    
    /**
     * 
     * @return PDO
     */
    public static function getConexao(){
        if (!self::$cnx) {
            self::Open();
        }
        return self::$cnx;
    }
    
    private static function Open(){
        
        $host = HOST;
        $port = PORT;
        $dbName = DB_NAME;
        $username = USER_NAME;
        $password = PASSWORD;
        
        self::$cnx = new PDO("mysql:host={$host}; port={$port}; dbname={$dbName}", $username, $password, 
                             array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
        
    }
}