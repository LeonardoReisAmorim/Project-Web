<?php
    require_once "../model/funcionario.php";
    $objfunc = new Func();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Funcionario</title>
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
  <h1>Lista de Funcionarios:</h1>
      
  <br><br>
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
        <th>Telefone</th>
        <th>Editar</th>
        <th>Deletar</th>
        
      </tr>
    </thead>
    <tbody id="myTable">
        <?php
            $sql = "SELECT * FROM funcionario";
            $stmt = $objfunc->runquery($sql);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                while($rowfunc = $stmt->fetch(PDO::FETCH_ASSOC)){            
        ?>
                        <tr>
                            <td><?php print $rowfunc['nome']?></td>
                            <td><?php print $rowfunc['telefone']?></td>




                            <td>
                                <a href="#">
                                    <span class="glyphicon glyphicon-pencil"
                                    data-toggle="modal" data-target="#myModaled"
                                    data-id_func="<?php print $rowfunc["id"]?>"
                                    data-nome_func="<?php print $rowfunc["nome"]?>"
                                    data-tel_func="<?php print $rowfunc["telefone"]?>"></span>
                            </td>




                            <td>
                                <a href="../control/control_func.php?id_delete=<?php print $rowfunc["id"]?>">
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

<!--comeca cadastro Modal func -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cadastrar Funcionario</h4>
      </div>
      <div class="modal-body">

        <form action="../control/control_func.php" method="POST">
            <input type="hidden" name="insert" value="1">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="txtnome" id="txtnome", required class="form-control">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="txttelefone" id="txttelefone", required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

      </div>
    </div>

  </div>
</div>
<!--termina cadastro Modal func-->


<!--comeca editar Modal func -->
<div id="myModaled" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Funcionario</h4>
      </div>
      <div class="modal-body">

        <form action="../control/control_func.php" method="POST">
            <input type="hidden" name="edit" id="id_func">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="txtnome" id="txtnome" required class="form-control">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="txttelefone" id="txttelefone" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>

      </div>
    </div>

  </div>
</div>
<!--termina editar Modal func-->

<script>
  $("#myModaled").on('show.bs.modal', function(event){
      var button = $(event.relatedTarget);
      var recipientid = button.data("id_func");
      var recipientnome = button.data("nome_func");
      var recipienttel = button.data("tel_func");

      var modal = $(this);
      modal.find("#id_func").val(recipientid);
      modal.find("#txtnome").val(recipientnome);
      modal.find("#txttelefone").val(recipienttel);
  })
</script>


<script src="../control/scriptsearch.js"></script>
</body>
</html>