<?php
session_start();

if(!isset($_SESSION['usu_cpf']) && !isset($_SESSION['usu_email'])) {
  unset($_SESSION['usu_cpf']);
  unset($_SESSION['usu_email']);
  header('Location: Recuperar.php');
}

$logado_recuperar_cpf = $_SESSION['usu_cpf'];
$logado_recuperar_email = $_SESSION['usu_email'];

if(isset($_POST['submit']) && !empty($_POST['novaSenha']) && !empty($_POST['confirmarSenha'])) {
  include_once('../components/config.php');
  $novaSenha = $_POST['novaSenha'];
  $confirmarSenha = $_POST['confirmarSenha'];

  if($novaSenha === $confirmarSenha) {
    $sql = "UPDATE usuarios SET usu_senha = :novaSenha WHERE usu_cpf = :logado_recuperar_cpf AND usu_email = :logado_recuperar_email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':novaSenha', $novaSenha, PDO::PARAM_STR);
    $stmt->bindParam(':logado_recuperar_cpf', $logado_recuperar_cpf, PDO::PARAM_STR);
    $stmt->bindParam(':logado_recuperar_email', $logado_recuperar_email, PDO::PARAM_STR);
    $stmt->execute();

    if($stmt && $stmt->rowCount() > 0) {
      unset($_SESSION['usu_cpf']);
      unset($_SESSION['usu_email']);
      header('Location: Login.php');
    }
  } else {
    echo "<script>alert('As senhas são diferentes! Por favor, tente novamente.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alterar Senha</title>
</head>
<body>
  <h1>Digite sua nova senha.</h1>
  <form action="alterarSenha.php" method="POST">
    <input type="password" name="novaSenha" placeholder="Nova senha" required>
    <input type="password" name="confirmarSenha" placeholder="Confirmar senha" required>
    <input type="submit" name="submit" value="Alterar">
</body>
</html>