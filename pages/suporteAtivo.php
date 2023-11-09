<?php
session_start();
include_once('../components/config.php');

if (!isset($_SESSION['usu_login']) || !isset($_SESSION['tipo_usuario'])) {
  unset($_SESSION['usu_login']);
  unset($_SESSION['tipo_usuario']);
  header('Location: ../pages/Login.php');
}

$login = $_SESSION['usu_login'];
$tipo_usuario = $_SESSION['tipo_usuario'];

$sql = "SELECT * FROM usuarios WHERE usu_login = :login";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':login', $login, PDO::PARAM_STR);
$stmt->execute();

if ($stmt && $stmt->rowCount() > 0) {
  $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

  $nome = $user_data['usu_nome'];
  $email = $user_data['usu_email'];
  $id = $user_data['id'];
  // print_r($nome);
  // print_r($email);
  // print_r($id);
}

if (isset($_POST['submit'])) {
  $id_form = $_POST['id'];
  $nome_form = $_POST['nome'];
  $email_form = $_POST['email'];
  $mensagem_form = $_POST['mensagem'];

  $sql_form = "INSERT INTO suporte (usuario_id, nome, email, mensagem) VALUES (:id_form, :nome_form, :email_form, :mensagem_form)";
  $stmt_form = $pdo->prepare($sql_form);
  $stmt_form->bindParam(':id_form', $id_form, PDO::PARAM_INT);
  $stmt_form->bindParam(':nome_form', $nome_form, PDO::PARAM_STR);
  $stmt_form->bindParam(':email_form', $email_form, PDO::PARAM_STR);
  $stmt_form->bindParam(':mensagem_form', $mensagem_form, PDO::PARAM_STR);
  $stmt_form->execute();

  if ($tipo_usuario == 'master') {
    echo "<script>alert('Mensagem enviada com sucesso!');</script>";
    echo "<script>window.location = 'perfilMaster.php';</script>";
  } else {
    echo "<script>alert('Mensagem enviada com sucesso!');</script>";
    echo "<script>window.location = 'perfil.php';</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel='stylesheet' href='../styles/header_footer.css'>
  <link rel='stylesheet' href='../styles/suporte_ativo.css'>
  <title>Suporte de usuários</title>
</head>

<body>
  <?php if ($_SESSION['tipo_usuario']) { ?>
    <?php require_once('../components/header.php'); ?>
  <?php } else { ?>
    <?php require_once('../components/headerDefault.php'); ?>
  <?php } ?>
  <main class="container-ativo">
    <h1>Suporte ao Usuário</h1>
    <form class="form-ativo" action="suporteAtivo.php" method="POST">
      <span>
        id:
        <input class="readonly" type="text" name="id" placeholder="id" value="<?php echo $id ?>" readonly>
      </span>
      <span>
        Nome completo:
        <input class="readonly" type="text" name="nome" placeholder="Nome" value="<?php echo $nome ?>" readonly>
      </span>
      <span>
        E-mail:
        <input class="readonly" type="email" name="email" placeholder="E-mail" value="<?php echo $email ?>" readonly>
      </span>
      <span>
        Mensagem:
        <textarea name="mensagem" id="mensagem" cols="30" rows="10"></textarea>
      </span>
      <input type="submit" name="submit" value="Enviar">
    </form>
  </main>
  <?php include_once('../components/footer.php'); ?>
</body>

</html>