<?php
session_start();
include_once('./config.php');

$tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("SELECT profile_image FROM usuarios WHERE id = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $image_data = $row['profile_image'];

        if ($image_data) {

            $stmt = $pdo->prepare("UPDATE usuarios SET profile_image = NULL WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // A atualização do banco de dados foi bem-sucedida
                if ($tipo_usuario == 'master') {
                    echo '<script>window.location.href = "../pages/perfilMaster.php";</script>';
                } else {
                    echo '<script>window.location.href = "../pages/perfil.php";</script>';
                }
            } else {
                // Ocorreu um erro ao atualizar o banco de dados
                echo "Erro ao atualizar o banco de dados.";
            }

            exit();
        }
    }
}
