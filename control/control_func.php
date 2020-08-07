<?php
    require_once "../model/funcionario.php";
    $objfunc = new Func();

    if(isset($_POST['insert'])){
        $nome = $_POST["txtnome"];
        $tel = $_POST["txttelefone"];

        if($objfunc->insertfunc($nome, $tel)){
            $objfunc->redirect("../view/funcionario.php");
        }
    }

    if(isset($_GET["id_delete"])){
        $id = $_GET["id_delete"];

        if($objfunc->deletefunc($id)){
            $objfunc->redirect("../view/funcionario.php");
        }
    }

    if(isset($_POST["edit"])){
        $id = $_POST["edit"];
        $nome = $_POST["txtnome"];
        $tel = $_POST["txttelefone"];

        if($objfunc->updatefunc($nome, $tel, $id)){
            $objfunc->redirect("../view/funcionario.php");
        }
    }
?>