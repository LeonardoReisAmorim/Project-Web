<?php
    require_once "../model/cliente.php";
    require_once "../model/funcionario.php";
    require_once "../model/quarto.php";
    require_once "../model/reserva.php";

    $objcliente = new Cliente();
    $objfuncionario = new Func();
    $objquarto = new Quarto();
    $objreserva = new Reserva();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Reservas feitas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require_once "menu.php";?>
<div class="jumbotron text-center">
  <h1>Lista de reservas feitas</h1>
</div>
  
<div class="container">
  <div class="row">

    <?php
      $sql = "SELECT * FROM quarto
      WHERE status = 'ocupado'";
      $stmt = $objreserva->runquery($sql);
      $stmt->execute();
      if($stmt->rowCount() > 0){
        while($rowqt = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                <h4><?php print $rowqt['descricao']?></h4> </div>
                                <div class="panel-body">
                                  <label for="">Status do quarto:</label>
                                  <?php print $rowqt["status"]?>
                                  <br> <br>
                                  <label for="">Preço do quarto:</label>
                                  <?php print $rowqt["valor"]?>
                                  <br> <br>
                                  <label for="">Numero do quarto:</label>
                                  <?php print $rowqt["id"]?>
                                  <br> <br>
                                    <button
                                    class="btn btn-primary" type="button"
                                    data-toggle="modal" data-target="#myModal"
                                    data-id_quarto="<?php print $rowqt["id"]?>"
                                    >Finalizar</button>
                                    <br>
                                </div>
    </div>
    <?php 
        }
      }
    ?>
  </div>
</div>

<!-- Modal cliente cadastrar comeca-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirmar finalização de reserva</h4>
      </div>
      <div class="modal-body">
      <form action="../control/control_reserva.php" class="form-group" method="POST">
      <input type="hidden" id="id_quarto" name="txtqt">
          <h3>Você deseja finalizar a reserva?</h3>
          <br><br>
              <button type="submit" class="btn btn-primary">Finalizar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal cliente cadastrar termina-->

<script>
    $('#myModal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var recipientid = button.data('id_quarto');

        var modal = $(this);
        modal.find('#id_quarto').val(recipientid);
    })
</script>

</body>
</html>
