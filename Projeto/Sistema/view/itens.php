<?php

include("../model/usuario.php");

require_once("../model/banco.php"); // Inclui o arquivo com o sistema de segurança
require_once("../model/item.php");

$banco = new Banco;
$banco->protegePagina(); // Chama a funcao que protege a página

$item = new Item();


$itens = $item->listaItens();

/*
echo '<pre>';
print_r($itens);
echo '</pre>';
*/

if( $_SESSION['usuarioTipo'] == 0  ){

  die('Você não tem permissão para adicionar usuários.');

}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Itens - Rotary</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSS & JS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
        crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">


    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>

    <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="images/favicon.png">

</head>

<body style="background: #FAFAFA;">

    <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    
    <?php require('header.php'); ?>

    <div class="container mb-5">

        <div class="col-md-12">

          <?php if(isset($_GET['erro']) && $_GET['erro'] == 1): ?>

                <div class="alert alert-warning" role="alert">
                    
                    <?= $_GET['mensagem']; ?>

                </div>


            <?php endif; ?>

            <?php if(isset($_GET['erro']) && $_GET['erro'] == 0): ?>

                <div class="alert alert-success" role="alert">
                    
                    <?= $_GET['mensagem']; ?>

                </div>


            <?php endif; ?>

           <!-- Admin -->
           <?php if( $_SESSION['usuarioTipo'] == 1 ) : ?>

               <nav>

                    <ul class="nav nav-pills">

                        <li class="nav-item">
                            <a href="principal.php" class="nav-link">EMPRÉSTIMOS</a>
                        </li>
                        <li class="nav-item">
                            <a href="usuarios.php" class="nav-link">USUÁRIOS</a>
                        </li>
                        <li class="nav-item">
                            <a href="itens.php" class="nav-link active">ITENS</a>
                        </li>

                    </ul>

               </nav>

                <a href="cad_item.php" class="float-right btn btn-info mt-3">CADASTRAR ITEM</a>

                <h2 class="mt-5 mb-3">Itens para Empréstimo</h2>

                <?php foreach ($itens as $key => $item) : ?>

                  
                  <div class="container">
                      <label class="row my-2" for="select<?php echo $result["id"] ?>">
                          <div class="col m-0 p-0 pr-3 row border rounded">
                              <div>
                                  <img class="m-2 align-middle" style="width: 60px; height: 60px;" src="../fotos/<?php echo $item["foto"] ?> " />
                              </div>                                
                              <p class="col m-auto"><?php echo $item['descricao'] ?></p>
                              <p class="col m-auto"><?php echo $item['categoria'] ?></p>
                              <p class="col m-auto"><?php echo $item['numeroSerie'] ?></p>
                              <p class="col m-auto"><?php echo $item['status'] ?></p>
                              <a href="detalhes_item.php?id=<?php echo $item['id'] ?>" class="col btn btn-info m-auto ml-1">Detalhes</a>   
                          </div>
                      </label>
                  </div>


               <?php endforeach; ?>
           
           <?php endif;?>

        </div>

        

    </div>

    <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>

</html>