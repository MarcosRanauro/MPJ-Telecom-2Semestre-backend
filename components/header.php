<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Document</title>
</head>

<body>
    <ul class="navbar-right">
        <?php if ($_SESSION['tipo_usuario']) { ?>
            <li>Olá, <?php echo $_SESSION['usu_login']; ?></li>
            <?php if ($_SESSION['tipo_usuario'] === 'master') { ?>
                <li><a class="peril-logado" href="../pages/perfilMaster.php">Meu Perfil</a></li>
            <?php } else { ?>
                <li><a class="peril-logado" href="../pages/perfil.php">Meu Perfil</a></li>
            <?php } ?>
            <li><a class="peril-logado" href="../components/sair.php">Sair</a></li>
        <?php } else { ?>
            <li><a class="menu-primario" href="#">WhatsApp</a></li>
            <li><a class="menu-primario" href="#">FAQ</a></li>
            <li><a class="menu-primario" href="#">Carreiras</a></li>
            <li><a class="menu-primario" href="#">Contato</a></li>
            <li><a class="menu-primario" href="#">Português</a></li>
            <a class="botao-login" href="./pages/Login.php">
                <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                <button class="botao-login-b">Área do Cliente</button>
            </a>
        <?php } ?>
    </ul>
</body>

</html>