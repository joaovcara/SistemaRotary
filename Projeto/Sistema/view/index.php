<!DOCTYPE html>
<html lang="pt-br">

<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Login - Rotary</title>
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

<body>
  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">

      <div class="col-12 pt-5 pb-5">

        <img src=assets/img/logo.png>

        <h1 class="mt-5 mb-5">Sistema de aluguel de suprimentos ortopédicos.</h1>

        <p>Cadastre-se para solicitar aluguéis de cadeiras de rodas, andadores, cadeiras de banho, bengalas etc, ou faça login
          para gerenciar locações já realizadas.</p>

      </div>

    </div>
    <div class="row align-items-center pb-5">

      <div class="col-6">

        <h2>Login</h2>

        <?php 

          if( isset($_GET['erro']) and $_GET['erro'] != '' ){

              echo '<div class="alert alert-danger" role="alert">'
                      . $_GET['erro'] . '<a href="../view/esqueci_a_senha.php"> Esqueceu a senha?</a>' . 
                    '</div>';

          }

        ?>

        <form action="../controller/valida_login_controller.php" method="POST">

          <div class="form-group">

            <label>Usuário:</label>
            <input type="email" name="usuario" class="form-control" autocomplete>

          </div>

          <div class="form-group">

            <label>Senha:</label>
            <input type="password" name="senha" class="form-control">

          </div>

          <button type="submit" class="btn btn-info btn-lg btn-block">ACESSAR</button>

        </form>

      </div>

      <div class="col-6">

        <h2>Cadastro</h2>

        <form action="cad_usuario.php" method="POST">

          <div class="form-group">

            <label>Nome:</label>
            <input type="text" name="nome" class="form-control">

          </div>

          <div class="form-group">

            <label>E-mail:</label>
            <input type="mail" name="email" class="form-control">

          </div>

          <button type="submit" class="btn btn-info btn-lg btn-block">CADASTRAR</button>

        </form>

      </div>

    </div>

  </div>
  <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>

</html>