<?php
require_once '../Modelo/ClassCarro.php';
require_once "../Modelo/DAO/ClassCarroDAO.php";
require_once "../Modelo/ClassServico.php";
require_once "../Modelo/DAO/ClassServicoDAO.php";
require_once '../Modelo/ClassServicoItem.php';

$id = @$_GET['idex'];
$acao = $_GET['ACAO'];

// 1. Dados do serviço
$idCarro = $_POST['idCarro'];
$idMecanico = $_POST['mecanico'];
$descricaoServico = $_POST['descricaoServico'];

// 2. Itens do relatório
$descricoes = $_POST['descricao'];
$valores = $_POST['valor'];


//$novoCarro = new ClassCarro();
$novoCarro = new ClassServico();
$novoCarro->setIdCarro($id);
$novoCarro->setDescricao($descricaoServico);
$novoCarro->setIdMecanico($idMecanico);


var_dump($novoCarro);

//printf("<br>acao: %s", $acao);


$servicoDAO = new ClassServicoDAO();
$idServico = $servicoDAO->inserirServico($idCarro, $idMecanico, $descricaoServico);

if (!$idServico) {
    echo "Erro ao inserir o serviço.";
    exit;
}

$carroDAO = new ClassCarroDAO();
$alterarStatus = $carroDAO->alterarStatusCarro($idCarro, 'Finalizado');

if (!$alterarStatus) {
    echo "Erro ao alterar status.";
    exit;
}

for ($i = 0; $i < count($descricoes); $i++) {
    $item = new ClassServicoItem();
    $item->setIdServico($idServico);
    $item->setDescricao($descricoes[$i]);
    $item->setValor($valores[$i]);

    $servicoDAO->inserirItem($item);
}
