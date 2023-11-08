<?php 
session_start();
include_once('../components/config.php');

if (!isset($_SESSION['usu_login']) || !isset($_SESSION['usu_senha']) || !isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'master') {
  unset($_SESSION['usu_login']);
  unset($_SESSION['usu_senha']);
  unset($_SESSION['tipo_usuario']);
  header('Location: Login.php');
}

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM suporte_inativo WHERE id = $id";
  $result = $pdo->query($sql);
  header('Location: ../pages/mensagensSuporte.php');
}
?>