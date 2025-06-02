<?php
class ClassCarro {
    private $idCarro;
    private $idCliente;
    private $modelo;
    private $fabricante;
    private $ano;
    private $placa;
    private $cor;
    private $caracteristicas;
    private $imagem;

    function getIdCarro() {
        return $this->idCarro;
    }
    function getModelo() {
        return $this->modelo;
    }
    function getFabricante() {
        return $this->fabricante;
    }
    function getAno() {
        return $this->ano;
    }
    function getPlaca() {
        return $this->placa;
    }
    function getCor() {
        return $this->cor;
    }
    function getIdCliente() {
        return $this->idCliente;
    }
    function getCaracteristicas() {
        return $this->caracteristicas;
    }
    function getImagem() {
        return $this->imagem;
    }

    
    function setIdCarro($idCarro) {
        $this->idCarro = $idCarro;
    }
    function setModelo($modelo) {
        $this->modelo = $modelo;
    }
    function setFabricante($fabricante) {
        $this->fabricante = $fabricante;
    }
    function setAno($ano) {
        $this->ano = $ano;
    }
    function setPlaca($placa) {
        $this->placa = $placa;
    }
    function setCor($cor) {
        $this->cor = $cor;
    }
    function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }
    function setCaracteristicas($caracteristicas) {
        $this->caracteristicas = $caracteristicas;
    }
    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

}

?>