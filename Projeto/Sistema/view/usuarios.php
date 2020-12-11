<?php

include("../model/usuario.php");

require_once("../model/banco.php"); // Inclui o arquivo com o sistema de segurança
require_once("../model/usuario.php");

$banco = new Banco;
$banco->protegePagina(); // Chama a funcao que protege a página

$usuario = new Usuario();


$usuarios = $usuario->listaUsuarios();

/*
echo '<pre>';
print_r($usuarios);
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
    <title>Usuários - Rotary</title>
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

        <div class="col-md-12 mb-5">

           <!-- Admin -->
           <?php if( $_SESSION['usuarioTipo'] == 1 ) : ?>

               <nav>

                    <ul class="nav nav-pills">

                        <li class="nav-item">
                            <a href="principal.php" class="nav-link">EMPRÉSTIMOS</a>
                        </li>
                        <li class="nav-item">
                            <a href="usuarios.php" class="nav-link active">USUÁRIOS</a>
                        </li>
                        <li class="nav-item">
                            <a href="itens.php" class="nav-link">ITENS</a>
                        </li>

                    </ul>

               </nav>

                
                <h2 class="mt-5">Usuários</h2>


                <?php foreach ($usuarios as $key => $usu) : ?>

                    <div class="container">
                        <label class="row my-2" for="select<?php echo $result["id"] ?>">
                            <div class="col m-0 p-0 p-2 row border rounded">                          
                                <p class="col m-auto"><?php echo $usu['nome'] ?></p>
                                <p class="col m-auto"><?php echo $usu['email'] ?></p>
                                <p class="col m-auto"><?php echo $usu['cpf'] ?></p>
                                <a href="detalhes_usuario.php?id=<?php echo $usu['id'] ?>" class="col btn btn-info m-auto ml-1">Detalhes</a>   
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