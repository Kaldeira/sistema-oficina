<?php

class ClassMecanico
{
    private $idMecanico;
    private $idUsuario;
    private $nome;
    private $telefone;
    private $dataCadastro;

    function getIdMecanico()
    {
        return $this->idMecanico;
    }

    function getIdUsuario()
    {
        return $this->idUsuario;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getTelefone()
    {
        return $this->telefone;
    }

    function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    function setIdMecanico($idMecanico)
    {
        $this->idMecanico = $idMecanico;
    }

    function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
    }
}
?>