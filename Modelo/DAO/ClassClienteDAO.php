<?php
require_once 'Conexao.php';

class ClassClienteDAO
{
    public function cadastrar(ClassCliente $cliente)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO cliente (nome, telefone, email, cpf, endereco) values (?,?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cliente->getNome());
            $stmt->bindValue(2, $cliente->getTelefone());
            $stmt->bindValue(3, $cliente->getEmail());
            $stmt->bindValue(4, $cliente->getCpf());
            $stmt->bindValue(5, $cliente->getEndereco());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarClientes()
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM cliente ORDER BY (nome) ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function alterarCliente(ClassCliente $cliente)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE cliente SET nome=?, telefone=?, email=?, cpf=?, endereco=? WHERE idCliente=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $cliente->getNome());
            $stmt->bindValue(2, $cliente->getTelefone());
            $stmt->bindValue(3, $cliente->getEmail());
            $stmt->bindValue(4, $cliente->getCpf());
            $stmt->bindValue(5, $cliente->getEndereco());
            $stmt->bindValue(6, $cliente->getIdCliente());
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarCliente($id)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT * FROM cliente WHERE idCliente =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
