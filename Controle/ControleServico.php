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

$finalizado = true;

var_dump($novoCarro);

//printf("<br>acao: %s", $acao);

$url = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/ListarCarros.php';


$servicoDAO = new ClassServicoDAO();
$idServico = $servicoDAO->inserirServico($idCarro, $idMecanico, $descricaoServico);

if (!$idServico) {
    echo "<script> alert('Não foi possível finalizar o carro, erro no serviço!');
        window.location.href = '$url';
      </script>";
}

$carroDAO = new ClassCarroDAO();
$alterarStatus = $carroDAO->alterarStatusCarro($idCarro, 'Finalizado');

if (!$alterarStatus) {
    echo "<script> alert('Não foi possível finalizar o carro, erro no status!');
        window.location.href = '$url';
      </script>";
}

for ($i = 0; $i < count($descricoes); $i++) {
    $item = new ClassServicoItem();
    $item->setIdServico($idServico);
    $item->setDescricao($descricoes[$i]);
    $item->setValor($valores[$i]);

    if ($servicoDAO->inserirItem($item)) {
        continue;
    } else {
        $finalizado = false;
        break;
    }
}

if ($finalizado) {
    header('Location:../Visao/ListarFinalizados.php?&MSG= Carro Finalizado com sucesso!');
} else {
    echo "<script> alert('Não foi possível finalizar o carro!');
        window.location.href = '$url';
      </script>";
}
