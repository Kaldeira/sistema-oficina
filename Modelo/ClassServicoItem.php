<?php


Class ClassServicoItem extends ClassServico
{
    private $idItem;
    private $idServico;
    private $descricao;
    private $valor;

    public function getIdItem()
    {
        return $this->idItem;
    }
    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;
    }
    public function getIdServico()
    {
        return $this->idServico;
    }
    public function setIdServico($idServico)
    {
        $this->idServico = $idServico;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function getValor()
    {
        return $this->valor;
    }
    public function setValor($valor)
    {
        $this->valor = $valor;
    }
    
}
?>