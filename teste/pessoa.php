<?php

include_once "objeto.php";

class Pessoa extends GenericDAO {
	const table = "pessoa";         // nome da tabela
	const namePK = "idPessoa";	// nome da primary key
	private $idPessoa;
	private $nome;
	private $cpf;

	public function __construct() {
		parent::setTable(self::table);			// informar o nome da tabela
		parent::setNamePrimaryKey(self::namePK); 	// informar o nome do campo que é a chave primária da tabela
		parent::setPrimaryKey($this->getIdPessoa()); 	// informar o campo que é a chave primária da tabela
	}

	public function setIdPessoa($id) {
		$this->idPessoa = $id;
	}

	public function setNome($string) {
		$this->nome = $string;
	}

	public function setCPF($int) {
		$this->cpf = $int;
	}

	public function getIdPessoa() {
		return $this->idPessoa;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getCPF() {
		return $this->cpf;
	}

	public function incluir(){
		$this->__construct();
		parent::incluir(get_object_vars($this));	
	}

	public function alterar(){
		$this->__construct();
		parent::alterar(get_object_vars($this));	
	}

	public function deletar(){
		$this->__construct();
		parent::deletar(get_object_vars($this));	
	}
}


$cadastro = new Pessoa();

$cadastro->incluir();
echo "<br>";
$cadastro->alterar();
echo "<br>";
$cadastro->deletar();

echo "<pre>";
print_r($cadastro);
echo "</pre>";

?>