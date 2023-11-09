<?php
  include_once('config.php');

  if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $dataNasc = $_POST['dataNascimento'];
    $sexo = $_POST['sexo'];
    $nomeMaterno = $_POST['nomeMaterno'];
    $cpf = $_POST['cpf'];
    $celular = $_POST['cell-phone'];
    $telefoneFixo = $_POST['phone'];
    $endereco = $_POST['endereco'];
    $nomeLogin = $_POST['login-name'];
    $senha = $_POST['password'];
    $confirmarSenha = $_POST['confirm-password'];
    $tipoUsuario = $_POST['tipo_usuario'];

    $errors = array();

    if (strlen($nomeLogin) !== 6) {
        $errors[] = "O campo de Login deve ter exatamente 6 letras.";
    }

    if (strlen($senha) !== 8 || strlen($confirmarSenha) !== 8) {
        $errors[] = "A senha deve ter exatamente 8 letras.";
    }

    if ($senha !== $confirmarSenha) {
        $errors[] = "As senhas não coincidem. Por favor, verifique.";
    }

    if (count($errors) > 0) {
        $errorMessages = json_encode($errors);

        header("Location: ../pages/erroEditCadastro.php?errors=$errorMessages");
        exit;
    }

    $sqlUpdate = "UPDATE usuarios SET usu_nome = '$nome', usu_email = '$email', usu_dataNasc = '$dataNasc', usu_sexo = '$sexo', usu_nomeMaterno = '$nomeMaterno', usu_cpf = '$cpf', usu_celular = '$celular', usu_telefoneFixo = '$telefoneFixo', usu_endereco = '$endereco', usu_login = '$nomeLogin', usu_senha = '$senha', usu_confirmarSenha = '$confirmarSenha', tipo_usuario = '$tipoUsuario' WHERE id = '$id'";

    $result = $pdo->query($sqlUpdate);
  }
  header('Location: ../pages/perfilMaster.php');

?>