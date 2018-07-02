<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Venanrim
 */
class Usuario extends MYSQLDB {
    
    /**
     * Nome da tabela no banco de dados
     */
    const tabela = "usuario";
    
    private $idUsuario;
    private $login;
    private $senha;
    
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    /**
     * Este método vai inserir os dados na tabela e seta o ID recebido no
     * atributo da chave primária desta classe
     * @return bool
     */
    public function inserir():bool{
        
        //tratando os dados para não passar a chave primária
        $arrayDados = get_object_vars($this);
        
        //removendo a chave primária
        unset($arrayDados['idUsuario']);
        
        $retorno = parent::insert(self::tabela, $arrayDados);
        if($retorno > 0){
            $this->setIdUsuario($retorno);
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
    /**
     * Este método vai Alterar os dados na tabela
     * atributo da chave primária desta classe
     * @return bool
     */
    public function alterar(): bool{
        
        $arrayDados = get_object_vars($this);
        
        //criando a condição
        $condicao = array("idUsuario"=> $this->getIdUsuario());
        
        return parent::update(self::tabela, $arrayDados, $condicao);
        
    }
    
    /**
     * Este método vai Excluir os dados na tabela
     * atributo da chave primária desta classe
     * @return bool
     */
    public function deletar(){
        
        //criando a condição
        $condicao = array("idUsuario"=> $this->getIdUsuario());
        
        return parent::delete(self::tabela, $condicao);
        
    }
    
    /**
     * Este método retorna uma lista de todos Usuários
     * @param String $orderBy Campo de ordenação
     * @return \Usuario Retorna uma lista de dados desta classe
     */
    public function listarTodos($orderBy = ""){
        
        return parent::selectAll(self::tabela, $orderBy, get_class($this));
        
    }
    
    /**
     * Este método retorna um Usuário
     * @return \Usuario Array de Usuário
     */
    public function listarPorId(){
        
        //criando a condição
        $condicao = array("idUsuario"=> $this->getIdUsuario());
        
        return parent::selectOneCondition(self::tabela, $condicao, get_class($this));
        
    }
    
    /**
     * Este método retorna um Usuário
     * @return \Usuario Array de Usuário
     */
    public function listarPorLogin(){
        
        //criando a condição
        $condicao = array("login"=> $this->getLogin());
        
        return parent::selectOneCondition(self::tabela, $condicao, get_class($this));
        
    }
    
}
