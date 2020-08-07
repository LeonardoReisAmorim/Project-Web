<?php
    require_once 'db.php';

    class Quarto{
        private $conn;

        public function __construct()
        {
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        public function runquery($sql){
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }

        public function insertquarto($descricao, $status, $valor){
            try{
                $sql = "INSERT INTO quarto (descricao, status, valor)
                VALUES (:descricao, :status, :valor)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":descricao", $descricao);
                $stmt->bindParam(":status", $status);
                $stmt->bindParam(":valor", $valor);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function updatequarto($descricao, $status, $valor, $id){
            try{
                $sql = "UPDATE quarto SET descricao = :descricao, status = :status, valor = :valor
                WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":descricao", $descricao);
                $stmt->bindParam(":status", $status);
                $stmt->bindParam(":valor", $valor);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function deletequarto($id){
            try{
                $sql = "DELETE FROM quarto WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function updatestatus($status, $id){
            try{
                $sql = "UPDATE quarto SET status = :status
                WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":status", $status);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                print $e->getMessage();
            }
        }

        
        public function redirect($url){
            header("Location: $url");
        }
    }
?>