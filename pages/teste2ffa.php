<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['cpf']) && isset($_SESSION['usu_cpf'])) {
  include_once('../components/config.php');
  $cpf = $_POST['cpf'];
  $cpf_session = $_SESSION['usu_cpf'];
  // print_r($cpf);

  $sql = "SELECT * FROM usuarios WHERE usu_cpf = '$cpf'";
  $result = $conexao->query($sql);

  // print_r($result);
  // print_r($sql);

  if ($result && $result->num_rows > 0) {

    if ($cpf === $cpf_session) {
      $temp_token = bin2hex(random_bytes(16));
      $_SESSION['temp_token'] = $temp_token;
      $_SESSION['temp_token_exp'] = time() + 1500;

      // Defina a variável de sessão para indicar que o usuário passou pela autenticação 2FA.
      $_SESSION['autenticado_2fa'] = true;
      $_SESSION['usu_cpf'] = $cpf;
      header('Location: perfil.php');
    } else {
      header('Location: erro2ffa.php');
    }
  } else {
    unset($_SESSION['autenticado_2fa']);
    unset($_SESSION['usu_cpf']);
    header('Location: erro2ffa.php');
  }
} else {
  header('Location: Login.php');
}
