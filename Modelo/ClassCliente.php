<?php

class ClassCliente
{
    private $idCliente;
    private $nome;
    private $telefone;
    private $email;
    private $cpf;
    private $endereco;
    private $dataCadastro;

    function getidCliente()
    {
        return $this->idCliente;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getTelefone()
    {
        return $this->telefone;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getCpf()
    {
        return $this->cpf;
    }

    function getEndereco()
    {
        return $this->endereco;
    }

    function getDataCadastro()
    {
        return $this->dataCadastro;
    }



    function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }
    function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
    }
}
