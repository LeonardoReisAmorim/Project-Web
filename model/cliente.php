<?php
    require_once "db.php";

    class Cliente{
        //crianco uma variavel privada
        private $conn;
        //crianco um construtor para a execucao do banco
        public function __construct()
        {
            //manipulando valores da classe Database()
            $database = new Database();
            $db = $database->dbConnection();
            //atribuindo a conexao na variavel conn
            $this->conn = $db;
        }
        
        public function runQuery($sql){
            $stmt = $this->conn->prepare($sql);
            return $stmt;
        }

        //inserir clientes no banco de dados
        public function insert($nome, $idade, $sexo){
            try{
                //escrevendo o codigo do mysql
                //esse ":" é pq é um parametro e sempre tem q ser usado assim
                $sql = "INSERT INTO cliente(nome, idade, sexo)
                VALUES (:nome, :idade, :sexo)";
                //preparando a execucao do mysql pelo stmt prepare
                $stmt = $this->conn->prepare($sql);
                //setando os valores do parametro da funcao no banco pelo "bindparam"
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(":idade", $idade);
                $stmt->bindParam(":sexo", $sexo);
                //executando o banco
                $stmt->execute();
                //retorna a execucao
                return $stmt;
                //gerar erro cai no catch
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function update($id, $nome, $idade, $sexo){
            try{
                $sql = "UPDATE cliente SET nome = :nome, idade = :idade, sexo = :sexo
                WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":idade", $idade);
                $stmt->bindParam(":sexo", $sexo);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                return $stmt;
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function delete($id){
            try{
                $sql = "DELETE FROM cliente WHERE id = :id";
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