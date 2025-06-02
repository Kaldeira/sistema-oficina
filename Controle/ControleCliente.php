<?php
require_once '../Modelo/ClassCliente.php';
require_once "../Modelo/DAO/ClassClienteDAO.php";

$id = @$_POST['idex'];
$login = @$_POST['login'];
$senha = @$_POST['senha'];
$acao = $_GET['ACAO'];


$novo = new ClassCliente();
$novo->setIdCliente($id);
$novo->setNome($_POST['nome']);
$novo->setTelefone($_POST['telefone']);
$novo->setEmail($_POST['email']);
$novo->setCpf($_POST['cpf']);
$novo->setEndereco($_POST['endereco']);

var_dump($novo);

$classDAO = new ClassClienteDAO();
switch ($acao) {
    case "cadastrarCliente":
        $status = $classDAO->cadastrar($novo);
        if ($status >= 1) {
            header('Location:../index.php?&MSG= Cadastro realizado com sucesso!');
        } else {
            header('Location:../index.php?&MSG= Não foi possivel realizar o cadastro!');
        }
        break;
        case 'alterarCliente':
            $status = $classDAO->alterarCliente($novo);
            if ($status == 1) {
                //header('Location:../Visao/ListarClientes.php?&MSG= Cadastro atualizado com sucesso!');
            } else {
                //header('Location:ListarClientes.php?&MSG= Não foi possivel realizar a atualização!');
            }
    default:
        break;
}
?>