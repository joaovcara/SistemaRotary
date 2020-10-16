<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Item</title>
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
    <div class="container-fluid">

        <div class="row mb-5 align-items-center shadow-sm">

            <div class="col-sm"></div>

            <div class="col-sm">

                <img class="rounded mx-auto d-block p-2" src=assets/img/logo.png>

            </div>

            <div class="col-sm">
                
                <img class="float-right pr-3" src="assets/img/user.png">
                <a class="float-right pr-2 text-decoration-none text-secondary" href="">Sair</a>
                
            </div>

        </div>
    </div>

    <div class="container">

        <div class="col-6">

            <h2 class="pb-4">Cadastro de Itens</h2>

            <?php

                if(isset($_GET['erro']) && $_GET['erro'] == 1):

            ?>

                <div class="alert alert-warning" role="alert">
                    
                    <?= $_GET['mensagem']; ?>

                </div>


            <?php

                endif;

            ?>

            <?php

                if(isset($_GET['erro']) && $_GET['erro'] == 0):

            ?>

                <div class="alert alert-success" role="alert">
                    
                    <?= $_GET['mensagem']; ?>

                </div>


            <?php

                endif;

            ?>


            <form class="pb-5" enctype="multipart/form-data" action="../controller/item_controller.php" method="POST">

                <input type="hidden" name="cad_item">

                <div class="form-group">
                    
                    <label>Status</label>
                        
                    <select class="form-control" id="exampleFormControlSelect1" name="status">
                        <option>Disponível</option>
                        <option>Indisponível</option>
                    </select>

                </div>

                <div class="form-group">

                    <label>Descrição</label>
                    <input type="text" name="descricao" class="form-control">

                </div>

                <div class="form-group">

                    <label>Categoria</label>
                    <input type="text" name="categoria" class="form-control">

                </div>

                <div class="form-group">

                    <label>Número de Série</label>
                    <input type="text" name="numeroSerie" class="form-control">

                </div>

                <div  class="form-group">

                    <label>Observações do Item</label>
                    <textarea class="form-control" id="observacaoItem" rows="3" name="observacaoItem"></textarea>

                </div>

                <div class="custom-file">

                    <label>Imagem</label>
                    <input type="file" class="custom-file-input" id="customFileLang" lang="pt-br" name="customFileLang">                    
                    <label class="custom-file-label" for="customFileLang">Selecionar Imagem</label>

                </div>

                <button class="btn btn-info btn-lg" type="submit">CADASTRAR</button>

            </form>

        </div>

    </div>

    <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>

</html>