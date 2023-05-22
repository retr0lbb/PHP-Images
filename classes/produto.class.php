<?php
    class Produto {
        private $pdo;

        function __construct()
        {
            $dbname = "mysql:dbname=produtosetim;host=localhost";
            $user = "root";
            $pass = "";
            try {
                $this->pdo = new PDO($dbname, $user, $pass);
            } catch (Exception $e) {
                echo "Erro" . $e;
            }
        }


        

        public function enviarProduto($nome, $descricao,$foto = array()){
            ///////inserir em produtos

            $cmd = "INSERT INTO produtos SET nome_produto = :n, descricao = :d";
            $cmd = $this->pdo->prepare($cmd);
            $cmd ->bindValue(":n", $nome);
            $cmd ->bindValue(":d", $descricao);

            $cmd ->execute();
            $id_produto = $this->pdo->LastInsertId ();

            // inserir uma imagem na tabela de produtos

            if(count($foto)> 0){
                for($i=0;$i<count($foto); $i++){
                    $nome_foto = $foto[$i];
                    $cmd = "INSERT INTO imagens (nome_imagem, fk_id_produto) values (:n, :fk)";
                    
                    
                    $cmd = $this->pdo->prepare($cmd);
                    $cmd ->bindValue(":n", $nome);
                    $cmd ->bindValue(":fk", $id_produto);
                    $cmd ->execute();

           
                }
            }
            
        }






    }
?>