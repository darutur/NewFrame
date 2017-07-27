<?php

/**
 *
 * @author Eduardo
 */
interface IDaoUsuario {
    
    public function incluir(Usuario $u);
    
    public function alterar(Usuario $u);
    
    public function excluir(Usuario $u);
    
    
    public function listarTodos();
    
    public function listarPorId($id);
}