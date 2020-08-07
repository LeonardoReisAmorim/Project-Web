<?php
    require_once 'db.php';

    class Reserva{
        private $conn;

        public function __construct()
        {
            $database = new Database();
            $db = $database->dbConnection();
            $this->conn = $db;
        }

        public function runquery($sql){
            try{
                $stmt = $this->conn->prepare($sql);
                return $stmt;
            }catch(PDOException $e){
                print $e->getMessage();
            }  
        }


        public function insertres($id_func, $id_cliente, $id_quarto, $data_ini, $qtd_dias){
            try{
                $sql = "INSERT INTO reserva (id_func, id_cliente, id_quarto, data_ini, qtd_dias)
                VALUES (:id_func, :id_cliente, :id_quarto, :data_ini, :qtd_dias)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":id_func", $id_func);
                $stmt->bindParam(":id_cliente", $id_cliente);
                $stmt->bindParam(":id_quarto", $id_quarto);
                $stmt->bindParam(":data_ini", $data_ini);
                $stmt->bindParam(":qtd_dias", $qtd_dias);
                $stmt->execute();
                return $stmt;
            }catch(PDOException  $e){
                print $e->getMessage();
            }
        }

        public function updatedtfinal($dt, $id){
            try{
                $sql = "UPDATE reserva SET data_fim = :dt
                WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":dt", $dt);
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

        public function deletereserva($id){
            try{
                $sql = "DELETE FROM reserva WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                print $e->getMessage();
            }
        }
    }
?>