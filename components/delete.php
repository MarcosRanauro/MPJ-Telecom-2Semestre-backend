<?php
if (!empty($_GET['id'])) {
  include_once('config.php');

  $id = $_GET['id'];

  $sqlSelect = "SELECT * FROM usuarios WHERE id = :id";
  $stmtSelect = $pdo->prepare($sqlSelect);
  $stmtSelect->bindParam(':id', $id, PDO::PARAM_INT);
  $stmtSelect->execute();

  if ($stmtSelect && $stmtSelect->rowCount() > 0) {
    $sqlDelete = "DELETE FROM usuarios WHERE id = :id";
    $stmtDelete = $pdo->prepare($sqlDelete);
    $stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtDelete->execute();
  }
}
header('Location: ../pages/perfilMaster.php');
?>
