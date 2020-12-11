<?php

include("../model/usuario.php");

require_once("../model/banco.php");
require_once("../model/emprestimo.php");

$banco = new Banco;
$emprestimo = new Emprestimo;

$banco->protegePagina(); // Chama a funcao que protege a página


if($_SESSION['usuarioTipo'] == 0){

    $emprestimos_atuais = $emprestimo->listaEmprestimos($_SESSION['usuarioID'], false);

}else{

    $emprestimos_atuais = $emprestimo->listaEmprestimos($_SESSION['usuarioID'], true);

}




/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Inicio - Rotary</title>
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

    <div class="container">

        <div class="col-md-12">

            <p>Olá, <b><?= $_SESSION['usuarioNome']; ?></b>. </p>

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
                            <a href="#" class="nav-link active">EMPRÉSTIMOS</a>
                        </li>
                        <li class="nav-item">
                            <a href="usuarios.php" class="nav-link">USUÁRIOS</a>
                        </li>
                        <li class="nav-item">
                            <a href="itens.php" class="nav-link">ITENS</a>
                        </li>

                    </ul>

               </nav>

               <?php
                  /*
                  echo '<pre>';
                  print_r($emprestimos_atuais);
                  echo '</pre>';
                  */
                ?>


               <h2 class="mt-5 mb-3">Solicitações de Empréstimos</h2>
               <?php foreach ($emprestimos_atuais as $key => $ea) : ?>

                  <?php
                    $expira = str_replace('/', '-', $ea['Expira']);
                    $expira = date('d/m/Y', strtotime($expira));
                  ?>

                  <?php if($ea['Status'] == 'Solicitado') : ?>
                    <div class="container">
                        <label class="row my-2" for="select<?php echo $result["id"] ?>">
                            <div class="col m-0 p-0 pr-3 row border rounded">
                                <div>
                                    <img class="m-2 align-middle" style="width: 60px; height: 60px;" src="../fotos/<?php echo $ea["foto"] ?> " />
                                </div>                                
                                <p class="col m-auto"><?php echo $ea['descricao'] ?></p>
                                <p class="col m-auto"><?php echo $ea['nome'] ?></p>
                                <p class="col m-auto"><?php echo $ea['cpf'] ?></p>
                                <p class="col m-auto"><?php echo $expira ?></p>
                                <p class="col m-auto"><?php echo $ea['Status'] ?></p>
                                <a href="detalhes_emprestimo.php?id=<?php echo $ea['Id'] ?>" class="col btn btn-info m-auto ml-1">Detalhes</a>   
                            </div>
                        </label>
                    </div>

                  <?php endif; ?>

               <?php endforeach; ?>

               <h2 class="mt-5 mb-3">Empréstimos</h2>
               <?php foreach ($emprestimos_atuais as $key => $ea) : ?>

                <?php
                    $expira = str_replace('/', '-', $ea['Expira']);
                    $expira = date('d/m/Y', strtotime($expira));
                  ?>

                  <?php if($ea['Status'] == 'Aprovado' or $ea['Status'] == 'Devolução Solicitada') : ?>
                    <div class="container">
                        <label class="row my-2" for="select<?php echo $result["id"] ?>">
                            <div class="col m-0 p-0 pr-3 row border rounded">
                                <div>
                                    <img class="m-2 align-middle" style="width: 60px; height: 60px;" src="../fotos/<?php echo $ea["foto"] ?> " />
                                </div>                                
                                <p class="col m-auto"><?php echo $ea['descricao'] ?></p>
                                <p class="col m-auto"><?php echo $ea['nome'] ?></p>
                                <p class="col m-auto"><?php echo $ea['cpf'] ?></p>
                                <p class="col m-auto"><?php echo $expira ?></p>
                                <p class="col m-auto"><?php echo $ea['Status'] ?></p>
                                <a href="detalhes_emprestimo.php?id=<?php echo $ea['Id'] ?>" class="col btn btn-info m-auto ml-1">Detalhes</a>   
                            </div>
                        </label>
                    </div>

                  <?php endif; ?>

               <?php endforeach; ?>

               <h2 class="mt-5 mb-3">Finalizados</h2>
               <?php foreach ($emprestimos_atuais as $key => $ea) : ?>

                  <?php
                    $expira = str_replace('/', '-', $ea['Expira']);
                    $expira = date('d/m/Y', strtotime($expira));
                  ?>

                  <?php if($ea['Status'] == 'Finalizado' or $ea['Status'] == 'Cancelado pelo usuário' or $ea['Status'] == 'Não Aprovado') : ?>
                    <div class="container">
                        <label class="row my-2" for="select<?php echo $result["id"] ?>">
                            <div class="col m-0 p-0 pr-3 row border rounded">
                                <div>
                                    <img class="m-2 align-middle" style="width: 60px; height: 60px;" src="../fotos/<?php echo $ea["foto"] ?> " />
                                </div>                                
                                <p class="col m-auto"><?php echo $ea['descricao'] ?></p>
                                <p class="col m-auto"><?php echo $ea['nome'] ?></p>
                                <p class="col m-auto"><?php echo $ea['cpf'] ?></p>
                                <p class="col m-auto"><?php echo $expira ?></p>
                                <p class="col m-auto"><?php echo $ea['Status'] ?></p>
                                <a href="detalhes_emprestimo.php?id=<?php echo $ea['Id'] ?>" class="col btn btn-info m-auto ml-1">Detalhes</a>   
                            </div>
                        </label>
                    </div>

                  <?php endif; ?>

               <?php endforeach; ?>





           <!-- Usuário normal -->
           <?php else: ?>

                <a href="solicitar_emprestimo.php" class="float-right btn btn-info">NOVO EMPRÉSTIMO</a>
                
                <h2 class="mb-5">Empréstimos</h2>

                <?php

                  /*
                  echo '<pre>';
                  print_r($emprestimos_atuais);
                  echo '</pre>';
                  */
                ?>

                <?php foreach ($emprestimos_atuais as $key => $ea) : ?>

                  <?php
                    $expira = str_replace('/', '-', $ea['Expira']);
                    $expira = date('d/m/Y', strtotime($expira));
                  ?>

                  
                    <div class="container">
                        <label class="row my-2" for="select<?php echo $result["id"] ?>">
                            <div class="col m-0 p-0 pr-3 row border rounded">
                                <div>
                                    <img class="m-2 align-middle" style="width: 60px; height: 60px;" src="../fotos/<?php echo $ea["foto"] ?> " />
                                </div>                                
                                <p class="col m-auto"><?php echo $ea['descricao'] ?></p>
                                <p class="col m-auto"><?php echo $ea['nome'] ?></p>
                                <p class="col m-auto"><?php echo $ea['cpf'] ?></p>
                                <p class="col m-auto"><?php echo $expira ?></p>
                                <p class="col m-auto"><?php echo $ea['Status'] ?></p>


                                <form class="col m-auto" action="../controller/emprestimo_controller.php" method="post">

                                  <input type="hidden" name="acao_user_emprestimo" value="true">
                                  <input type="hidden" name="idEmprestimo" value="<?= $ea['Id']; ?>">

                                  <?php if($ea['Status'] == 'Solicitado') : ?>
                                    <input type="submit" class="btn btn-info" name="acao" value="Cancelar" onclick="return confirmar('Tem certeza que deseja cancelar a solicitação de empréstimo?')">
                                  <?php endif; ?>
                                  <?php if($ea['Status'] == 'Aprovado') : ?>
                                    <input type="submit" class="btn btn-info" name="acao" value="Devolver" onclick="return confirmar('Tem certeza que deseja solicitar a devolução do item?')">
                                  <?php endif; ?>

                                </form>

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

<script type="text/JavaScript">
    function confirmar(msg){
        var agree=confirm(msg);
        if (agree)
            return true ;
        else
            return false ;
    }
</script>


</html>