<?php

include("../model/usuario.php");
include("scripts/Bcrypt.php");

$usuario = new Usuario;

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/


$nome        = $_POST['nome'];
$email       = $_POST['email'];
$cpf         = $_POST['cpf'];
$cep         = $_POST['cep'];
$endereco    = $_POST['endereco'];
$numero      = $_POST['numero'];
$bairro      = $_POST['bairro'];
$cidade      = $_POST['cidade'];
$estado      = $_POST['estado'];
$tel         = $_POST['tel'];
$senha       = $_POST['senha'];
$repeteSenha = $_POST['repeteSenha'];


//ADD USUARIO

if(isset($_POST['add_usuario'])){

  $erro = 0;
  $mensagem = "";
   
  if( !isset($nome[1]) ){
    $mensagem .= "O nome deve ter pelo menos 2 caracteres. <br>";
    $erro = 1;
  }

  if( !isset($cpf[10]) ){
    $mensagem .= "Insira o CPF. <br>";
    $erro = 1;
  }
   
  if( !isset($email[3]) ){
    $mensagem .= "Insira o e-mail. <br>";
    $erro = 1;
  }
   
  if( !isset($cep[3]) ){
    $mensagem .= "Insira o CEP. <br>";
    $erro = 1;
  }

  if( !isset($endereco[3]) ){
    $mensagem .= "Insira o endereço. <br>";
    $erro = 1;
  }

  if( !isset($numero[1]) ){
    $mensagem .= "Insira o número do endereço. <br>";
    $erro = 1;
  }

  if( !isset($bairro) ){
    $mensagem .= "Insira o bairro. <br>";
    $erro = 1;
  }

  if( !isset($cidade[1]) ){
    $mensagem .= "Insira a cidade. <br>";
    $erro = 1;
  }

  if( !isset($estado[1]) ){
    $mensagem .= "Insira o estado. <br>";
    $erro = 1;
  }

  if( !isset($senha[5]) ){
    $mensagem .= "Insira uma senha com no mínimo 6 caracteres. <br>";
    $erro = 1;
  }

  if( !isset($repeteSenha[5]) ){
    $mensagem .= "Confirme a senha. <br>";
    $erro = 1;
  }

  if( isset($senha) && isset($repeteSenha) ){


    if( $senha !== $repeteSenha ){

      $mensagem .= "As senhas não conferem. <br>";
      $erro = 1;

    }

  }

   
  if( $usuario->jaCadastrado($email) ){
    $mensagem .= "Esse e-mail já esta em uso.";
    $erro = 1;
  }
   

   if( $erro == 0 ){

      //ENCRIPTOGRAFA A SENHA
      $senha = Bcrypt::hash($senha);

      if( $usuario->addUsuario($nome, $email, $cpf, $cep, $endereco, $numero, $bairro, $cidade, $estado, $tel, $senha) ){

        header('Location: ../');

      }

    }else{

      header('Location: ../view/usuario.php?erro=1&mensagem=' . $mensagem);

    }

}
