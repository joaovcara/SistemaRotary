<?php

require_once("banco.php");

class Emprestimo {
	
  public $banco;
	
	function __construct() {
		
    	$this->banco = new Banco;

	 	function pr($val){
        	echo '<pre>';
        	print_r($val);
        	echo  '</pre>';
		}

	}
	
	//CADASTRO DE EMPRESTIMO
	function addEmprestimo($idItem, $idUsuario, $expira, $status){
	
		$stm = $this->banco->prepare("INSERT INTO Emprestimo (idItem, idUsuario, expira, status) VALUES (:idItem, :idUsuario, :expira, :status)");
		
		try{
			$resultado = $stm->execute(array(':idItem'     => $idItem,
                                             ':idUsuario'  => $idUsuario,
                                             ':expira'     => $expira,
                                             ':status'     => $status,
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

	//LISTA TODOS OS EMPRESTIMOS DE UM USUARIO
	function listaEmprestimos($idUsuario, $admin = false){

		try{

			if($admin){
				$stm = $this->banco->prepare("SELECT * FROM Emprestimo INNER JOIN Item ON Emprestimo.IdItem = Item.Id INNER JOIN Usuario ON Emprestimo.IdUsuario = Usuario.Id ORDER BY Expira");
			}else{
				$stm = $this->banco->prepare("SELECT * FROM Emprestimo INNER JOIN Item ON Emprestimo.IdItem = Item.Id WHERE idUsuario = :idUsuario ORDER BY Emprestimo.Id DESC");
			}
			
			$stm->execute(array( ':idUsuario'  => $idUsuario ));
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

	//LISTA EMPRESTIMO POR ID
	function listaEmprestimo($idEmprestimo, $admin = false){

		try{

			if($admin){
				$stm = $this->banco->prepare("SELECT *, Emprestimo.Status as status_emprestimo FROM Emprestimo INNER JOIN Item ON Emprestimo.IdItem = Item.Id INNER JOIN Usuario ON Emprestimo.IdUsuario = Usuario.Id WHERE Emprestimo.Id = :idEmprestimo");
			}else{
				$stm = $this->banco->prepare("SELECT *, Emprestimo.Status as status_emprestimo FROM Emprestimo INNER JOIN Item ON Emprestimo.IdItem = Item.Id WHERE Emprestimo.Id = :idEmprestimo");
			}
			
			$stm->execute(array( ':idEmprestimo'  => $idEmprestimo ));
			$resultado = array();
      
      		while ( $obj = $stm->fetch ( PDO::FETCH_ASSOC ) ) {
				$resultado[] = $obj;
			}

			if(isset($resultado)){
				return $resultado[0];
			} else {
				return false;	
			}

		} catch ( PDOException $e ) {
    		echo $e->getMessage ();
		}
	}


	//ALTERA STATUS EMPRESTIMO
	function alteraStatus($idEmprestimo, $status){
		
		if($status == 'Finalizado'){
			
			$stm = $this->banco->prepare("UPDATE Emprestimo SET status = :status WHERE id = :idEmprestimo");
		
		}else{

			$stm = $this->banco->prepare("UPDATE Emprestimo SET status = :status, dataDevolucao = CURRENT_DATE() WHERE id = :idEmprestimo");

		}
		
		try{
			$resultado = $stm->execute(array(':status'       => $status,
                                      		 ':idEmprestimo' => $idEmprestimo
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








	/********************************/


}
?>