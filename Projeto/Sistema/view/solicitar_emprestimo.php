<?php


    require_once("../model/banco.php");
    
    $conn = new Banco();

    //Consulta no banco

    $sth = $conn->prepare("SELECT * FROM Item LEFT JOIN Emprestimo ON Item.Id = Emprestimo.idItem WHERE (Emprestimo.Status IS NULL OR Emprestimo.Status LIKE 'Cancelado pelo usuário' OR Emprestimo.Status LIKE 'Finalizado' OR Emprestimo.Status LIKE 'Não Aprovado' OR Emprestimo.Status LIKE 'Devolvido') AND Item.status LIKE 'Disponível' ORDER BY Item.descricao ");
    $sth->execute();

    $result = $sth->fetch(PDO::FETCH_ASSOC);

    $count = $sth->rowCount();

    //echo "<script>alert('$count');</script>";

?>


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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"
        crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        
        

    <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="images/favicon.png">


    <script type="text/javascript">

        $(document).ready(function(){

            //FILTRO PESSOAS
             $("#txtBusca").keyup(function(){
                 var texto = $(this).val();
                 var ultimo = 2;
      
                $("#list-itens .container").css("display", "block");
          
                $("#list-itens .container").each(function(){
                    var busca = $(this).text().replace(/[áàâã]/g,'a').replace(/[éèê]/g,'e').replace(/[í]/g,'i').replace(/[óòôõ]/g,'o').replace(/[úùû]/g,'u').replace(/[ç]/g,'c');
       
                    if(busca.toUpperCase().indexOf(texto.toUpperCase()) < 0){
                        $(this).css("display", "none");
                    }else{
                        ultimo = $(this);
                    } 
                });
      
                
            });

            $('#data_devolucao').datepicker({
                format: "dd/mm/yyyy",
                startDate: "tomorrow",
                language: "pt-BR",
                daysOfWeekDisabled: "6",
                todayHighlight: true
            });

         });

    </script>

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

        <div class="col-12">

            <h2 class="pb-4">Solicitar Novo Empréstimo de Itens</h2>

            <div class="form-group">
                    
                <input type="text" id="txtBusca" name="descricao" class="form-control" placeholder="Filtrar...">

            </div>


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


            <form id="list-itens" class="pb-5" action="../controller/emprestimo_controller.php" method="POST">

                <input type="hidden" name="cad_emprestimo" value="1">

                <?php

                        if($count) { do{
                        
                    ?>
                    <div class="container">
                        <label class="row my-2" for="select<?php echo $result["id"] ?>">
                            <div class="col-1 m-auto">
                                <input class="ml-3" type="radio" name="item_emprestimo" id="select<?php echo $result["id"] ?>" value="<?php echo $result["id"] ?>">
                            </div>
                            <div class="col m-0 p-0 row border rounded">
                                <div>
                                    <img class="m-2 align-middle" style="width: 60px; height: 60px;" src="../fotos/<?php echo $result["foto"] ?> " />
                                </div>                                
                                <p class="col m-auto"><?php echo $result['descricao'] ?></p>
                                <p class="col m-auto"><?php echo $result['categoria'] ?></p>
                                <p class="col m-auto">Nº Série: <?php echo $result['numeroSerie'] ?></p>   
                            </div>
                        </label>
                    </div>                                
                    <?php
                        }                            
                            while ($result = $sth->fetch(PDO::FETCH_ASSOC));
                        }
                    ?>

                    <div class="form-group pt-2 date">

                        <label>Devolução prevista para:</label>


                            <div class="input-group date">
                              <input type="text" class="form-control col-3" name="data_devolucao" id="data_devolucao" placeholder="dd/mm/aaaa"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
   

                    </div>                    


                <button class="btn btn-info btn-lg" type="submit">SOLICITAR EMPRÉSTIMO</button>

            </form>

        </div>

    </div>

    <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>

</html>