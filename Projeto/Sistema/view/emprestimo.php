<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Empréstimo</title>
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

                <!--
                <img class="float-right pr-3" src="assets/img/user.png">
                <a class="float-right pr-2 text-decoration-none text-secondary" href="">Sair</a>
                -->
            </div>

        </div>
    </div>

    <div class="container">

        <div class="col-12">

            <h2 class="pb-4">Empréstimo</h2>

            <?php

                if(isset($_GET['erro']) && $_GET['erro'] == 1):

            ?>

                <div class="alert alert-warning" role="alert">
                    
                    <?= $_GET['mensagem']; ?>

                </div>


            <?php

                endif;

            ?>

            <form class="pb-5" action="" method="POST">

                <input type="hidden" name="">

                <div class="row">
                    
                
                    <div class="col-3">

                        <img src="..." class="rounded float-left" alt="...">

                    </div>

                    <div class="col-5">

                        <div class="form-group">

                            <label>Descrição</label>
                            <input type="text" name="descricao" class="form-control">

                        </div>

                        <div class="form-group">

                            <label>Categoria</label>
                            <input type="text" name="categoria" class="form-control">

                        </div>

                        <div class="form-group">

                            <label>Numero de Série</label>
                            <input type="text" name="numeroSerie" class="form-control">

                        </div>

                    </div>

                    <div class="col-4 row">

                        <div class="col-6">
                            <div class="">
                                <h5>Status:</h5>
                            </div>
                            <div>
                                <h5 class="font-weight-bold">Aprovado</h5>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="">
                                <h5>Expira em:</h5>
                            </div>
                            <div>
                                <h5 class="font-weight-bold">10/10/2020</h5>
                            </div>                            
                        </div>

                    </div>

                </div>

                <div class="col-6 p-0">
                    
                    <h2 class="pb-4">Usuário</h2>

                    <div class="form-group" >

                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control">

                    </div>

                    <div class="form-group">

                        <label>E-mail</label>
                        <input type="mail" name="email" class="form-control">

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

                        <div class="form-group col-3 p-0">

                            <label>Numero</label>
                            <input type="text" name="numero" class="form-control">

                        </div>

                        <div class="form-group col-9 p-0 pl-3">

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
                            <input type="text" name="estado" class="form-control">

                        </div>

                    </div>

                    <div class="row col-12 p-0 m-0">

                        <div class="form-group col-6 p-0">

                            <label>Telefone</label>
                            <input type="text" name="tel" class="form-control">

                        </div>

                    </div>

                </div>                

                <button class="btn btn-info btn-lg" type="submit">CADASTRAR</button>

            </form>

        </div>

    </div>

    <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>

</html>