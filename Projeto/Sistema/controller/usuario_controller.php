<?php

include("../model/usuario.php");
include("scripts/Bcrypt.php");

$usuario = new Usuario;

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/


//ADD USUARIO

if(isset($_POST['add_usuario'])){

  $erro = 0;
  $mensagem = "";
   
  if( (!isset($_POST['nome'][1])) ){
    $mensagem .= "O nome deve ter pelo menos 2 caracteres. <br>";
    $erro = 1;
  }

  if( (!isset($_POST['cpf'][10])) ){
    $mensagem .= "Insira o CPF. <br>";
    $erro = 1;
  }
   
  if( (!isset($_POST['email'][3])) ){
    $mensagem .= "Insira o e-mail. <br>";
    $erro = 1;
  }
   
  if( (!isset($_POST['cep'][3])) ){
    $mensagem .= "Insira o CEP. <br>";
    $erro = 1;
  }

  if( (!isset($_POST['endereco'][3])) ){
    $mensagem .= "Insira o endereço. <br>";
    $erro = 1;
  }

  if( (!isset($_POST['numero'][1])) ){
    $mensagem .= "Insira o número do endereço. <br>";
    $erro = 1;
  }

  if( (!isset($_POST['bairro'][1])) ){
    $mensagem .= "Insira o bairro. <br>";
    $erro = 1;
  }

  if( (!isset($_POST['cidade'][1])) ){
    $mensagem .= "Insira a cidade. <br>";
    $erro = 1;
  }

  if( (!isset($_POST['estado'][1])) ){
    $mensagem .= "Insira o estado. <br>";
    $erro = 1;
  }

  if( (!isset($_POST['senha'][5])) ){
    $mensagem .= "Insira uma senha com no mínimo 6 caracteres. <br>";
    $erro = 1;
  }

  if( (!isset($_POST['repeteSenha'][5])) ){
    $mensagem .= "Confirme a senha. <br>";
    $erro = 1;
  }

  if( isset($_POST['senha']) && isset($_POST['repeteSenha']) ){


    if($_POST['senha'] !== $_POST['repeteSenha']){

      $mensagem .= "As senhas não conferem. <br>";
      $erro = 1;

    }

  }

   
  if($usuario->jaCadastrado($_POST['email'])){
    $mensagem .= "Esse e-mail já esta em uso.";
    $erro = 1;
  }
   

   if( $erro == 0 ){

      //ENCRIPTOGRAFA A SENHA
      $_POST['senha'] = Bcrypt::hash($_POST['senha']);

      if( $usuario->addUsuario() ){

        header('Location: ../');

      }

    }else{

      header('Location: ../view/usuario.php?erro=1&mensagem=' . $mensagem);

    }

}
