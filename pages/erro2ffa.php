<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/mensagemSuporte.css">
  <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
  <title>Erro 2ffa</title>
</head>

<body>
  <?php if ($_SESSION['tipo_usuario']) { ?>
    <?php require_once('../components/header.php'); ?>
  <?php } else { ?>
    <?php require_once('../components/headerDefault.php'); ?>
  <?php } ?>
  <div class="container-main">
    <h1>Erro de autenticação de dois fatores!</h1>
    <h2>Volte para a autenticação</h2>
    <a href="Login.php">Voltar</a>
  </div>
  <?php require_once('../components/footer.php'); ?>
</body>

</html>