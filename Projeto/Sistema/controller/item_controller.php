<?php

include("../model/item.php");

$item = new Item;

$uploaddir = 'C:/xampp/htdocs/SistemaRotary/Projeto/Sistema/fotos/';

echo "<pre>";
print_r($_POST);
echo "</pre>";

echo '--- -------- <br> ';

echo "<pre>";
print_r($_FILES);
echo "</pre>";


$status         = $_POST['status'];
$desc           = $_POST['descricao'];
$categoria      = $_POST['categoria'];
$numeroSerie    = $_POST['numeroSerie'];
$observacaoItem = $_POST['observacaoItem'];

//ADD USUARIO

if(isset($_POST['status'])){

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

}

if( $erro == 0 ){

  if( $item->addItem($status, $desc, $categoria, $numeroSerie, $observacaoItem, $novoNome) ){

       // tenta mover o arquivo para o destino
      if ( @move_uploaded_file ( $_FILES['customFileLang']['tmp_name'], $destino ) ) {
       
          header('Location: ../view/item.php?erro=0&mensagem=Item salvo com sucesso!');

      } else {

        $mensagem .= "Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />";

        header('Location: ../view/item.php?erro=1&mensagem=' . $mensagem);

      }
  }

}else{

    header('Location: ../view/item.php?erro=1&mensagem=' . $mensagem);

}


