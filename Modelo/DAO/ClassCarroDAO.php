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

    public function alterarCarro(ClassCarro $alterarCarro)
    {
        $imagem = 0;
        try {   
            $pdo = Conexao::getInstance();

            if ($alterarCarro->getImagem() != null && !empty($alterarCarro->getImagem())) {
                $imagem = $alterarCarro->getImagem();
            } else {
                // Se a imagem não for alterada, mantenha o valor atual
                $carroExistente = $this->buscarCarro($alterarCarro->getIdCarro());
                $imagem = $carroExistente['imagem'];
            }

            $sql = "UPDATE carro SET modelo = ?, fabricante = ?, ano = ?, placa = ?, cor = ?, caracteristicas = ?, imagem = ? WHERE idCarro = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $alterarCarro->getModelo());
            $stmt->bindValue(2, $alterarCarro->getFabricante());
            $stmt->bindValue(3, $alterarCarro->getAno());
            $stmt->bindValue(4, $alterarCarro->getPlaca());
            $stmt->bindValue(5, $alterarCarro->getCor());
            $stmt->bindValue(6, $alterarCarro->getCaracteristicas());
            $stmt->bindValue(7, $imagem);
            $stmt->bindValue(8, $alterarCarro->getIdCarro());

            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function alterarStatusCarro($idCarro, $status)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE carro SET status = :status WHERE idCarro = :idCarro";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':idCarro', $idCarro);
            return $stmt->execute();
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
            $sql = "DELETE FROM carro WHERE idCarro = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
