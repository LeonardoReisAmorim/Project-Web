<?php
    require_once "../model/cliente.php";
    $objcliente = new Cliente();

    if(isset($_POST['insert'])){
        $nome = $_POST["txtnome"];
        $idade = $_POST["txtidade"];
        $sexo = $_POST["txtsexo"];

        if($objcliente->insert($nome, $idade, $sexo)){
            $objcliente->redirect("../view/cliente.php");
        }
    }

    if(isset($_GET["delete_id"])){
        $id = $_GET["delete_id"];

        if($objcliente->delete($id)){
            $objcliente->redirect("../view/cliente.php");
        }
    }

    if(isset($_POST["txteditar"])){
        $id = $_POST["txteditar"];
        $nome = $_POST["txtnome"];
        $idade = $_POST["txtidade"];
        $sexo = $_POST["txtsexo"];

        if($objcliente->update($id, $nome, $idade, $sexo)){
            $objcliente->redirect("../view/cliente.php");
        }
    }
    
?>