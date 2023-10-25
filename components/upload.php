<?php
session_start();
include_once('./config.php');

if ($_FILES["profile_image"]["error"] == 0) {
  $id = $_POST['id'];
  $tipo_usuario = $_POST['tipo_usuario'];
  $temp_name = $_FILES["profile_image"]["tmp_name"];

  $image_data = file_get_contents($temp_name);
  $userID = $id;

  $stmt = $pdo->prepare("UPDATE usuarios SET profile_image = :profile_image WHERE id = :id");
  $stmt->bindParam(":profile_image", $image_data, PDO::PARAM_LOB);
  $stmt->bindParam(":id", $userID, PDO::PARAM_INT);
  $stmt->execute();

  if($stmt->rowCount() > 0) {
    if ($tipo_usuario == 'master') {
      echo '<script>window.location.href = "../pages/perfilMaster.php";</script>';
    } else {
      echo '<script>window.location.href = "../pages/perfil.php";</script>';
    }
  } else {
    if ($tipo_usuario == 'master') {
      echo "A imagem não foi atualizada!";
      echo '<script>window.location.href = "../pages/perfilMaster.php";</script>';
    } else {
      echo "A imagem não foi atualizada!";
      echo '<script>window.location.href = "../pages/perfil.php";</script>';
    }
  }
}
?>