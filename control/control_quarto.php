<?php
    require_once "../model/quarto.php";
    $objqt = new Quarto();

    if(isset($_POST["insert"])){
        $descricao = $_POST["txtdescricao"];
        $stats = $_POST["txtstatus"];
        $valor = $_POST["txtvalor"];

        if($objqt->insertquarto($descricao, $stats, $valor)){
            $objqt->redirect("../view/quarto.php");
        }
    }

    if(isset($_GET["id_delete"])){
        $id = $_GET["id_delete"];

        if($objqt->deletequarto($id)){
            $objqt->redirect("../view/quarto.php");
        }
    }

    if(isset($_POST["edit"])){
        $id = $_POST["edit"];
        $descricao = $_POST["txtdescricao"];
        $stats = $_POST["txtstatus"];
        $valor = $_POST["txtvalor"];

        if($objqt->updatequarto($descricao, $stats, $valor, $id)){
            $objqt->redirect("../view/quarto.php");
        }
    }
?>