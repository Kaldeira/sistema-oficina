<?php
require_once 'Conexao.php';

class ClassMecanicoDAO
{
    public function cadastrar(ClassMecanico $usuario)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO mecanico (nome, telefone) values (?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $usuario->getNome());
            $stmt->bindValue(2, $usuario->getTelefone());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    public function listarMecanico()
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM mecanico";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarMecanico($id)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM mecanico WHERE idMecanico =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function alterarMecanico(ClassMecanico $mecanico)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE mecanico SET nome=?, telefone=? WHERE idMecanico=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $mecanico->getNome());
            $stmt->bindValue(2, $mecanico->getTelefone());
            $stmt->bindValue(6, $mecanico->getIdMecanico());
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function deletar($id)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM mecanico WHERE idMecanico = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() > 0; // retorna true se deletou alguma linha
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
}
