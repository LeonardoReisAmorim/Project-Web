<?php
    require_once "../model/reserva.php";
    require_once "../model/quarto.php";
    $objqt = new Quarto();
    $objres = new Reserva();

    if(isset($_POST["insert"])){
        $id_quarto = $_POST["txtquarto"];
        $id_func = $_POST["txtfunc"];
        $idcliente = $_POST["txtcliente"];
        $data_ini = $_POST["txtData_ini"];
        $dias = $_POST["txtDias"];

        if($objres->insertres($id_func, $idcliente, $id_quarto, $data_ini, $dias)){
            $objqt->updatestatus("ocupado", $id_quarto);
            $objres->redirect("../view/index.php");
        }
    }

    if(isset($_POST["txtqt"])){
        $id = $_POST["txtqt"];

        $objqt->updatestatus("livre", $id);
            $objres->redirect("../view/index.php");
    }
?>