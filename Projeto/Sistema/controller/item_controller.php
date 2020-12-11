<?php

include("../model/item.php");

$item = new Item;

$uploaddir = '../fotos/';

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";

echo '--- -------- <br> ';

echo "<pre>";
print_r($_FILES);
echo "</pre>";

die();

*/

$status         = $_POST['status'];
$desc           = $_POST['descricao'];
$categoria      = $_POST['categoria'];
$numeroSerie    = $_POST['numeroSerie'];
$observacaoItem = $_POST['observacaoItem'];



if($_SESSION['usuarioTipo'] == 0){

    die('Sem permissão de admin!');

}


//ADD ITEM
if(isset($_POST['cad_item'])){

  $erro = 0;
  $mensagem = "";
   
  if( !isset($desc[1]) ){
    $mensagem .= "A descrição deve ter pelo menos 2 caracteres. <br>";
    $erro = 1;
  }

  if( !isset($categoria[2]) ){
    $mensagem .= "Insira a categoria. <br>";
    $erro = 1;
  }
   
  if( !isset($numeroSerie[3]) ){
    $mensagem .= "Insira o n de série. <br>";
    $erro = 1;
  }
  
  if ( !isset($_FILES['customFileLang']['name'][1]) ){
    $mensagem .= "Erro na imagem. <br>";
    $erro = 1;

  }else{

    // Pega a extensão
    $extensao = pathinfo ( $_FILES['customFileLang']['name'], PATHINFO_EXTENSION );
    $extensao = strtolower ( $extensao );

     if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;

        $destino = $uploaddir . '/' . $novoNome;
            
      } else {

           $mensagem .= "Você poderá enviar apenas arquivos .jpg, .jpeg, .gif ou .png <br />'";
           $erro = 1;
      }

  }

  if( $erro == 0 ){

    if( $item->addItem($status, $desc, $categoria, $numeroSerie, $observacaoItem, $novoNome) ){

         // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $_FILES['customFileLang']['tmp_name'], $destino ) ) {
         
            header('Location: ../view/itens.php?erro=0&mensagem=Item salvo com sucesso!');

        } else {

          $mensagem .= "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";

          header('Location: ../view/itens.php?erro=1&mensagem=' . $mensagem);

        }
    }

  }else{

      header('Location: ../view/itens.php?erro=1&mensagem=' . $mensagem);

  }

}


//EDITA ITEM
if( isset($_POST['edit_item']) and isset($_POST['salvar-edicaoes']) ){

  $erro = 0;
  $mensagem = "";

  $id         = $_POST['id_item'];
  $foto_atual = $_POST['foto_atual'];
   
  if( !isset($desc[1]) ){
    $mensagem .= "A descrição deve ter pelo menos 2 caracteres. <br>";
    $erro = 1;
  }

  if( !isset($categoria[2]) ){
    $mensagem .= "Insira a categoria. <br>";
    $erro = 1;
  }
   
  if( !isset($numeroSerie[3]) ){
    $mensagem .= "Insira o n de série. <br>";
    $erro = 1;
  }
  
  if ( isset($_FILES['customFileLang']['name'][1]) ){
    
    // Pega a extensão
    $extensao = pathinfo ( $_FILES['customFileLang']['name'], PATHINFO_EXTENSION );
    $extensao = strtolower ( $extensao );

     if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) . '.' . $extensao;

        $destino = $uploaddir . '/' . $novoNome;
            
      } else {

           $mensagem .= "Você poderá enviar apenas arquivos .jpg, .jpeg, .gif ou .png <br />'";
           $erro = 1;
      }
      
      
  }

  if( $erro == 0 ){

    if(isset($novoNome)){

      if( $item->editItem($id, $status, $desc, $categoria, $numeroSerie, $observacaoItem, $novoNome) ){

           // tenta mover o arquivo para o destino
          if ( @move_uploaded_file ( $_FILES['customFileLang']['tmp_name'], $destino ) ) {

              //Apaga a imagem antiga
              unlink('../fotos/' . $foto_atual);
           
              header('Location: ../view/detalhes_item.php?id=' . $id . '&erro=0&mensagem=Item alterado com sucesso!');

          } else {

            $mensagem .= "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";

            header('Location: ../view/detalhes_item.php?id=' . $id . '&erro=1&mensagem=' . $mensagem);

          }
      }

    }else{

      if( $item->editItem($id, $status, $desc, $categoria, $numeroSerie, $observacaoItem, $foto_atual) ){


        header('Location: ../view/detalhes_item.php?id=' . $id . '&erro=0&mensagem=Item alterado com sucesso!');

      } else {

            $mensagem .= "Erro ao alterar item.<br />";

            header('Location: ../view/detalhes_item.php?id=' . $id . '&erro=1&mensagem=' . $mensagem);
      }

    }

  }else{

      header('Location: ../view/detalhes_item.php?erro=1&mensagem=' . $mensagem);

  }

}


//EXCLUIR ITEM
if( isset($_POST['edit_item']) and isset($_POST['excluir']) ){


  $id         = $_POST['id_item'];
  $foto_atual = $_POST['foto_atual'];


  if(!$item->checkItem($id)){


    $mensagem .= "Erro ao excluir item.<br />";
    $mensagem .= "Não é possível excluir itens com empréstimos ativos, solicitados, ou em processo de devolução.";

    header('Location: ../view/detalhes_item.php?id=' . $id . '&erro=1&mensagem=' . $mensagem);


  }else{


    if( $item->deleteItem($id) ){

      //Apaga a imagem
      unlink('../fotos/' . $foto_atual);
             
      header('Location: ../view/itens.php?&erro=0&mensagem=Item excluido com sucesso!');

    } else {

        $mensagem .= "Erro ao excluir item.<br />";

        header('Location: ../view/detalhes_item.php?erro=1&mensagem=' . $mensagem);

    }

  }

}