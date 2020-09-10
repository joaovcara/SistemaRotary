<?php
require_once("banco.php");

class Usuario {	
	
  public $banco;
	
	function __construct() {
		
    $this->banco = new Banco;
		$this->banco->protegePagina();
	 	function pr($val){
        	echo '<pre>';
        	print_r($val);
        	echo  '</pre>';
		}
	}
	
	//CADASTRO DE USUARIO
	function addUsuario($idEmpresa, $setor, $nome, $email, $senha){
	
		$stm = $this->banco->prepare("INSERT INTO Usuario (idEmpresa, idSetor, nome, email, senha) VALUES (:idEmpresa, :idSetor, :nome, :email, :senha)");
		
		try{
			$resultado = $stm->execute(array(':idEmpresa'=> $idEmpresa,
                                      ':idSetor'=>$setor,
                                      ':nome'=>$nome,
                                      ':email'=>$email,
                                      ':senha'=>$senha
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
	function editUsuario($id, $idSetor, $nome, $email, $senha){
	
		$stm = $this->banco->prepare("UPDATE Usuario SET idSetor = :idSetor, nome = :nome, email = :email WHERE id = :id AND idEmpresa = :idEmpresa;");
		
		try{
			$resultado = $stm->execute(array(':idSetor'=> $idSetor,
                                      ':nome'=>$nome,
                                      ':email'=>$email,
                                      ':email'=>$email,
                                      ':id'=>$id,
                                      ':idEmpresa' => $_SESSION['usuarioIdEmpresa']
											           ));		
		} catch ( PDOException $e ) {
			echo $e->getMessage();
		}
    
    if($senha != null){
     
     try{
       $stm = $this->banco->prepare("UPDATE Usuario SET senha = :senha WHERE id = :id AND idEmpresa = :idEmpresa;");
			 $resultado = $stm->execute(array(':senha'=> $senha,
                                       ':id'=>$id,
                                       ':idEmpresa' => $_SESSION['usuarioIdEmpresa']
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
	
  //DELETA USUARIO
	function deleteUsuario($id){
		try{
			$stm = $this->banco->prepare("DELETE FROM Usuario WHERE id = :id AND idEmpresa = :idEmpresa");
			$stm->execute(array(':id'=> $id, ':idEmpresa' => $_SESSION['usuarioIdEmpresa']));
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
  
  //DESATIVA USUARIO
	function desatUsuario($id){
		try{
			$stm = $this->banco->prepare("UPDATE Usuario SET ativo = IF(ativo=1, 0, 1) WHERE id = :id AND idEmpresa = :idEmpresa");
			$stm->execute(array(':id'=> $id, ':idEmpresa' => $_SESSION['usuarioIdEmpresa']));
			
			$resultado = $stm->fetch ( PDO::FETCH_ASSOC );
			// Resultados podem ser recuperados atraves de seus atributos
			$resultado[] = $obj;
			if($resultado == true){
				return true;
			} else {
				return false;	
			}
		} catch ( PDOException $e ) {
    		echo $e->getMessage ();
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
			$stm = $this->banco->prepare("
        SELECT * , Usuario.id as id, Usuario.nome as nome, Empresa.nome as EN, Setor.nome as SN FROM Usuario
        INNER JOIN Empresa On Usuario.idEmpresa = Empresa.id
        INNER JOIN Setor On Usuario.idSetor = Setor.id 
        WHERE Usuario.id =  :id    
      ");
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
  
  //BUSCA USUARIO POR ID :: ID
	function buscaUsuarioIdEmpresa($id, $idEmpresa){
		try{
			$stm = $this->banco->prepare("SELECT Usuario.id, Usuario.nome as nomeusuario, Usuario.online, Setor.nome as nomesetor FROM Usuario INNER JOIN Setor ON Usuario.idSetor = Setor.id WHERE Usuario.id = :id and Usuario.idEmpresa = :idEmpresa;");
			$stm->execute(array(':id'=> $id, ':idEmpresa' => $idEmpresa));
			$resultado = array();
			$obj = $stm->fetch( PDO::FETCH_ASSOC );
			// Resultados podem ser recuperados atraves de seus atributos
			$resultado[] = $obj;
			if(isset($resultado)){
				return $resultado;
			} else {
				return false;	
			}
		} catch ( PDOException $e ) {
    		echo $e->getMessage ();
		}
	}
  
  //LISTA TODOS OS USUARIOS DE UMA EMPRESA
	function listaUsuarios($empresa){
		try{
			$stm = $this->banco->prepare("SELECT id, idUsuarioTipo, idEmpresa, idSetor, nome FROM Usuario WHERE idEmpresa = :idEmpresa");
			$stm->execute(array(':idEmpresa'=> $empresa));
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
  
  //LISTA TODOS OS USUARIOS DE UM SETOR
	function listaUsuariosSetor($setor){
		try{
			$stm = $this->banco->prepare("SELECT * FROM Usuario WHERE idSetor = :idSetor AND idEmpresa = :idEmpresa AND ativo = 1");
			$stm->execute(array(':idSetor'=> $setor, ':idEmpresa' => $_SESSION['usuarioIdEmpresa']));
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
  
  //LISTA TODOS OS SETORES DE UMA EMPRESA COM USUARIO
	function listaSetores($empresa){
		try{
			$stm = $this->banco->prepare("
        SELECT distinct st.id, st.nome FROM Setor st INNER JOIN `Usuario` usr ON usr.idSetor = st.id WHERE usr.idEmpresa = :idEmpresa
      ");
			$stm->execute(array(':idEmpresa'=> $empresa));
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
    		echo $e->getMessage();
		}
	}
  
  //LISTA TODOS OS SETORES DE UMA EMPRESA
	function listaSetoresAll($empresa){
		try{
			$stm = $this->banco->prepare("SELECT id, nome FROM Setor WHERE idEmpresa = :idEmpresa ORDER BY nome");
			$stm->execute(array(':idEmpresa'=> $empresa));
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
    		echo $e->getMessage();
		}
	}
	
  //ALTERA NOME EMPRESA
	function alteraNomeEmpresa($nome_empresa, $id_empresa){
	 
    $stm = $this->banco->prepare("UPDATE Empresa SET Empresa.nome = :nome_empresa WHERE Empresa.id = :idEmpresa");

    try{
			
      $resultado = $stm->execute(array(':nome_empresa' => $nome_empresa, 
                                      ':idEmpresa' => $id_empresa,));
                          
		}catch(PDOException $e) {
    	echo $e->getMessage();
		}
    
    //Se ocorreu alguem erro, imprime o erro.
		if($resultado==0){ 					
			print_r($stm->errorInfo());
		} else{
			return 1;
		}
	}
  
  
  //ALTERA ADMIN
	function alteraAdmin($novo_admin){
	 
    $stm = $this->banco->prepare("UPDATE Usuario SET Usuario.idUsuarioTipo = 1 WHERE Usuario.idUsuarioTipo = 0");
    try{
      $resultado = $stm->execute();                
		}catch(PDOException $e) {
    	echo $e->getMessage();
		}
    
    $stm = $this->banco->prepare("UPDATE Usuario SET Usuario.idUsuarioTipo = 0 WHERE Usuario.id = :novo");
    try{
      $resultado = $stm->execute(array(':novo' => $novo_admin));
		}catch(PDOException $e) {
    	echo $e->getMessage();
		}
    
    //Se ocorreu alguem erro, imprime o erro.
		if($resultado==0){ 					
			print_r($stm->errorInfo());
		} else{
			return true;
		}
	}
  
  //ALTERA Senha
	function alteraSenha($id, $senha){
	
    $stm = $this->banco->prepare("UPDATE Usuario SET senha = :senha WHERE Usuario.id = :id");

    try{
			$resultado = $stm->execute(array(':senha'=> $senha, ':id' => $id));
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