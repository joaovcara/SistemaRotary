<!DOCTYPE html>
<html lang="pt-br">

<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Esqueci a senha - Rotary</title>
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

        <p>Insira seu e-mail para receber uma senha provisória.</p>

      </div>

    </div>
    <div class="row align-items-center pb-5">

      <div class="col-6">

        <?php 

          if( isset($_GET['erro']) and $_GET['erro'] != '' ){

              echo '<div class="alert alert-info" role="alert">'
                      . $_GET['erro'] . '</div>';

          }

        ?>

        <form action="../controller/esqueci_senha_controller.php" method="POST">

          <div class="form-group">

            <label>Seu e-mail cadastrado:</label>
            <input type="email" name="usuario" class="form-control" placeholder="email@exemplo.com" autocomplete>

          </div>


          <button type="submit" class="btn btn-info btn-block">ENVIAR E-MAIL COM SENHA PROVISÓRIA</button>
          <a href="index.php" class="btn btn-info btn-block">VOLTAR</a>

        </form>

      </div>

    </div>

  </div>
  <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>

</html>