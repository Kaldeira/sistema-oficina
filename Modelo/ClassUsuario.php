<?php

class ClassUsuario
{
    private $idUsuario;
    private $login;
    private $senha;
    private $email;
    private $nivel;

    function getIdUsuario()
    {
        return $this->idUsuario;
    }

    function getLogin()
    {
        return $this->login;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getnivel()
    {
        return $this->nivel;
    }

    function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    function setLogin($login)
    {
        $this->login = $login;
    }

    function setSenha($senha)
    {
        $this->senha = $senha;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setnivel($nivel)
    {
        $this->nivel = $nivel;
    }
}
?>