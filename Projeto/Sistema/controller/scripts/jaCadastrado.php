<?php
include ("../../model/banco.php");

$banco = new Banco;
$email = $_GET['email'];

try{
	$stm = $banco->prepare("SELECT email FROM Usuario WHERE email = :email");
	$stm->execute(array(':email'=> $email));
	$resultado = array();
	$obj = $stm->fetch ( PDO::FETCH_ASSOC );
	// Resultados podem ser recuperados atraves de seus atributos
	$resultado[] = $obj;
	if(isset($resultado[0]['email'])){
		$output = true;
	} else {
		$output = false;
	}
} catch ( PDOException $e ) {
	echo $e->getMessage ();
}

echo json_encode($output);