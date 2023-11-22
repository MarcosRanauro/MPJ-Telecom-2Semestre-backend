<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/2ffa.css">
  <link rel="stylesheet" href="../styles/header_footer.css">
  <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
  <title>Autenticação</title>
</head>

<body>
  <?php require_once('../components/headerDefault.php'); ?>
  <main class="container-2ffa">
    <h1>Autenticação de 2 fatores</h1>
    <form action="teste2ffa.php" method="POST">
      <label for="cpf">Digite o seu cpf:</label>
      <input type="text" name="cpf" id="cpf" placeholder="Digite seu CPF" oninput="formatCPF(this)">
      <input type="submit" name="submit" value="Enviar">
      <a href="Login.php">Voltar</a>
  </main>
  <?php require_once('../components/footer.php'); ?>
  <script src="../js/formatCPF.js"></script>
</body>

</html>