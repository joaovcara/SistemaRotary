<?php

require_once("../model/usuario.php");
require_once("scripts/Bcrypt.php");
require_once("../model/banco.php");

$banco = new Banco;
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
      $senha_hash = Bcrypt::hash($senha);

      if( $usuario->addUsuario($nome, $email, $cpf, $cep, $endereco, $numero, $bairro, $cidade, $estado, $tel, $senha_hash) ){

        if( $banco->validaUsuario($email, $senha) ){

            header('Location: ../view/principal.php');

        }else{

          echo 'Erro ao logar';
          die();

        }


      }

    }else{

      header('Location: ../view/usuario.php?erro=1&mensagem=' . $mensagem);

    }

}


//EDITAR USUARIO
if(isset($_POST['edit_user'])){


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

  if( $erro == 0 ){

    if($_SESSION['usuarioTipo'] == 1){

      $id = $_POST['id_user'];

    } else {

      $id = $_SESSION['usuarioID'];

    }

    if( isset($senha) and $senha != '' ){

      //ENCRIPTOGRAFA A SENHA
      $senha_hash = Bcrypt::hash($senha);

      if($usuario->editUsuario($id, $nome, $cep, $endereco, $numero, $bairro, $cidade, $estado, $tel, $senha_hash)){

        header('Location: ../view/detalhes_usuario.php?id=' . $id . '&erro=0&mensagem=Alterado com sucesso!');

      }else{

        header('Location: ../view/detalhes_usuario.php?id=' . $id . '&erro=1&mensagem=Não foi possivel alterar!');

      }


    }else{

      if($usuario->editUsuario($id, $nome, $cep, $endereco, $numero, $bairro, $cidade, $estado, $tel)){

        header('Location: ../view/detalhes_usuario.php?id=' . $id . '&erro=0&mensagem=Alterado com sucesso!');

      }else{

        header('Location: ../view/detalhes_usuario.php?id=' . $id . '&erro=1&mensagem=Não foi possivel alterar!');

      }


    }

    


  }else{

      header('Location: ../view/detalhes_usuario.php?id=' . $id . '&erro=1&mensagem=' . $mensagem);

  }

}