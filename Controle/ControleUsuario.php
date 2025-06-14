<?php
require_once '../Modelo/ClassUsuario.php';
require_once "../Modelo/DAO/ClassUsuarioDAO.php";

$id = @$_POST['idex'];
$login = @$_POST['login'];
$senha = @$_POST['senha'];
$email = @$_POST['email'];
$acao = $_GET['ACAO'];

if (isset($_POST['nivel'])) {
    $nivel = $_POST['nivel'];
} else {
    $nivel = 2; // Definindo o nível padrão como 2 (Usuário comum)
}


$novoUsuario = new ClassUsuario();
$novoUsuario->setIdUsuario($id);
$novoUsuario->setLogin($login);
$novoUsuario->setSenha($senha);
$novoUsuario->setEmail($email);
$novoUsuario->setnivel($nivel);

//var_dump($novoUsuario);

$urlIndex = dirname($_SERVER['PHP_SELF'], 2) . '/index.php';
$urlCad= dirname($_SERVER['PHP_SELF'], 2) . '/Visao/CadastroUsuario.php';
$url = dirname($_SERVER['PHP_SELF'], 2) . '/Visao/ListarUsuarios.php';

$classDAO = new ClassUsuarioDAO();
switch ($acao) {
    case "cadastrarUsuario":
        $status = $classDAO->cadastrar($novoUsuario);
        if ($status >= 1) {
            echo "<script> alert('Cadastro realizado com sucesso!!!!!'); window.location.href = '$urlIndex'; </script>";
        } else {
            echo "<script> alert('Não foi possível cadastrar o usuario, talvez esse usuario já exista!!!'); window.location.href = '$urlCad'; </script>";
        }
        break;
    case 'fazerLogin':
        $usuario = $classDAO->fazerLogin($novoUsuario);
        if ($usuario) {
            session_start();
            $_SESSION['idUsuario'] = $usuario['idUsuario'];
            $_SESSION['login'] = $usuario['login'];
            $_SESSION['nivel'] = $usuario['nivel'];
            header('Location:../Visao/ListarCarros.php?&MSG= Login realizado com sucesso!');
        } else {
            echo "<script>
                alert('Não foi possível realizar o login. Verifique suas credenciais!');
                window.location.href = '../index.php';
              </script>";
        }
        break;
    case 'alterarUsuario':
        if (isset($_POST['idex'])) {
            $status = $classDAO->alterar($novoUsuario);
            if ($status == TRUE) {
                header('Location:../Visao/ListarUsuarios.php?&MSG= Alterado com Sucesso!');
            } else {
                echo "<script> alert('Não foi possível alterar!'); window.location.href = '../Visao/AlterarUsuario.php?idex=$id'; </script>";
            }
        } else {
            echo "<script> alert('Não foi possível alterar!'); window.location.href = '../Visao/AlterarUsuario.php?idex=$id'; </script>";
        }
        break;
    case "sair":
        session_start();
        session_unset();
        session_destroy();
        header("Location:../index.php?&MSG= Você saiu com sucesso!");
        break;
    case "deletarUser":
        if (isset($_GET['idex'])) {
            $idUsuario = $_GET['idex'];
            $status = $classDAO->deletar($idUsuario);
            if ($status == TRUE) {
                header('Location:../Visao/ListarUsuarios.php?&MSG= Deletado com Sucesso!');
            } else {
                echo "<script> alert('Não foi possível deletar: Usuario possuí Vinculo!'); window.location.href = '$url'; </script>";
            }
        } else {
            echo "<script> alert('Não foi possível Deletar!'); window.location.href = '$url'; </script>";
        }
        break;
    default:
        break;
}
