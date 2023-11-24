<?php
session_start();

if (!isset($_SESSION['usu_cpf']) && !isset($_SESSION['usu_email'])) {
  unset($_SESSION['usu_cpf']);
  unset($_SESSION['usu_email']);
  header('Location: Recuperar.php');
}

$logado_recuperar_cpf = $_SESSION['usu_cpf'];
$logado_recuperar_email = $_SESSION['usu_email'];

if (isset($_POST['submit']) && !empty($_POST['novaSenha']) && !empty($_POST['confirmarSenha'])) {
  include_once('../components/config.php');
  $novaSenha = $_POST['novaSenha'];
  $confirmarSenha = $_POST['confirmarSenha'];

  $errors = array();

  if (strlen($novaSenha) !== 8 || strlen($confirmarSenha) !== 8) {
    $errors[] = "A senha deve ter exatamente 8 caracteres.";
  }

  if (strlen($novaSenha) !== strlen($confirmarSenha)) {
    $errors[] = "A senha e a confirmação devem ter o mesmo tamanho.";
  }

  if (count($errors) > 0) {
    $errorMessages = json_encode($errors);

    header("Location: erroAlterarSenha.php?errors=$errorMessages");
    exit;
  } else {
    $sql = "UPDATE usuarios SET usu_senha = :novaSenha, usu_confirmarSenha = :confirmarSenha WHERE usu_cpf = :logado_recuperar_cpf AND usu_email = :logado_recuperar_email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':novaSenha', $novaSenha, PDO::PARAM_STR);
    $stmt->bindParam(':confirmarSenha', $confirmarSenha, PDO::PARAM_STR);
    $stmt->bindParam(':logado_recuperar_cpf', $logado_recuperar_cpf, PDO::PARAM_STR);
    $stmt->bindParam(':logado_recuperar_email', $logado_recuperar_email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt && $stmt->rowCount() > 0) {
      unset($_SESSION['usu_cpf']);
      unset($_SESSION['usu_email']);
      header('Location: Login.php');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/produtos.css">
  <link rel="stylesheet" href="../styles/recuperar.css">
  <link rel="stylesheet" href="../styles/header_footer.css">
  <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
  <title>Alterar Senha</title>
</head>

<body>
  <?php if ($_SESSION['tipo_usuario']) { ?>
    <?php require_once('../components/header.php'); ?>
  <?php } else { ?>
    <?php require_once('../components/headerDefault.php'); ?>
  <?php } ?>
  <main class="container">
    <form class="recuperar-senha" action="alterarSenha.php" method="POST">
      <div class="painel">
        <a href="../index.php">
          <img src="../img/mjp-att.png" alt="essa é a logo da MJP" style="height:65px; width:250px">
        </a>
        <h1 class="painel-mensagem">Digite sua nova senha.</h1>
        <span>
          Nova senha:
          <input type="password" name="novaSenha" required>
        </span>
        <span>
          Confirmar senha:
          <input type="password" name="confirmarSenha" required>
          <input type="submit" name="submit" value="Alterar">
        </span>
      </div>
    </form>
  </main>
  <?php require_once('../components/footer.php'); ?>
</body>

</html>