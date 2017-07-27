<?php

/**
 * Description of DaoUsuario
 *
 * @author Eduardo
 */
class DaoUsuario implements IDaoUsuario{

    public function incluir(Usuario $u) {

        $codAcesso = $u->getCodAcesso();
        $nome = $u->getNome();
        $senha = $u->getSenha();
        $idCategUsu = $u->getIdCategUsu();
        $idDireito = $u->getIdDireito();

        $sql = "INSERT into usuario(CodAcesso,Nome,Senha,IdCategUsu,IdDireito) values "
                . "(:codAcesso,:nome,:senha,:idCategUsu,:idDireito)";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("codAcesso", $codAcesso);
        $sth->bindParam("nome", $nome);
        $sth->bindParam("senha", $senha);
        $sth->bindParam("idCategUsu", $idCategUsu);
        $sth->bindParam("idDireito", $idDireito);
        try {
            $sth->execute();
            return true;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }

    public function alterar(Usuario $u) {
        $idUsuario = $u->getIdUsuario();
        $codAcesso = $u->getCodAcesso();
        $nome = $u->getNome();
        $senha = $u->getSenha();
        $idCategUsu = $u->getIdCategUsu();
        $idDireito = $u->getIdDireito();

        $sql = "UPDATE usuario set CodAcesso=:codAcesso,"
                . "Nome=:nome, "
                . "Senha=:senha, "
                . "IdCategUsu=:idCategUsu, "
                . "IdDireito=:idDireito "
                . "WHERE IdUsuario=:idUsuario";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("idUsuario", $idUsuario);
        $sth->bindParam("codAcesso", $codAcesso);
        $sth->bindParam("nome", $nome);
        $sth->bindParam("senha", $senha);
        $sth->bindParam("idCategUsu", $idCategUsu);
        $sth->bindParam("idDireito", $idDireito);
        try {
            $sth->execute();
            return true;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }

    public function excluir(Usuario $u) {
        $sql = "DELETE FROM usuario where IdUsuario=:idUsuario";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $idUsuario = $u->getIdUsuario();
        $sth->bindParam("idUsuario", $idUsuario);
        try {
            $sth->execute();
            return true;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }

    /**
     * 
     * @return array Retorna uma array do tipo Usuario
     */
    public function listarTodos() {
        $sql = "SELECT * FROM usuario where IdUsuario <> 1";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        $arUsu = array();
        //O nome que está em "fetchObject" tem que ser o mesmo nome da classe
        //que no caso é "Usuario"
        while ($usu = $sth->fetchObject("Usuario")) {
            $arUsu[] = $usu;
        }
        return $arUsu;
    }

    /**
     * 
     * @param int $id 
     * @return Usuario
     */
    public function listarPorId($id) {
        $sql = "SELECT * FROM usuario where IdUsuario=:idUsuario";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("idUsuario", $id);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        $usu = $sth->fetchObject("Usuario");

        return $usu;
    }

    public function autenticar($login, $senha) {
        $senhaCRT = md5($senha);
        $sql = "SELECT count(*) as total, IdUsuario FROM usuario where CodAcesso=:LOGIN and Senha=:SENHA";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("LOGIN", $login);
        $sth->bindParam("SENHA", $senhaCRT);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        $resultado = $sth->fetch();
        $total = $resultado['total'];
        $idUsuario = $resultado['IdUsuario'];
        if ($total > 0) {
            return $idUsuario;
        }else{
            return FALSE;
        }
    }
    
    /**
     * 
     * @return array Retorna uma array do tipo Usuario
     */
    public function pesquisa($expressao) {
        $sql = "SELECT u.IdUsuario, u.CodAcesso, u.Nome, u.IdCategUsu
                  FROM usuario u inner join categusu c on u.IdCategUsu = c.IdCategUsu
                 WHERE u.CodAcesso like '%$expressao%' or u.Nome like '%$expressao%' or c.Nome like '%$expressao%'";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        $arUsu = array();
        //O nome que está em "fetchObject" tem que ser o mesmo nome da classe
        //que no caso é "Usuario"
        while ($usu = $sth->fetchObject("Usuario")) {
            $arUsu[] = $usu;
        }
        return $arUsu;
    }
    
    /**
     * 
     * @param int $id 
     * @return Usuario
     */
    public function listarGarcom($id) {
        $sql = "SELECT * FROM usuario where CodAcesso=:codAcesso";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("codAcesso", $id);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        $usu = $sth->fetchObject("Usuario");

        return $usu;
    }

}
