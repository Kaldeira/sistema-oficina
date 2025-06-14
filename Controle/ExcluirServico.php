<?php
require_once "../Modelo/ClassServico.php";
require_once "../Modelo/DAO/ClassServicoDAO.php";

$url = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/ListarServicos.php';

$classDAO = new ClassServicoDAO();
if (isset($_GET['idex'])) {
    $id = $_GET['idex'];
    echo "<br>idex:" . $id ;
    $status = $classDAO->callExcluirServico($id);
    if ($status == TRUE) {
        echo "<script> alert('Cancelado com Sucesso!'); window.location.href = '$url'; </script>";
    } else {
        echo "<script> alert('Não foi possível cancelar: Servico possuí vinculo!'); window.location.href = '$url'; </script>";
    }
} else {
    echo "<script> alert('Não foi possível cancelar!'); window.location.href = '$url'; </script>";
}
