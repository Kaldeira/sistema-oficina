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

$urlAlt = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/AlterarCliente.php';
$urlCad = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/CadastrarCliente.php';
$url = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/ListarClientes.php';

$classDAO = new ClassClienteDAO();
switch ($acao) {
    case "cadastrarCliente":
        $status = $classDAO->cadastrar($novo);
        if ($status >= 1) {
            header('Location:../Visao/ListarClientes.php?&MSG= Cadastro realizado com sucesso!');
        } else {
            echo "<script> alert('Não foi possivel realizar o cadastro!');
        window.location.href = '$urlCad';
      </script>";
        }
        break;
    case 'alterarCliente':
        $status = $classDAO->alterarCliente($novo);
        if ($status == 1) {
            header('Location:../Visao/ListarClientes.php?&MSG= Alteração feita com sucesso!');
        } else {
            echo "<script> alert('Não foi possível alterar!');
        window.location.href = '$urlAlt?idex=$id';
      </script>";
        }
    case 'deletarCliente':

        if (isset($_GET['idex'])) {
            $idCliente = $_GET['idex'];
            //echo "<br>idex:" . $idCarro ;
            $status = $classDAO->deletar($idCliente);
            if ($status == TRUE) {
                header('Location:../Visao/ListarClientes.php?&MSG= Deletado com Sucesso!');
            } else {
                echo "<script> alert('Não foi possível deletar: Cliente possuí veiculo registrado!'); window.location.href = '$url'; </script>";
            }
        } else {
            echo "<script> alert('Não foi possível Deletar!'); window.location.href = '$url'; </script>";
        }

    default:
        break;
}
