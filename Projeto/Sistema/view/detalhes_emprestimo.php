<?php

include("../model/usuario.php");

require_once("../model/banco.php");
require_once("../model/emprestimo.php");

$banco = new Banco;
$emprestimo = new Emprestimo;

$banco->protegePagina(); // Chama a funcao que protege a página


if($_SESSION['usuarioTipo'] == 0){

    die('Sem permissão de admin!');

}

$emprestimo_detalhe = $emprestimo->listaEmprestimo($_GET['id'], true);


/*
echo '<pre>';
print_r($emprestimo_detalhe);
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
                            <a href="principal.php" class="nav-link active">EMPRÉSTIMOS</a>
                        </li>
                        <li class="nav-item">
                            <a href="usuarios.php" class="nav-link">USUÁRIOS</a>
                        </li>
                        <li class="nav-item">
                            <a href="itens.php" class="nav-link">ITENS</a>
                        </li>

                    </ul>

               </nav>

            <?php endif; ?>

        </div>

        <div class="container mt-5 mb-5">

          <h2 class="mb-5">Empréstimo</h2>

          <div class="row">

              <div class="col-md-3">

                  <img class="w-100" src="../fotos/<?= $emprestimo_detalhe['foto']; ?>">

              </div>

               <div class="col-md-5 pr-3">

                  <div class="mb-3">
                    <label class="form-label">Item</label>
                    <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['descricao']; ?>">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Categoria</label>
                    <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['categoria']; ?>">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Identificador</label>
                    <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['numeroSerie']; ?>">
                  </div>

              </div>

               <div class="col-md-4">

                  <div class="mb-3">
                    <label class="form-label">Status:</label><br>
                    <b class=""><?= $emprestimo_detalhe['status_emprestimo']; ?> </b>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Solicitado em:</label><br>

                    <?php
                      $data = str_replace('/', '-', $emprestimo_detalhe['dataCriacao']);
                      $data = date('d/m/Y', strtotime($data));
                    ?>

                    <b class=""><?= $data; ?> </b>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Previsão de devolução:</label><br>

                    <?php
                      $expira = str_replace('/', '-', $emprestimo_detalhe['Expira']);
                      $expira = date('d/m/Y', strtotime($expira));
                    ?>

                    <b class=""><?= $expira; ?> </b>
                  </div>

                  <?php if($emprestimo_detalhe['status_emprestimo'] == 'Finalizado') :?>

                    <div class="mb-3">
                    <label class="form-label">Devolução em:</label><br>

                    <?php
                      $expira = str_replace('/', '-', $emprestimo_detalhe['dataDevolucao']);
                      $expira = date('d/m/Y', strtotime($expira));
                    ?>

                    <b class=""><?= $expira; ?> </b>
                  </div>


                  <?php endif; ?>

                  <div class="mb-3">

                      <span>Ações</span>

                      <form action="../controller/emprestimo_controller.php" method="post">

                        <input type="hidden" name="acao_detalhe_emprestimo" value="true">
                        <input type="hidden" name="idEmprestimo" value="<?= $_GET['id']; ?>">

                        <?php if($emprestimo_detalhe['status_emprestimo'] == 'Solicitado') : ?>
                          
                          <input type="submit" class="btn btn-success" name="acao" value="Aprovar">

                          <input type="submit" class="btn btn-warning" name="acao" value="Desaprovar">

                        <?php endif; ?>

                        <?php if($emprestimo_detalhe['status_emprestimo'] == 'Aprovado' or $emprestimo_detalhe['status_emprestimo'] == 'Devolução Solicitada') : ?>

                          <input type="submit" class="btn btn-primary" name="acao" value="Fazer devolução">

                        <?php endif; ?>

                      </form>

                  </div>

              </div>

          </div>


          <h2 class="mt-5 mb-3">Empréstimo para</h2>

          <div class="row">

            <div class="col-md-6">
              
              <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['nome']; ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['cpf']; ?>">
              </div>

              <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['email']; ?>">
              </div>

              <div class="row">

                <div class="mb-3 col-md-6">
                  <label class="form-label">Endereço</label>
                  <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['endereco']; ?>">
                </div>

                <div class="mb-3 col-md-6">
                  <label class="form-label">Nº</label>
                  <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['numero']; ?>">
                </div>

              </div>

              <div class="row">

                <div class="mb-3 col-md-6">
                  <label class="form-label">Cidade</label>
                  <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['cidade']; ?>">
                </div>

                <div class="mb-3 col-md-6">
                  <label class="form-label">Estado</label>
                  <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['estado']; ?>">
                </div>
                
              </div>

              <div class="row">

                <div class="mb-3 col-md-6">
                  <label class="form-label">CEP</label>
                  <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['cep']; ?>">
                </div>

                <div class="mb-3 col-md-6">
                  <label class="form-label">Telefone</label>
                  <input type="text" class="form-control" disabled="" value="<?= $emprestimo_detalhe['tel']; ?>">
                </div>
                
              </div>



            </div>

          </div>

        </div>

        

    </div>

    <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>

</html>