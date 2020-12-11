<?php

	// Inclui o arquivo com o sistema de segurança
	require_once("../model/banco.php");

	$banco = new Banco;
  
	//Checa versão do PHP.
	if (version_compare(PHP_VERSION, '5.3.0', '<')) {
		echo 'Versão PHP mínima requerida 5.3.0, versão atual: ' . PHP_VERSION . "\n";
		die();
	}

	// Verifica se um formulário foi enviado
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		// Salva duas variáveis com o que foi digitado no formulário
		// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
		$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
		$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';

		if ( $banco->validaUsuario($usuario, $senha) ) {

			// O usuário e a senha digitados foram validados, manda pra página interna
			header("Location: ../view/principal.php");

		} else {

			$banco->expulsaVisitante('Usuário ou senha inválidos.', 'login');
			
		}
	}
