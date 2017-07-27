<?php

include_once "objeto.php";

class Cadastro extends GenericDAO {
	const table = "cadastro";	// nome da tabela
	private $id;
	private $nome;
	private $idade;
	private $telefone;

	public function __construct() {
		parent::setTable(self::table);			// informar o nome da tabela
		parent::setNamePrimaryKey("id"); 	// informar o nome do campo que é a chave primária da tabela
		parent::setPrimaryKey($this->getId()); 	// informar o campo que é a chave primária da tabela
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setNome($string) {
		$this->nome = $string;
	}

	public function setIdade($int) {
		$this->idade = $int;
	}

	public function setTelefone($string) {
		$this->telefone = $string;
	}

	public function getId() {
		return $this->id;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getIdade() {
		return $this->idade;
	}

	public function getTelefone() {
		return $this->telefone;
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


$cadastro = new Cadastro();
$cadastro->setId(1);
$cadastro->setNome("Eduardo");
$cadastro->setIdade("28");
$cadastro->setTelefone("555-555");

$cadastro->incluir();
echo "<br>";
$cadastro->alterar();
echo "<br>";
$cadastro->deletar();

echo "<pre>";
print_r($cadastro);
echo "</pre>";

?>