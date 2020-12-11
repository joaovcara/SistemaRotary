<?php

require_once("../model/usuario.php");
require_once("scripts/Bcrypt.php");

$usuario = new Usuario;
$email = $_POST['usuario'];


if(isset($email)){


	$nova_senha_temp = generateRandomString($length = 6);
	
	//ENCRIPTOGRAFA A SENHA
    $senha_hash = Bcrypt::hash($nova_senha_temp);

    if( $usuario->alteraSenha($email, $senha_hash) ){

    	mail ($email, 'Senha provisória Rotary' , 'A sua senha provisória é: ' . $nova_senha_temp, 'Content-Type: text/plain; charset=utf-8' . "\r\n");

    	header('Location:../view/esqueci_a_senha.php?erro=Uma senha provisória foi enviada para seu e-mail.');


    }else {

    	header('Location:../view/esqueci_a_senha.php?erro=Não foi possível enviar a nova senha.');

    }


}



function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
