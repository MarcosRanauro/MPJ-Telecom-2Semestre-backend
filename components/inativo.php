<?php
if (!empty($_GET['id'])) {
  include_once('config.php');

  $id = $_GET['id'];

  $sqlSelect = "SELECT * FROM usuarios WHERE id = :id";
  $stmtSelect = $pdo->prepare($sqlSelect);
  $stmtSelect->bindParam(':id', $id, PDO::PARAM_INT);
  $stmtSelect->execute();

  if ($stmtSelect && $stmtSelect->rowCount() > 0) {
    $sqlUpdate = "UPDATE usuarios SET usu_estado = 0 WHERE id = :id";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtUpdate->execute();
  }
}
header('Location: ../pages/perfilMaster.php');
?>