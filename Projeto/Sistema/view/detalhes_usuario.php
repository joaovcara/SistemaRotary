<?php

include("../model/usuario.php");

require_once("../model/banco.php");

$banco = new Banco;
$usuario = new Usuario;

$banco->protegePagina(); // Chama a funcao que protege a página


if($_SESSION['usuarioTipo'] == 1){

    //Se for admin, consulta qualquer um
    $usu_detalhe = $usuario->buscaUsuarioId($_GET['id']);

}else{

    //Se não for admin só consulta a si proprio.
    $usu_detalhe = $usuario->buscaUsuarioId($_SESSION['usuarioID']);

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
    <title>Usuário - Detalhes</title>
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

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

     <script type="text/javascript">
         
        $(document).ready(function(){
            $('input[name=cpf]').mask('999.999.999-99');
            $('input[name=cep]').mask('99999-999');
            $("input[name=tel]")
                .mask("(99) 9999-9999?9")
                .focusout(function (event) {  
                    var target, phone, element;  
                    target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
                    phone = target.value.replace(/\D/g, '');
                    element = $(target);  
                    element.unmask();  
                    if(phone.length > 10) {  
                        element.mask("(99) 99999-999?9");  
                    } else {  
                        element.mask("(99) 9999-9999?9");  
                    }  
                });
            });

     </script>

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

            <h2 class="pb-4">Editar Usuário</h2>

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

            <form class="pb-5" action="../controller/usuario_controller.php" method="POST">

                <input type="hidden" name="edit_user">
                <input type="hidden" name="id_user" value="<?= $_GET['id']; ?>"> 

                <div class="form-group">

                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" value="<?= $usu_detalhe['nome']; ?>">

                </div>

                <div class="form-group">

                    <label>E-mail</label>
                    <input type="text" name="email" class="form-control" value="<?= $usu_detalhe['email']; ?>" readonly="readonly">

                </div>

                <div class="form-group">

                    <label>CPF</label>
                    <input type="text" name="cpf" class="form-control" value="<?= $usu_detalhe['cpf']; ?>" readonly="readonly">

                </div>

                 <div class="form-group">

                    <label>CEP</label>
                    <input type="text" name="cep" class="form-control" value="<?= $usu_detalhe['cep']; ?>">

                </div>

                <div class="form-group">

                    <label>Endereço</label>
                    <input type="text" name="endereco" class="form-control" value="<?= $usu_detalhe['endereco']; ?>">

                </div>

                 <div class="row col-12 p-0 m-0">

                    <div class="form-group col-6 p-0">

                        <label>Numero</label>
                        <input type="number" name="numero" class="form-control" value="<?= $usu_detalhe['numero']; ?>">

                    </div>

                    <div class="form-group col-6 p-0 pl-3">

                        <label>Bairro</label>
                        <input type="text" name="bairro" class="form-control" value="<?= $usu_detalhe['bairro']; ?>">

                    </div>

                </div>

                <div class="row col-12 p-0 m-0">

                    <div class="form-group col-6 p-0">

                        <label>Cidade</label>
                        <input type="text" name="cidade" class="form-control" value="<?= $usu_detalhe['cidade']; ?>">

                    </div>

                    <div class="form-group col-6 p-0 pl-3">

                        <label>Estado</label>
                        <select name="estado" class="form-control">
                            <option value="AC" <?= ($usu_detalhe['estado'] == 'AC' ? 'selected' : '') ?>>Acre</option>
                            <option value="AL" <?= ($usu_detalhe['estado'] == 'AL' ? 'selected' : '') ?>>Alagoas</option>
                            <option value="AP" <?= ($usu_detalhe['estado'] == 'AP' ? 'selected' : '') ?>>Amapá</option>
                            <option value="AM" <?= ($usu_detalhe['estado'] == 'AM' ? 'selected' : '') ?>>Amazonas</option>
                            <option value="BA" <?= ($usu_detalhe['estado'] == 'BA' ? 'selected' : '') ?>>Bahia</option>
                            <option value="CE" <?= ($usu_detalhe['estado'] == 'CE' ? 'selected' : '') ?>>Ceará</option>
                            <option value="DF" <?= ($usu_detalhe['estado'] == 'DF' ? 'selected' : '') ?>>Distrito Federal</option>
                            <option value="ES" <?= ($usu_detalhe['estado'] == 'ES' ? 'selected' : '') ?>>Espírito Santo</option>
                            <option value="GO" <?= ($usu_detalhe['estado'] == 'GO' ? 'selected' : '') ?>>Goiás</option>
                            <option value="MA" <?= ($usu_detalhe['estado'] == 'MA' ? 'selected' : '') ?>>Maranhão</option>
                            <option value="MT" <?= ($usu_detalhe['estado'] == 'MT' ? 'selected' : '') ?>>Mato Grosso</option>
                            <option value="MS" <?= ($usu_detalhe['estado'] == 'MS' ? 'selected' : '') ?>>Mato Grosso do Sul</option>
                            <option value="MG" <?= ($usu_detalhe['estado'] == 'MG' ? 'selected' : '') ?>>Minas Gerais</option>
                            <option value="PA" <?= ($usu_detalhe['estado'] == 'PA' ? 'selected' : '') ?>>Pará</option>
                            <option value="PB" <?= ($usu_detalhe['estado'] == 'PB' ? 'selected' : '') ?>>Paraíba</option>
                            <option value="PR" <?= ($usu_detalhe['estado'] == 'PR' ? 'selected' : '') ?>>Paraná</option>
                            <option value="PE" <?= ($usu_detalhe['estado'] == 'PE' ? 'selected' : '') ?>>Pernambuco</option>
                            <option value="PI" <?= ($usu_detalhe['estado'] == 'PI' ? 'selected' : '') ?>>Piauí</option>
                            <option value="RJ" <?= ($usu_detalhe['estado'] == 'RJ' ? 'selected' : '') ?>>Rio de Janeiro</option>
                            <option value="RN" <?= ($usu_detalhe['estado'] == 'RN' ? 'selected' : '') ?>>Rio Grande do Norte</option>
                            <option value="RS" <?= ($usu_detalhe['estado'] == 'RS' ? 'selected' : '') ?>>Rio Grande do Sul</option>
                            <option value="RO" <?= ($usu_detalhe['estado'] == 'RO' ? 'selected' : '') ?>>Rondônia</option>
                            <option value="RR" <?= ($usu_detalhe['estado'] == 'RR' ? 'selected' : '') ?>>Roraima</option>
                            <option value="SC" <?= ($usu_detalhe['estado'] == 'SC' ? 'selected' : '') ?>>Santa Catarina</option>
                            <option value="SP" <?= ($usu_detalhe['estado'] == 'SP' ? 'selected' : '') ?>>São Paulo</option>
                            <option value="SE" <?= ($usu_detalhe['estado'] == 'SE' ? 'selected' : '') ?>>Sergipe</option>
                            <option value="TO" <?= ($usu_detalhe['estado'] == 'TO' ? 'selected' : '') ?>>Tocantins</option>
                            <option value="EX" <?= ($usu_detalhe['estado'] == 'EX' ? 'selected' : '') ?>>Estrangeiro</option>
                         </select>



                    </div>

                </div>

                <div class="form-group">

                    <label>Telefone</label>
                    <input type="text" name="tel" class="form-control" value="<?= $usu_detalhe['tel']; ?>">

                </div>

                <div class="form-group">

                    <label>Senha</label>
                    <input type="password" name="senha" class="form-control">
                    <small>Deixe em branco para não alterar.</small>

                </div>

               
                <input type="submit" class="btn btn-success btn-lg mt-3" value="SALVAR" name="salvar-edicaoes">
                <a href="principal.php" class="btn btn-info btn-lg mt-3">CANCELAR</a>

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