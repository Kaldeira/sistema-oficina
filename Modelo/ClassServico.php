<?php
require_once "ClassCarro.php";

Class ClassServico extends ClassCarro
{
    private $idServico;
    private $idMecanico;
    private $idCarro;
    private $descricao;
    private $dataServico;

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

    function getDataServico()
    {
        return $this->dataServico;
    }
    function getIdMecanico()
    {
        return $this->idMecanico;
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

    function setDataServico($dataServico)
    {
        $this->dataServico = $dataServico;
    }

    function setIdMecanico($idMecanico)
    {
        $this->idMecanico = $idMecanico;
    }
}

?>