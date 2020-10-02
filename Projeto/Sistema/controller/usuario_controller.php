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
    $mensagem .= "O nome deve ter pelo menos 2 caracteres. \n";
    $erro = 1;
  }

  if( (!isset($_POST['cpf'][10])) ){
    $mensagem .= "Insira o CPF. \n";
    $erro = 1;
  }
   
  if( (!isset($_POST['email'][3])) ){
    $mensagem .= "Insira o e-mail. \n";
    $erro = 1;
  }
   
  if( (!isset($_POST['cep'][3])) ){
    $mensagem .= "Insira o CEP. \n";
    $erro = 1;
  }

  if( (!isset($_POST['endereco'][3])) ){
    $mensagem .= "Insira o endereço. \n";
    $erro = 1;
  }

  if( (!isset($_POST['numero'][1])) ){
    $mensagem .= "Insira o número do endereço. \n";
    $erro = 1;
  }

  if( (!isset($_POST['bairro'][1])) ){
    $mensagem .= "Insira o bairro. \n";
    $erro = 1;
  }

  if( (!isset($_POST['cidade'][1])) ){
    $mensagem .= "Insira a cidade. \n";
    $erro = 1;
  }

  if( (!isset($_POST['estado'][1])) ){
    $mensagem .= "Insira o estado. \n";
    $erro = 1;
  }

  if( (!isset($_POST['senha'][6])) ){
    $mensagem .= "Insira uma senha com no mínimo 6 caracteres. \n";
    $erro = 1;
  }

  if( (!isset($_POST['repeteSenha'][6])) ){
    $mensagem .= "Confirme a senha. \n";
    $erro = 1;
  }

  if( isset($_POST['senha']) && isset($_POST['repeteSenha']) ){


    if($_POST['senha'] !== $_POST['repeteSenha']){

      $mensagem .= "As senhas não conferem. \n";
      $erro = 1;

    }

  }

   
  if($usuario->jaCadastrado($_POST['email'])){
    $mensagem .= "Esse e-mail já esta em uso.";
    $erro = 1;
  }

  
   
   //ENCRIPTOGRAFA A SENHA
   $_POST['senha'] = Bcrypt::hash($_POST['senha']);
   
   if( ($erro == 0) and ($_SESSION['usuarioTipo'] == 0) ){
     if($usuario->addUsuario($_SESSION['usuarioIdEmpresa'], $_POST['setor'], $_POST['nome'], $_POST['email'], $_POST['senha'])){
       header('Location: ../admin_add_usuario.php?mensagem=1');
     }else{
        echo "erro ao cadastrar"; 
     }
   }
}
