<?php
require_once "ClassCarro.php";

Class ClassServico extends ClassCarro
{
    private $idServico;
    private $idMecanico;
    private $idCarro;
    private $descricao;
    private $dataServico;
    private $valorServico;
    private $status;

    function getIdServico()
    {
        return $this->idServico;
    }

    function getIdCarro()
    {
        return $this->idCarro;
    }

    function getDescricao()
    {
        return $this->descricao;
    }

    function getValor()
    {
        return $this->valorServico;
    }

    function getDataServico()
    {
        return $this->dataServico;
    }
    function getIdMecanico()
    {
        return $this->idMecanico;
    }
    function getStatus()
    {
        return $this->status;
    }

    
    function setIdServico($idServico)
    {
        $this->idServico = $idServico;
    }

    function setIdCarro($idCarro)
    {
        $this->idCarro = $idCarro;
    }

    function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    function setValor($valorServico)
    {
        $this->valorServico = $valorServico;
    }

    function setDataServico($dataServico)
    {
        $this->dataServico = $dataServico;
    }

    function setIdMecanico($idMecanico)
    {
        $this->idMecanico = $idMecanico;
    }
    function setStatus($status)
    {
        $this->status = $status;
    }
}

?>