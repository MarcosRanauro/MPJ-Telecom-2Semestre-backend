<?php
session_start();
  // print_r($_REQUEST);

  if(isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['pass'])) {
    //acessa
    include_once('../components/config.php');
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    // print_r($login);
    // print_r($pass);

    $sql_cpf = "SELECT usu_cpf FROM usuarios WHERE usu_login = '$login'";
    $result_cpf = $conexao->query($sql_cpf);

    if($result_cpf && $result_cpf->num_rows > 0) {
      $row_cpf = $result_cpf->fetch_assoc();
      $cpf = $row_cpf['usu_cpf'];
      $_SESSION['usu_cpf'] = $cpf;
    }

    $sql = "SELECT * FROM usuarios WHERE usu_login = '$login' AND usu_senha = '$pass'";
    $result = $conexao->query($sql);

    // print_r($result);
    // print_r($sql);

    if($result && $result->num_rows > 0){
      $row = $result->fetch_assoc();
      $logado_tipoUsuario = $row['tipo_usuario'];
    }

    if(mysqli_num_rows($result) < 1) {
      unset($_SESSION['usu_login']);
      unset($_SESSION['usu_senha']);
      header('Location: Login.php');
    } else {
      $_SESSION['usu_login'] = $login;
      $_SESSION['usu_senha'] = $pass;
      $_SESSION['role'] = $row['tipo_usuario'];
      $_SESSION['tipo_usuario'] = $logado_tipoUsuario;
      if($logado_tipoUsuario == 'master') {
        header('Location: perfilMaster.php');
      } else if($logado_tipoUsuario == 'comum') {
        header('Location: 2ffa.php');
      }
    }

  } else {
    //não acessa
    header('Location: Login.php');
  }
?>