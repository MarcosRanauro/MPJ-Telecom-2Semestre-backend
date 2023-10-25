<?php
session_start();
include_once('./config.php');
$tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("SELECT profile_image_path FROM usuarios WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $image_path = $row['profile_image_path'];
        if (file_exists($image_path)) {
            if (unlink($image_path)) {
                $stmt = $pdo->prepare("UPDATE usuarios SET profile_image_path = NULL WHERE id = :id");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                if ($tipo_usuario == 'master') {
                    echo '<script>window.location.href = "../pages/perfilMaster.php";</script>';
                } else {
                    echo '<script>window.location.href = "../pages/perfil.php";</script>';
                }
            } else {
                if ($tipo_usuario == 'master') {
                    echo '<script>window.location.href = "../pages/perfilMaster.php";</script>';
                } else {
                    echo '<script>window.location.href = "../pages/perfil.php";</script>';
                }
            }
        }
    }
}