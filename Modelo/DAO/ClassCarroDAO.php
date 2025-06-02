<?php
require_once 'Conexao.php';

class ClassCarroDAO
{
    public function cadastrar(ClassCarro $cadastrarCarro)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO carro (idCliente, modelo, fabricante, ano, placa, cor, caracteristicas, imagem) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cadastrarCarro->getIdCliente());
            $stmt->bindValue(2, $cadastrarCarro->getModelo());
            $stmt->bindValue(3, $cadastrarCarro->getFabricante());
            $stmt->bindValue(4, $cadastrarCarro->getAno());
            $stmt->bindValue(5, $cadastrarCarro->getPlaca());
            $stmt->bindValue(6, $cadastrarCarro->getCor());
            $stmt->bindValue(7, $cadastrarCarro->getCaracteristicas());
            $stmt->bindValue(8, $cadastrarCarro->getImagem());


            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarCarros()
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * from carro order by (modelo) asc";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    public function buscarCarroCliente($idCliente)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM carro WHERE idCliente =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $idCliente);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }

    public function buscarCarro($id)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM carro WHERE idCarro =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function deletarCarro($id)
    {
         try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE * FROM carro WHERE idCarro = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
