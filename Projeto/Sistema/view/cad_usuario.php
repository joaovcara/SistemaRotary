<?php
    
    $nome = "";
    $email = "";

    if(isset($_POST['nome'])){

        $nome = $_POST['nome'];

    }

    if(isset($_POST['email'])){

        $email = $_POST['email'];

    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Usuário</title>
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
    <div class="container-fluid">

        <div class="row mb-5 align-items-center shadow-sm">

            <div class="col-sm"></div>

            <div class="col-sm">

                <img class="rounded mx-auto d-block p-2" src=assets/img/logo.png>

            </div>

            <div class="col-sm">

                <!--
                <img class="float-right pr-3" src="assets/img/user.png">
                <a class="float-right pr-2 text-decoration-none text-secondary" href="">Sair</a>
                -->
            </div>

        </div>
    </div>

    <div class="container">

        <div class="col-6">

            <h2 class="pb-4">Cadastro de Usuário</h2>

            <?php

                if(isset($_GET['erro']) && $_GET['erro'] == 1):

            ?>

                <div class="alert alert-warning" role="alert">
                    
                    <?= $_GET['mensagem']; ?>

                </div>


            <?php

                endif;

            ?>

            <form class="pb-5" action="../controller/usuario_controller.php" method="POST">

                <input type="hidden" name="add_usuario">

                <div class="form-group" >

                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control"  value="<?= $nome; ?>">

                </div>

                <div class="form-group">

                    <label>E-mail</label>
                    <input type="mail" name="email" class="form-control"  value="<?= $email; ?>">

                </div>

                <div class="form-group">

                    <label>CPF</label>
                    <input type="text" name="cpf" class="form-control">

                </div>

                <div class="form-group pt-3">

                    <div class="form-group col-6 p-0">

                        <label>CEP</label>                            
                        <input type="text" name="cep" class="form-control">

                    </div>

                    <label>Endereço</label>
                    <input type="text" name="endereco" class="form-control">

                </div>

                <div class="row col-12 p-0 m-0">

                    <div class="form-group col-6 p-0">

                        <label>Numero</label>
                        <input type="text" name="numero" class="form-control">

                    </div>

                    <div class="form-group col-6 p-0 pl-3">

                        <label>Bairro</label>
                        <input type="text" name="bairro" class="form-control">

                    </div>

                </div>

                <div class="row col-12 p-0 m-0">

                    <div class="form-group col-6 p-0">

                        <label>Cidade</label>
                        <input type="text" name="cidade" class="form-control">

                    </div>

                    <div class="form-group col-6 p-0 pl-3">

                        <label>Estado</label>
                        <select id="estado" name="estado" class="form-control">
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP" selected="selected">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                            <option value="EX">Estrangeiro</option>
                        </select>

                    </div>

                </div>

                <div class="row col-12 p-0 m-0">



                    <div class="form-group col-6 p-0">

                        <label>Telefone</label>
                        <input type="text" name="tel" class="form-control">

                    </div>

                </div>

                <div class="form-group pt-3">

                    <label>Senha</label>
                    <input type="password" name="senha" class="form-control">

                </div>

                <div class="form-group">

                    <label>Repetir Senha</label>
                    <input type="password" name="repeteSenha" class="form-control">

                </div>

                <button class="btn btn-info btn-lg" type="submit">CADASTRAR</button>

            </form>

        </div>

    </div>

    <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>

</html>