<?php
session_start();
include_once('./config.php');

if ($_FILES["profile_image"]["error"] == 0) {
  $id = $_POST['id'];
  $tipo_usuario = $_POST['tipo_usuario'];
  $temp_name = $_FILES["profile_image"]["tmp_name"];

  $upload_dir = "../Fotos/";

  $image_name = "imagem-de-perfil-ID:" . $id . ".jpg";

  $image_path = $upload_dir . $image_name;

  if (move_uploaded_file($temp_name, $image_path)) {
    $userID = $id;

    $stmt = $pdo->prepare("UPDATE usuarios SET profile_image_path = :profile_image_path WHERE id = :id");
    $stmt->bindParam(":profile_image_path", $image_path, PDO::PARAM_STR);
    $stmt->bindParam(":id", $userID, PDO::PARAM_INT);
    $stmt->execute();

    if ($tipo_usuario == 'master') {
      header('Location: ../pages/perfilMaster.php');
    } else {
      echo "A imagem foi carregada com sucesso e o caminho foi atualizado no banco de dados.";
      header('Location: ../pages/perfil.php');
    }
  } else {
    if ($tipo_usuario == 'master') {
      echo '<script>window.location.href = "../pages/perfilMaster.php";</script>';
    } else {
      echo "Falha ao carregar a imagem.";
      echo '<script>window.location.href = "../pages/perfil.php";</script>';
    }
  }
} else {
  if ($tipo_usuario == 'master') {
    echo '<script>window.location.href = "../pages/perfilMaster.php";</script>';
  } else {
    echo "Erro ao carregar a imagem: " . $_FILES["profile_image"]["error"];
    echo '<script>window.location.href = "../pages/perfil.php";</script>';
  }
}
