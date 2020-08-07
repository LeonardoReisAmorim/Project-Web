<?php
    require_once "../model/quarto.php";
    $objqt = new Quarto();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Quarto</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
    require_once "menu.php";
  ?>
<div class="container">
  <br>
  <h1>Lista de Quartos:</h1>
  <br> <br>
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
<table class="table table-striped">
    <thead>
      <tr>
        <td colspan="5">
          <a href="#" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-plus"></span>
          </a>
        </td>
      </tr>
      <tr>
        <th>Descrição do quarto</th>
        <th>Status do quarto</th>
        <th>Valor do quarto</th>
        <th>Editar</th>
        <th>Deletar</th>
      </tr>
    </thead>
    <tbody id="myTable">
        <?php
            $sql = "SELECT * FROM quarto";
            $stmt = $objqt->runquery($sql);
            $stmt->execute();
            if($stmt->rowCount() >0 ){
                while($rowqt = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
                        <tr>
                            <td><?php print $rowqt['descricao']?></td>
                            <td><?php print $rowqt['status']?></td>
                            <td><?php print $rowqt['valor']?></td>


                            <td>
                                <a href="#">
                                    <span class="glyphicon glyphicon-pencil"
                                    data-toggle="modal" data-target="#myModaled"
                                    data-id_quarto="<?php print $rowqt["id"]?>"
                                    data-desc_qt="<?php print $rowqt["descricao"]?>"
                                    data-valor_qt="<?php print $rowqt["valor"]?>"></span>
                            </td>



                            <td>
                              <a href="../control/control_quarto.php?id_delete=<?php print $rowqt["id"]?>">
                                  <span class="glyphicon glyphicon-trash"></span>
                            </td>
                        </tr>
        <?php
                 }
                }
        ?>
    </tbody>
  </table>
  <br>
</div>


<!--comeca cad Modal quarto-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar quarto</h4>
      </div>
      <div class="modal-body">
        <form action="../control/control_quarto.php" method="POST">
        <input type="hidden" name="insert" value="1">
          <div class="form-group">
            <label for="descricao">Descrição do quarto</label>
            <input type="text" id="txtdescricao" name="txtdescricao" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="status">Status do quarto</label>
            <select name="txtstatus" id="txtstatus" class="form-control">
              <option value="livre">Livre</option>
              <option value="ocupado">Ocupado</option>
            </select>
          </div>
          <div class="form-gruop">
            <label for="valor">Valor do quarto</label>
            <input type="number" id="txtvalor" name="txtvalor" class="form-control" required min="0">
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
      </div>
    </div>

  </div>
</div>
<!--termina cad Modal quarto-->


<!--comeca edit Modal quarto-->
<div id="myModaled" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar quarto</h4>
      </div>
      <div class="modal-body">
        <form action="../control/control_quarto.php" method="POST">
        <input type="hidden" name="edit" id="id_quarto">
          <div class="form-group">
            <label for="descricao">Descrição do quarto:</label>
            <input type="text" id="txtdescricao" name="txtdescricao" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="status">Status do quarto:</label>
            <select name="txtstatus" id="txtstatus" class="form-control">
              <option value="livre">Livre</option>
              <option value="ocupado">Ocupado</option>
            </select>
          </div>
          <div class="form-gruop">
            <label for="valor">Valor do quarto:</label>
            <input type="number" id="txtvalor" name="txtvalor" class="form-control" required min="0">
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Editar</button>
        </form>
      </div>
    </div>

  </div>
</div>
<!--termina edit Modal quarto-->

<script>
$('#myModaled').on('show.bs.modal', function(event){
      var button = $(event.relatedTarget)
      var recipientid = button.data('id_quarto'); 
      var recipientdesc = button.data("desc_qt");
      //var recipientsta = button.data("sta_qt");
      var recipientvalor = button.data("valor_qt");

      var modal = $(this)
      modal.find("#id_quarto").val(recipientid);
      modal.find("#txtdescricao").val(recipientdesc);
      modal.find("#txtvalor").val(recipientvalor);
      //modal.find("#txtstatus").val(recipientsta);
})
</script>



<script src="../control/scriptsearch.js"></script>
</body>
</html>