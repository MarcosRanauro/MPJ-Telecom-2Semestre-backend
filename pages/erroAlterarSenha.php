<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="../styles/header_footer.css">
    <link rel=stylesheet href="../styles/erroEditCadastro.css">
    <title>Erro no Cadastro</title>
</head>

<body>
    <?php if ($_SESSION['tipo_usuario']) { ?>
        <?php require_once('../components/header.php'); ?>
    <?php } else { ?>
        <?php require_once('../components/headerDefault.php'); ?>
    <?php } ?>
    <main>
        <h1>Ocorreram erros durante a alteração de senha:</h1>
        <ul>
            <?php
            // Verifique se há mensagens de erro na URL
            if (isset($_GET['errors'])) {
                $errorMessages = json_decode($_GET['errors']);
                foreach ($errorMessages as $error) {
                    echo "<li>$error</li>";
                }
            } else {
                echo "<li>Erro desconhecido.</li>";
            }
            ?>
        </ul>
        <a href="javascript:history.go(-1)">Voltar para a página de alterar senha!</a>
    </main>
    <?php require_once('../components/footer.php'); ?>
</body>

</html>