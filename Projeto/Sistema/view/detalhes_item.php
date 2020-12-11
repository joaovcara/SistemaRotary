<?php

include("../model/usuario.php");

require_once("../model/banco.php");
require_once("../model/item.php");

$banco = new Banco;
$item = new Item;

$banco->protegePagina(); // Chama a funcao que protege a página


if($_SESSION['usuarioTipo'] == 0){

    die('Sem permissão de admin!');

}

$item_detalhe = $item->listaItem($_GET['id']);

/*
echo '<pre>';
print_r($item_detalhe);
echo '</pre>';
*/

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Item - Detalhes</title>
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
    
    <?php require('header.php'); ?>

    <div class="container">

        <div class="col-6">

            <h2 class="pb-4">Editar Item</h2>

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

            <img src="../fotos/<?= $item_detalhe['foto']; ?>" class="w-50">

            <form class="pb-5" enctype="multipart/form-data" action="../controller/item_controller.php" method="POST">

                <input type="hidden" name="edit_item">
                <input type="hidden" name="id_item" value="<?= $_GET['id']; ?>"> 
                <input type="hidden" name="foto_atual" value="<?= $item_detalhe['foto']; ?>">

                <div class="form-group">
                    
                    <label>Status</label>
                        
                    <select class="form-control" id="exampleFormControlSelect1" name="status">
                        <option <?= ($item_detalhe['status'] == 'Disponível' ? 'selected' : '') ?> >Disponível</option>
                        <option <?= ($item_detalhe['status'] == 'Indisponível' ? 'selected' : '') ?> >Indisponível</option>
                    </select>

                </div>

                <div class="form-group">

                    <label>Descrição</label>
                    <input type="text" name="descricao" class="form-control" value="<?= $item_detalhe['descricao']; ?>">

                </div>

                <div class="form-group">

                    <label>Categoria</label>
                    <input type="text" name="categoria" class="form-control" value="<?= $item_detalhe['categoria']; ?>">

                </div>

                <div class="form-group">

                    <label>Número de Série</label>
                    <input type="text" name="numeroSerie" class="form-control" value="<?= $item_detalhe['numeroSerie']; ?>">

                </div>

                <div  class="form-group">

                    <label>Observações do Item</label>
                    <textarea class="form-control" id="observacaoItem" rows="3" name="observacaoItem"><?= $item_detalhe['observacaoItem']; ?></textarea>

                </div>

                <div class="custom-file">

                    <label>Imagem</label>

                    <input type="file" class="custom-file-input" id="customFileLang" lang="pt-br" name="customFileLang">                    
                    <label class="custom-file-label mt-4" for="customFileLang">Selecionar Imagem</label>

                    <small>Deixe em branco para manter a foto atual.</small>

                </div>

                <input type="submit" class="btn btn-success btn-lg mt-3" value="SALVAR" name="salvar-edicaoes">
                <input type="submit" class="btn btn-danger btn-lg mt-3" onclick="return confirmar('Tem certeza que deseja excluir o item?')" value="EXLUIR ITEM?" name="excluir">
                <a href="itens.php" class="btn btn-info btn-lg mt-3">CANCELAR</a>

            </form>

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