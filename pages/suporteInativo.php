<?php
if (isset($_POST['submit'])) {
  include_once('../components/config.php');

  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $cpf = $_POST['cpf'];
  $mensagem = $_POST['mensagem'];

  $sql = "INSERT INTO suporte_inativo (nome, email, cpf, mensagem) VALUES (:nome, :email, :cpf, :mensagem)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
  $stmt->bindParam(':mensagem', $mensagem, PDO::PARAM_STR);
  $stmt->execute();
  echo "<script>alert('Mensagem enviada com sucesso!');</script>";
  echo "<script>window.location = 'Login.php';</script>";
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/header_footer.css">
  <link rel="stylesheet" href="../styles/inativo.css">
  <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
  <title>Perfil Inativo</title>
</head>

<body>
  <?php include_once('../components/headerDefault.php'); ?>
  <main class="container-inativo">
    <h1>Seu perfil está inativo, favor entrar em contato com o suporte.</h1>
    <form action="suporteInativo.php" method="POST">
      <span>
        Nome completo:
        <input type="text" name="nome" placeholder="Nome">
      </span>
      <span>
        E-mail:
        <input type="email" name="email" placeholder="E-mail">
      </span>
      <span>
        CPF:
        <input type="text" name="cpf" placeholder="CPF" oninput="formatCPF(this)">
      </span>
      <span>
        Mensagem:
        <textarea name="mensagem" id="mensagem" cols="30" rows="10"></textarea>
      </span>
      <input type="submit" name="submit" value="Enviar">
    </form>
  </main>
  <?php include_once('../components/footer.php'); ?>
  <script src="../js/formatCPF.js"></script>
</body>

</html>