<?php
  include_once('config.php');

  if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
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

    $sqlUpdate = "UPDATE usuarios SET usu_nome = '$nome', usu_dataNasc = '$dataNasc', usu_sexo = '$sexo', usu_nomeMaterno = '$nomeMaterno', usu_cpf = '$cpf', usu_celular = '$celular', usu_telefoneFixo = '$telefoneFixo', usu_endereco = '$endereco', usu_login = '$nomeLogin', usu_senha = '$senha', usu_confirmarSenha = '$confirmarSenha' WHERE id = '$id'";

    $result = $pdo->query($sqlUpdate);
  }
  header('Location: ../pages/perfil.php')

?>