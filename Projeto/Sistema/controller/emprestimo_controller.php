<?php

include("../model/banco.php");
include("../model/emprestimo.php");

$banco = new Banco();
$emprestimo = new Emprestimo;

$banco->protegePagina();

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
die();
*/

$idUsuario      = $_SESSION['usuarioID'];
$idItem         = $_POST['item_emprestimo'];
$data_devolucao = $_POST['data_devolucao'];


//ADD EMPRESTIMO
if(isset($_POST['cad_emprestimo'])){

  $erro = 0;
  $mensagem = "";
   
  if( !isset($idUsuario) ){
    $mensagem .= "Erro ao linkar usuario. <br>";
    $erro = 1;
  }

  if( !isset($idItem) ){
    $mensagem .= "Erro ao linkar item. <br>";
    $erro = 1;
  }

  if( !isset($data_devolucao) or $data_devolucao == '' ){

    $mensagem .= "A data é necessária. <br>";
    $erro = 1;

  }else{

    $data_devolucao = str_replace('/', '-', $data_devolucao);
    $data_devolucao = date('Y/m/d', strtotime($data_devolucao));

  }


  if( $erro == 0 ){

    if( $emprestimo->addEmprestimo($idItem, $idUsuario, $data_devolucao, 'Solicitado') ){

      header('Location: ../view/principal.php?erro=0&mensagem=Emprestimo solicitado com sucesso!');

    }else{

      header('Location: ../view/solicitar_emprestimo.php?erro=0&mensagem=Erro ao solicitar emprestimo!');

    }

  }else{

      header('Location: ../view/solicitar_emprestimo.php?erro=1&mensagem=' . $mensagem);

  }

}

//ALTERAR STATUS USER
if(isset($_POST['acao_user_emprestimo'])){

  if($_POST['acao'] == 'Cancelar'){
    
    if($emprestimo->alteraStatus($_POST['idEmprestimo'], 'Cancelado pelo usuário')){

      header('Location: ../view/principal.php?id=' . $_POST['idEmprestimo'] . '&erro=0&mensagem=Cancelado com sucesso!');

    }else{

      header('Location: ../view/principal.php?id=' . $_POST['idEmprestimo'] . '&erro=1&mensagem=Erro ao alterar');

    }
  
  }

  if($_POST['acao'] == 'Devolver'){
    
    if($emprestimo->alteraStatus($_POST['idEmprestimo'], 'Devolução Solicitada')){

      header('Location: ../view/principal.php?id=' . $_POST['idEmprestimo'] . '&erro=0&mensagem=Solicitação de devolução feita com sucesso! <b>Agora basta levar o item até nossa sede.</b>');

    }else{

      header('Location: ../view/principal.php?id=' . $_POST['idEmprestimo'] . '&erro=1&mensagem=Erro ao alterar');

    }
  
  }


}


//ALTERAR STATUS ADMIN
if(isset($_POST['acao_detalhe_emprestimo']) and $_SESSION['usuarioTipo'] == 1){

  if($_POST['acao'] == 'Aprovar'){
    
    if($emprestimo->alteraStatus($_POST['idEmprestimo'], 'Aprovado')){

      header('Location: ../view/detalhes_emprestimo.php?id=' . $_POST['idEmprestimo'] . '&erro=0&mensagem=Emprestimo aprovado com sucesso!');

    }else{

      header('Location: ../view/detalhes_emprestimo.php?id=' . $_POST['idEmprestimo'] . '&erro=1&mensagem=Erro ao alterar');

    }
  
  }

  if($_POST['acao'] == 'Desaprovar'){
    
    if($emprestimo->alteraStatus($_POST['idEmprestimo'], 'Não Aprovado')){

      header('Location: ../view/detalhes_emprestimo.php?id=' . $_POST['idEmprestimo'] . '&erro=0&mensagem=Emprestimo desaprovado com sucesso!');

    }else{

      header('Location: ../view/detalhes_emprestimo.php?id=' . $_POST['idEmprestimo'] . '&erro=1&mensagem=Erro ao alterar');

    }
  
  }

  if($_POST['acao'] == 'Fazer devolução'){
    
    if($emprestimo->alteraStatus($_POST['idEmprestimo'], 'Finalizado')){

      header('Location: ../view/detalhes_emprestimo.php?id=' . $_POST['idEmprestimo'] . '&erro=0&mensagem=Emprestimo devolvido com sucesso!');

    }else{

      header('Location: ../view/detalhes_emprestimo.php?id=' . $_POST['idEmprestimo'] . '&erro=1&mensagem=Erro ao alterar');

    }
  
  }


}

