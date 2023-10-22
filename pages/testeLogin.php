<?php
session_start();
// print_r($_REQUEST);

if (isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['pass'])) {
  //acessa
  include_once('../components/config.php');
  $login = $_POST['login'];
  $pass = $_POST['pass'];

  // print_r($login);
  // print_r($pass);

  $sql_cpf = "SELECT usu_cpf FROM usuarios WHERE usu_login = :login";
  $stmt_cpf = $pdo->prepare($sql_cpf);
  $stmt_cpf->bindParam(':login', $login, PDO::PARAM_STR);
  $stmt_cpf->execute();

  if ($stmt_cpf && $stmt_cpf->rowCount() > 0) {
    $cpf = $stmt_cpf->fetchColumn();
    $_SESSION['usu_cpf'] = $cpf;
  }

  $sql = "SELECT * FROM usuarios WHERE usu_login = :login AND usu_senha = :pass";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':login', $login, PDO::PARAM_STR);
  $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
  $stmt->execute();

  if ($stmt && $stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $logado_tipoUsuario = $row['tipo_usuario'];
  }

  if ($stmt->rowCount() < 1) {
    unset($_SESSION['usu_login']);
    unset($_SESSION['usu_senha']);
    header('Location: Login.php');
  } else {
    $_SESSION['usu_login'] = $login;
    $_SESSION['usu_senha'] = $pass;
    $_SESSION['role'] = $row['tipo_usuario'];
    $_SESSION['tipo_usuario'] = $logado_tipoUsuario;
    if ($logado_tipoUsuario == 'master') {
      header('Location: perfilMaster.php');
    } elseif ($logado_tipoUsuario == 'comum') {
      header('Location: 2ffa.php');
    }
  }
} else {
  //não acessa
  header('Location: Login.php');
}
?>
