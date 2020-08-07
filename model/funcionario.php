<?php
    require_once 'db.php';

    class Func{
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

        public function insertfunc($nome, $telefone){
            try{
                $sql = "INSERT INTO funcionario(nome, telefone)
                VALUES (:nome, :telefone)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":telefone", $telefone);

                $stmt->execute();

                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function updatefunc($nome, $telefone, $id){
            try{
                $sql = "UPDATE funcionario SET nome = :nome, telefone = :telefone
                WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":telefone", $telefone);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function deletefunc($id){
            try{
                $sql = "DELETE FROM funcionario where id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function redirect($url){
            header("Location: $url");
        }
        
    }
?>