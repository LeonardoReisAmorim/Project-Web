<?php
    require_once "../model/cliente.php";
    $objcliente = new Cliente();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Cliente</title>
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
    <h1>Lista de cliente:</h1>
  <br> <br>
  <div class="row">
  <input class="form-control" id="myInput" type="text" placeholder="Pesquise..">
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <td colspan="5">
          <a href="#" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-plus"></span>
        </td>
      </tr>
      <tr>
        <th>Nome</th>
        <th>Idade</th>
        <th>Sexo</th>
        <th>Editar</th>
        <th>Deletar</th>
      </tr>
    </thead>
    <tbody id="myTable">
        <?php
            $sql = "SELECT * FROM cliente";
            $stmt = $objcliente->runQuery($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                while ($rowCliente = $stmt->fetch(PDO::FETCH_ASSOC)){   
        ?>
                <tr>
                    <td> <?php print $rowCliente['nome'] ?> </td>
                    <td> <?php print $rowCliente['idade'] ?></td>
                    <td> <?php print $rowCliente['sexo'] ?></td>


                    <td>
                      <a href="#">
                          <span class="glyphicon glyphicon-pencil" 
                          data-toggle="modal" data-target="#myModaled"
                          data-id_cliente="<?php print $rowCliente['id'] ?>"
                          data-nome_cliente="<?php print $rowCliente["nome"] ?>"
                          data-idade_cliente="<?php print $rowCliente["idade"]?>"></span>
                    </td>


                    <td>
                       <a href="../control/control_cliente.php?delete_id=<?php print $rowCliente["id"]?>">
                          <span class="glyphicon glyphicon-trash"></span>
                    </td>
                </tr>
        <?php
                 }
            }
        ?>
    </tbody>
  </table>
  </div>
  <br>
</div>

<!-- Modal cliente cadastrar comeca-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar Cliente</h4>
      </div>
      <div class="modal-body">
        <form action="../control/control_cliente.php" method="POST">
        <input type="hidden" name="insert" value="1">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="txtnome", name="txtnome", required>
            </div>
            <div class="form-group">
                <label for="idade">Idade</label>
                <input type="number" class="form-control" id="txtidade", name="txtidade", required, min="0", placeholder="Ex: 10">
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select name="txtsexo" id="txtsexo" class="form-control">
                    <option value="m">Masculino</option>
                    <option value="f">Feminino</option>
                </select>
            </div>
              <button type="submit" class="btn btn-primary">Cadastrar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal cliente cadastrar termina-->


<!-- Modal cliente editar comeca-->
<div id="myModaled" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Cliente</h4>
      </div>
      <div class="modal-body">
        <form action="../control/control_cliente.php" method="POST">
        <input type="hidden" name="txteditar" id="cliente_id">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="txtnome", name="txtnome", required>
            </div>
            <div class="form-group">
                <label for="idade">Idade</label>
                <input type="number" class="form-control" id="txtidade", name="txtidade", required, min="0", placeholder="Ex: 10">
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select name="txtsexo" id="txtsexo" class="form-control">
                    <option value="m">Masculino</option>
                    <option value="f">Feminino</option>
                </select>
            </div>
              <button type="submit" class="btn btn-primary">Editar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal cliente editar termina-->

<script>
  $("#myModaled").on('show.bs.modal',function(event){
    var button = $(event.relatedTarget);
    var recipientid = button.data("id_cliente");
    var recipientnome = button.data("nome_cliente");
    var recipientidade = button.data("idade_cliente");

    var modal = $(this);
    modal.find("#cliente_id").val(recipientid);
    modal.find("#txtnome").val(recipientnome);
    modal.find("#txtidade").val(recipientidade);
  })
</script>


<script src="../control/scriptsearch.js"></script>
</body>
</html>
