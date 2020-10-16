<?php

require_once("banco.php");

class Item {	
	
  public $banco;
	
	function __construct() {
		
    	$this->banco = new Banco;

	 	function pr($val){
        	echo '<pre>';
        	print_r($val);
        	echo  '</pre>';
		}

	}
	
	//CADASTRO DE ITEM
	function addItem($status, $descricao, $categoria, $numeroSerie, $observacaoItem, $novoNome){
	
		$stm = $this->banco->prepare("INSERT INTO itens (status, descricao, categoria, numeroSerie, observacaoItem, foto) VALUES (:status, :descricao, :categoria, :numeroSerie, :observacaoItem, :foto)");
		
		try{
			$resultado = $stm->execute(array(':status'     		=> $status,
                                             ':descricao'    	=> $descricao,
                                             ':categoria'      	=> $categoria,
                                             ':numeroSerie'     => $numeroSerie,
                                             ':observacaoItem'  => $observacaoItem,
                                             ':foto'   			=> $novoNome,
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


}
?>