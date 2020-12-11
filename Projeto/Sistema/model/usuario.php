<?php

require_once("banco.php");

class Usuario {	
	
  public $banco;
	
	function __construct() {
		
    	$this->banco = new Banco;

	 	function pr($val){
        	echo '<pre>';
        	print_r($val);
        	echo  '</pre>';
		}

	}
	
	//CADASTRO DE USUARIO
	function addUsuario($nome, $email, $cpf, $cep, $endereco, $numero, $bairro, $cidade, $estado, $tel, $senha){
	
		$stm = $this->banco->prepare("INSERT INTO Usuario (nome, email, cpf, cep, endereco, numero, bairro, cidade, estado, tel, senha) VALUES (:nome, :email, :cpf, :cep, :endereco, :numero, :bairro, :cidade, :estado, :tel, :senha)");
		
		try{
			$resultado = $stm->execute(array(':nome'     => $nome,
                                             ':email'    => $email,
                                             ':cpf'      => $cpf,
                                             ':cep'      => $cep,
                                             ':endereco' => $endereco,
                                             ':numero'   => $numero,
                                             ':bairro'   => $bairro,
                                             ':cidade'   => $cidade,
                                             ':estado'   => $estado,
                                             ':tel'      => $tel,
                                             ':senha'    => $senha
										 ));

		} catch ( PDOException $e ) {
			echo $e->getMessage();
		}
    
		//Se ocorreu alguem erro, imprime o erro.
		if($resultado == 0){ 					
			print_r($stm->errorInfo());
		} else{
			return true;
		}
	}


  
    //EDITAR USUARIO
	function editUsuario($id, $nome, $cep, $endereco, $numero, $bairro, $cidade, $estado, $tel, $senha_hash = null){
		
		if($senha_hash == null){

			$stm = $this->banco->prepare("UPDATE Usuario SET nome = :nome, cep = :cep, endereco = :endereco, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, tel = :tel WHERE id = :id");

			try{
			$resultado = $stm->execute(array(
												':nome'     => $nome,
												':cep'      => $cep,
												':endereco' => $endereco,
												':numero'   => $numero,
												':bairro'   => $bairro,
												':cidade'   => $cidade,
												':estado'   => $estado,
												':tel'      => $tel,
												':id'       => $id,
											));		
			} catch ( PDOException $e ) {
				echo $e->getMessage();
			}

		}else{

			$stm = $this->banco->prepare("UPDATE Usuario SET nome = :nome, cep = :cep, endereco = :endereco, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, tel = :tel, senha = :senha WHERE id = :id");

			try{
			$resultado = $stm->execute(array(
												':nome'     => $nome,
												':cep'      => $cep,
												':endereco' => $endereco,
												':numero'   => $numero,
												':bairro'   => $bairro,
												':cidade'   => $cidade,
												':estado'   => $estado,
												':tel'      => $tel,
												':senha'    => $senha_hash,
												':id'       => $id,
											));		
			} catch ( PDOException $e ) {
				echo $e->getMessage();
			}
		}
    
		//Se ocorreu alguem erro, imprime o erro.
		if($resultado == 0){ 					
			print_r($stm->errorInfo());
		} else{
			return true;
		}
	}
  
	//VERIFICA SE USUARIO JA NAO ESTA CADASTRADO
	function jaCadastrado($email){
		try{
			$stm = $this->banco->prepare("SELECT email FROM Usuario WHERE email = :email");
			$stm->execute(array(':email'=> $email));
			$resultado = array();
			$obj = $stm->fetch ( PDO::FETCH_ASSOC );
			// Resultados podem ser recuperados atraves de seus atributos
			$resultado[] = $obj;
			if(isset($resultado[0]['email'])){
				return true;
			} else {
				return false;	
			}
		} catch ( PDOException $e ) {
    		echo $e->getMessage ();
		}
	}
  
    //BUSCA USUARIO :: ID
	function buscaUsuarioId($id){
		try{
			$stm = $this->banco->prepare("SELECT * FROM Usuario WHERE Usuario.id = :id");

			$stm->execute(array(':id'=> $id));

			$resultado = array();
			$obj = $stm->fetch ( PDO::FETCH_ASSOC );
			// Resultados podem ser recuperados atraves de seus atributos
			$resultado[] = $obj;
			if(isset($resultado[0]['id'])){
				return $resultado[0];
			} else {
				return false;	
			}
		} catch ( PDOException $e ) {
    		echo $e->getMessage ();
		}
	}
  
    
  
    //LISTA TODOS OS USUARIOS
	function listaUsuarios(){
		try{
			$stm = $this->banco->prepare("SELECT id, nome, email, cpf, cep, endereco, numero, bairro, cidade, estado, tel, tipo FROM Usuario");
			$stm->execute();
			$resultado = array();
      
      while ( $obj = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
				$resultado[] = $obj;
			}
			if(isset($resultado)){
				return $resultado;
			} else {
				return false;	
			}
		} catch ( PDOException $e ) {
    		echo $e->getMessage ();
		}
	}
  
  
  
  
  
    //ALTERA Senha
	function alteraSenha($email, $senha){
	
    $stm = $this->banco->prepare("UPDATE Usuario SET senha = :senha WHERE Usuario.email = :email");

    try{
			$resultado = $stm->execute(array(':senha'=> $senha, ':email' => $email));
			if(isset($resultado)){
				return $resultado;
			} else {
				return false;	
			}
		} catch ( PDOException $e ) {
    		echo $e->getMessage();
		}
	}


}
?>