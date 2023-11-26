<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['cpf']) && !empty($_POST['email'])) {
    require_once('../components/config.php');
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    // print_r($cpf);
    // print_r($email);

    $sql = "SELECT * FROM usuarios WHERE usu_cpf = :cpf AND usu_email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt && $stmt->rowCount() > 0) {
        $_SESSION['usu_cpf'] = $cpf;
        $_SESSION['usu_email'] = $email;
        header('Location: alterarSenha.php');
    } else {
        unset($_SESSION['usu_cpf']);
        unset($_SESSION['usu_email']);
        echo "<script>alert('CPF ou e-mail incorretos! Por favor, tente novamente.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <link rel="stylesheet" href="../styles/recuperar.css">
    <link rel="stylesheet" href="../styles/header_footer.css">
    <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
    <title>Telecall - Redefinir senha</title>
</head>

<body>
    <?php if ($_SESSION['tipo_usuario']) { ?>
        <?php require_once('../components/header.php'); ?>
    <?php } else { ?>
        <?php require_once('../components/headerDefault.php'); ?>
    <?php } ?>
    <main class="container">
        <form class="recuperar-senha" action="Recuperar.php" method="POST">
            <div class="painel">
                <a href="../index.php">
                    <img src="../img/mjp-att.png" alt="essa é a logo da MJP" style="height:65px; width:250px">
                </a>
                <div class="painel-mensagem">
                    Informe seus dados para recuperar sua senha.
                </div>

                <span>
                    CPF:
                    <input class="readonly" type="text" name="cpf" placeholder="CPF" oninput="formatCPF(this)" required>
                </span>
                <span>
                    E-mail:
                    <input class="readonly" type="email" name="email" placeholder="E-mail" required>
                </span>
                <input type="submit" name="submit" value="Enviar">

                <!-- <div class="painel-box">
                    <div class="form-group  has-feedback">
                        <input type="text" class="form-control  input-lg" placeholder="Seu e-mail">
                        <span class="glyphicon  glyphicon-envelope  form-control-feedback" aria-hidden="true"></span>
                    </div>

                    <div class="painel-botao">
                        <a class="btn  btn-primary  btn-lg  aw-btn-full-width" href="../pages/Login.php"><i class="fa fa-arrow-left" aria-hidden="true"></i>Voltar</a>
                        <button type="submit" class="btn  btn-primary  btn-lg  aw-btn-full-width"> Redefinir senha
                        </button>
                    </div>
                </div> -->
            </div>
        </form>
    </main>
    <?php require_once('../components/footer.php'); ?>

    <script src="../js/formatCPF.js"></script>
</body>

</html>