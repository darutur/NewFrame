<?php
class Banco {
	private $sql;
	private $query;
	private $result;
	private $host;
	private $usuario;
	private $senha;
	private $banco;
	public $tabela;
	public $campos; // array
	public $valores; // array
	private $linhas;
	//Campos para o insert
	private $camposQuery = null;
	private $valoresQuery = null;
	//campos para o update
	public $primaryKey;
	public $namePrimaryKey;
	private $campoValorQuery = null;

	public function __construct() {
		//$this->conexao();
	}

	private function conexao() {
		$this->host    = "localhost";
		$this->usuario = "root";
		$this->senha   = "";
		$this->banco   = "crud";

		mysql_connect($this->host, $this->usuario, $this->senha);
		mysql_select_db($this->banco);
	}

	

	private function montaQuery($tipo) {
		$cont  = count($this->campos);
		for($i = 0; $i < $cont; $i++) {
			if($i < $cont - 1) {
				if($tipo == 1) {
					$this->camposQuery  .= $this->campos[$i] .", ";
					$this->valoresQuery .= "'" .$this->valores[$i] ."', ";
				}
				else if($tipo == 2){
					$this->campoValorQuery .= $this->campos[$i] . " = '" . $this->valores[$i] . "',";
				}
			} else {
				if($tipo == 1) {
					$this->camposQuery  .= $this->campos[$i];
					$this->valoresQuery .= "'" . $this->valores[$i] ."'";
				}
				else if($tipo == 2){
					$this->campoValorQuery .= $this->campos[$i] . " = '" . $this->valores[$i] . "' ";	
				}
			}
		}
	}

	public function insert() {
		$this->montaQuery(1);
		$this->sql    = "INSERT INTO ".$this->tabela." (".$this->camposQuery.") VALUES (".$this->valoresQuery.")";
		$this->query  = mysql_query($this->sql);
		$this->result = mysql_affected_rows();

		return $this->result;
	}

	public function update() {
		$this->montaQuery(2);
		$this->sql    = "UPDATE ".$this->tabela." SET ". $this->campoValorQuery." WHERE ".$this->namePrimaryKey." = ".$this->primaryKey;
		$this->query  = mysql_query($this->sql);
		$this->result = mysql_affected_rows();

		return $this->result;
	}

	public function delete() {	
		$this->sql    = "DELETE FROM ".$this->tabela." WHERE ".$this->namePrimaryKey." = ".$this->primaryKey;
		$this->query  = mysql_query($this->sql);
		$this->result = mysql_affected_rows();

		return $this->result;
	}

	public function listAll($orderCampo, $orderType, $nameClass) {	
		if($ordemTipo == 1)
			$tipo = "DESC";
		else
			$tipo = "ASC";

		$this->sql    = "SELECT * from ".$this->tabela." ORDERBY ".$orderCampo." ".$tipo;
		$this->query  = mysql_query($this->sql);
		$this->result = mysql_affected_rows();

		return $this->result;
	}

	public function listID($id, $nameClass) {	
		
		$this->sql    = "SELECT * from ".$this->tabela." ORDERBY ".$orderCampo." ".$tipo;
		$this->query  = mysql_query($this->sql);
		$this->result = mysql_affected_rows();

		return $this->result;
	}


}
?> 