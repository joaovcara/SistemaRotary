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
	
		$stm = $this->banco->prepare("INSERT INTO Item (status, descricao, categoria, numeroSerie, observacaoItem, foto) VALUES (:status, :descricao, :categoria, :numeroSerie, :observacaoItem, :foto)");
		
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

	//LISTA TODOS OS ITENS
	function listaItens(){
		try{
			$stm = $this->banco->prepare("SELECT id, status, descricao, categoria, numeroSerie, observacaoItem, foto FROM Item");
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

	//LISTA ITEM POR ID
	function listaItem($itemId){
		try{
			$stm = $this->banco->prepare("SELECT * FROM Item WHERE id = :itemId");
			$stm->execute(array( ':itemId' => $itemId ));
			$resultado = array();
      
      		$obj = $stm->fetch ( PDO::FETCH_ASSOC );

	 		$resultado[] = $obj;

			if(isset($resultado)){
				return $resultado[0];
			} else {
				return false;	
			}
		} catch ( PDOException $e ) {
    		echo $e->getMessage ();
		}
	}


	//ALTERA ITEM
	function editItem($id, $status, $descricao, $categoria, $numeroSerie, $observacaoItem, $foto){
		
		
		$stm = $this->banco->prepare("UPDATE Item SET status = :status, descricao = :descricao, categoria = :categoria, numeroSerie = :numeroSerie, observacaoItem = :observacaoItem, foto = :foto WHERE id = :id");
		
		
		try{
			$resultado = $stm->execute(array(':status'         => $status,
                                      		 ':descricao'      => $descricao,
                                      		 ':categoria'      => $categoria,
                                      		 ':numeroSerie'    => $numeroSerie,
                                      		 ':observacaoItem' => $observacaoItem,
                                      		 ':foto'           => $foto,
                                      		 ':id'             => $id,
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


	//CHECA ITEM ANTES DA EXCLUSAO
	function checkItem($id){
	
		$stm = $this->banco->prepare("SELECT id FROM Emprestimo WHERE idItem = :id AND (status = 'Solicitado' OR status = 'Devolução Solicitada' OR status = 'Aprovado')");
		
		try{
			$resultado = $stm->execute(array(':id' => $id));
			$resultado = array();

			while ( $obj = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
				$resultado[] = $obj;
			}

		} catch ( PDOException $e ) {
			echo $e->getMessage();
		}

    
		//Se ocorreu alguem erro, imprime o erro.
		if($resultado == 0){ 					
			print_r($stm->errorInfo());
		} else {

			if( isset($resultado[0]) ){

				//Nao pode ser excluido
				return false;

			} else {

				return true;

			}
			
		}
	}

	//DELETA ITEM
	function deleteItem($id){
		try{
			$stm = $this->banco->prepare("DELETE FROM Item WHERE id = :id");
			$resultado = $stm->execute(array( ':id' => $id ));	
		} catch(PDOException $e){
			echo $e->getMessage();
		}
    
		//Se ocorreu alguem erro, imprime o erro.
		if($resultado==0){ 					
			print_r($stm->errorInfo());
		} else{
			return true;
		}
	}







}
?>