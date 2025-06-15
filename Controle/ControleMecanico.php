<?php
require_once '../Modelo/ClassMecanico.php';
require_once "../Modelo/DAO/ClassMecanicoDAO.php";

$id = @$_POST['idex'];
$acao = $_GET['ACAO'];


$novo = new ClassMecanico();
$novo->setIdMecanico($id);
$novo->setNome($_POST['nome']);
$novo->setTelefone($_POST['telefone']);

var_dump($novo);

$urlAlt = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/AlterarMecanico.php';
$urlCad = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/CadastroMecanico.php';
$url = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/ListarMecanicos.php';


$classDAO = new ClassMecanicoDAO();
switch ($acao) {
    case "cadastrarMecanico":
        $status = $classDAO->cadastrar($novo);
        if ($status >= 1) {
            header('Location:../Visao/ListarMecanicos.php?&MSG= Cadastro realizado com sucesso!');
        } else {
            echo "<script> alert('Não foi possivel realizar o cadastro!');
        window.location.href = '$urlCad';
      </script>";
        }
        break;
    case 'alterarMecanico':
        $status = $classDAO->alterarMecanico($novo);
        if ($status == 1) {
            header('Location:../Visao/ListarMecanicos.php?&MSG= Cadastro atualizado com sucesso!');
        } else {
            echo "<script> alert('Não foi possível alterar!');
        window.location.href = '$urlAlt?idex=$id';
      </script>";
        }
    case 'deletarMecanico':

        if (isset($_GET['idex'])) {
            $idMecanico = $_GET['idex'];
            //echo "<br>idex:" . $idCarro ;
            $status = $classDAO->deletar($idMecanico);
            if ($status == TRUE) {
                header('Location:../Visao/ListarMecanicos.php?&MSG= Deletado com Sucesso!');
            } else {
                echo "<script> alert('Não foi possível Deletar!'); window.location.href = '$url'; </script>";
            }
        } else {
            echo "<script> alert('Não foi possível Deletar!'); window.location.href = '$url'; </script>";
        }
        
    default:
        break;
}
