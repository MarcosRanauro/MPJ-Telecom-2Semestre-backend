<?php
include_once('../components/config.php');
session_start();

if (!isset($_SESSION['usu_login']) || !isset($_SESSION['usu_senha']) || !isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'master') {
  unset($_SESSION['usu_login']);
  unset($_SESSION['usu_senha']);
  unset($_SESSION['tipo_usuario']);
  header('Location: Login.php');
}

$sql_dados_suporte = "SELECT * FROM suporte_contato ORDER BY nome ASC";
$result_dados_suporte = $pdo->query($sql_dados_suporte);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/mensagemSuporte.css">
  <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
  <title>Mensagens Suporte</title>
</head>

<body>
  <?php if ($_SESSION['tipo_usuario']) { ?>
    <?php require_once('../components/header.php'); ?>
  <?php } else { ?>
    <?php require_once('../components/headerDefault.php'); ?>
  <?php } ?>
  <div class="container-main">
    <h1>Mensagens do Suporte</h1>

    <table class="table table-success table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nome</th>
          <th scope="col">E-Mail</th>
          <th scope="col">Mensagem</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($user_data_suporte = $result_dados_suporte->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>" . $user_data_suporte['id'] . "</td>";
          echo "<td>" . $user_data_suporte['nome'] . "</td>";
          echo "<td>" . $user_data_suporte['email'] . "</td>";
          echo "<td>" . $user_data_suporte['mensagem'] . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php require_once('../components/footer.php'); ?>
</body>

</html>