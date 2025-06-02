<?php
require_once 'Conexao.php';

class ClassServicoDAO
{
    public function cadastrar(ClassServico $servico)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO servico (idMecanico, idCarro, descricao) values (?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $servico->getIdMecanico());
            $stmt->bindValue(2, $servico->getIdCarro());
            $stmt->bindValue(5, $servico->getStatus());
            $stmt->bindValue(6, $servico->getDescricao());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function cadastrarServico(ClassServico $servico, $idCarro)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO servico (idMecanico, idCarro, descricao, idCarro) values (?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $servico->getIdMecanico());
            $stmt->bindValue(2, $servico->getIdCarro());
            $stmt->bindValue(3, $servico->getDescricao());
            $stmt->bindValue(4, $idCarro);
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarServicos()
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM servico ORDER BY (dataServico) DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarServicoCarro($id)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM servico WHERE idCarro =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarServicosJoin()
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT s.descricao,
            s.dataServico,
            s.idServico,
            c.modelo,
            c.placa,
            cli.nome,
            mec.nome as mecanico
            from servico s
            inner join carro c on s.idCarro = c.idCarro
            inner join cliente cli on c.idCliente = cli.idCliente
            inner join mecanico mec on s.idMecanico = mec.idMecanico;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarRelatorio($id)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT s.descricao, si.idItem, si.descricao as descricaoItem, si.valor, c.modelo, cli.nome 
        from servico s 
        inner join carro c on s.idCarro = c.idCarro 
        inner join servico_item si on s.idServico = si.idServico 
        inner join cliente cli on c.idCliente = cli.idCliente
        where si.idServico = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
