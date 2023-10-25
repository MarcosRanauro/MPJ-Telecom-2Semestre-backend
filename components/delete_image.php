<?php
session_start();
include_once('./config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $tipo_usuario = $_POST['tipo_usuario'];

    $stmt = $pdo->prepare("SELECT profile_image_path FROM usuarios WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $image_path = $row['profile_image_path'];

        if (file_exists($image_path)) {
            unlink($image_path);

            $stmt = $pdo->prepare("UPDATE usuarios SET profile_image_path = NULL WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if($tipo_usuario == 'master') {
                header('Location: ../pages/perfilMaster.php');
                exit();
            } else {
                header('Location: ../pages/perfil.php');
                exit();
            }
        }
    }
}
if($tipo_usuario == 'master') {
    header('Location: ../pages/perfilMaster.php');
    exit();
} else {
    header('Location: ../pages/perfil.php');
    exit();
}
?>