<?php
require_once '../Modelo/ClassUsuario.php';
require_once "../Modelo/DAO/ClassUsuarioDAO.php";

$id = @$_POST['idex'];
$login = @$_POST['login'];
$senha = @$_POST['senha'];
$email = @$_POST['email'];
$acao = $_GET['ACAO'];


$novoUsuario = new ClassUsuario();
$novoUsuario->setIdUsuario($id);
$novoUsuario->setLogin($login);
$novoUsuario->setSenha($senha);
$novoUsuario->setEmail($email);
$novoUsuario->setnivel(2); // Definindo o nível como 2 (Usuário comum)

var_dump($novoUsuario);

$classDAO = new ClassUsuarioDAO();
switch ($acao) {
    case "cadastrarUsuario":
        $status = $classDAO->cadastrar($novoUsuario);
        if ($status >= 1) {
            header('Location:../index.php?&MSG= Cadastro realizado com sucesso!');
        } else {
            header('Location:../index.php?&MSG= Não foi possivel realizar o cadastro!');
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
    case "sair":
        session_start();
        session_unset();
        session_destroy();
        header("Location:../index.php?&MSG= Você saiu com sucesso!");
        break;
    default:
        break;
}
