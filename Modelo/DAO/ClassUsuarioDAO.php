<?php
require_once 'Conexao.php';

class ClassUsuarioDAO
{
    public function cadastrar(ClassUsuario $usuario)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO usuario (idUsuario, login, senha) values (?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $usuario->getIdUsuario());
            $stmt->bindValue(2, $usuario->getLogin());
            $stmt->bindValue(3, $usuario->getSenha());
            $stmt->execute();
            return TRUE;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function fazerLogin(ClassUsuario $usuario)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT idUsuario, login, senha, nivel FROM usuario WHERE login =:login AND senha =:senha";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':login', $usuario->getLogin());
            $stmt->bindValue(':senha', $usuario->getSenha());
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function listarUsuarios()
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT idUsuario, login, senha FROM usuario";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function buscarUsuario($id)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "SELECT idUsuario, login, senha FROM usuario WHERE idUsuario =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}

?>