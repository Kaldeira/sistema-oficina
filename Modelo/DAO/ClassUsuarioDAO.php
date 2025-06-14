<?php
require_once 'Conexao.php';

class ClassUsuarioDAO
{
    public function cadastrar(ClassUsuario $usuario)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "INSERT INTO usuario (idUsuario, login, senha, email) values (?,?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $usuario->getIdUsuario());
            $stmt->bindValue(2, $usuario->getLogin());
            $stmt->bindValue(3, $usuario->getSenha());
            $stmt->bindValue(4, $usuario->getEmail());
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
            $sql = "SELECT * FROM usuario";
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
            $sql = "SELECT * FROM usuario WHERE idUsuario =:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function deletar($id)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "DELETE FROM usuario WHERE idUsuario = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() > 0; // retorna true se deletou alguma linha
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function alterar(ClassUsuario $user)
    {
        try {
            $pdo = Conexao::getInstance();
            $sql = "UPDATE usuario SET login=?, email=?, nivel=?, senha=? WHERE idUsuario=?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $user->getLogin());
            $stmt->bindValue(2, $user->getEmail());
            $stmt->bindValue(3, $user->getnivel());
            $stmt->bindValue(4, $user->getSenha());
            $stmt->bindValue(5, $user->getIdUsuario());
            return $stmt->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
}
