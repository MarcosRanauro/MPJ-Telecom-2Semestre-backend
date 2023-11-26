<?php
session_start();
if (!empty($_GET['id'])) {
    include_once('../components/config.php');

    $id = $_GET['id'];

    $sqlSelect = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sqlSelect);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $nome = $user_data['usu_nome'];
        $email = $user_data['usu_email'];
        $dataNascimento = $user_data['usu_dataNasc'];
        $sexo = $user_data['usu_sexo'];
        $nomeMaterno = $user_data['usu_nomeMaterno'];
        $cpf = $user_data['usu_cpf'];
        $cellPhone = $user_data['usu_celular'];
        $phone = $user_data['usu_telefoneFixo'];
        $endereco = $user_data['usu_endereco'];
        $loginName = $user_data['usu_login'];
        $password = $user_data['usu_senha'];
        $confirmPassword = $user_data['usu_confirmarSenha'];
        $tipoUsuario = $user_data['tipo_usuario'];
    } else {
        header('Location: perfilMaster.php');
    }
} else {
    header('Location: perfilMaster.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/Cadastro.css">
    <link rel="stylesheet" href="../styles/header_footer.css">
    <title>Editar Cadastro</title>
</head>

<body>
    <?php if ($_SESSION['tipo_usuario']) { ?>
        <?php require_once('../components/header.php'); ?>
    <?php } else { ?>
        <?php require_once('../components/headerDefault.php'); ?>
    <?php } ?>
    <div class="container-main">
        <section class="container-img">
            <img src="../img/img-cadastro.png" alt="essa é a imagem principal da página">
        </section>
        <section>
            <form action="../components/saveEdit.php" method="POST" class="container" id="form">
                <div class="form-control form-control-lg input-container">
                    <h1>Editar Cadastro</h1>

                    <label for="nome" class="col-form-label">Nome</label>
                    <input class="form-control" type="text" name="nome" id="nome" minlength="15" maxlength="60" require value="<?php echo $nome ?>">

                    <label for="email" class="col-form-label">E-mail</label>
                    <input class="form-control" type="email" name="email" id="email" placeholder="E-mail" required value="<?php echo $email ?>">

                    <label for="dataNascimento" class="col-form-label">Data de Nascimento:</label>
                    <input class="form-control" type="text" id="dataNascimento" name="dataNascimento" oninput="formatData(this)" value="<?php echo $dataNascimento ?>">

                    <label class="col-form-label" for="sexo">Sexo:</label>
                    <select class="form-control" id="sexo" name="sexo">
                        <option value="null" selected></option>
                        <option value="masculino" <?php echo ($sexo == 'masculino') ? 'selected' : '' ?>>Masculino</option>
                        <option value="feminino" <?php echo ($sexo == 'feminino') ? 'selected' : '' ?>>Feminino</option>
                        <option value="nao-informar" <?php echo ($sexo == 'nao-informar') ? 'selected' : '' ?>>Prefiro não informar</option>
                    </select>

                    <label for="nomeMaterno" class="col-form-label">Nome Materno</label>
                    <input class="form-control" type="text" name="nomeMaterno" id="nomeMaterno" minlength="15" maxlength="60" value="<?php echo $nomeMaterno ?>">

                    <label class=" col-form-label" for="cpf">CPF:</label>
                    <input class="form-control" type="text" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" oninput="formatCPF(this)" value="<?php echo $cpf ?>" required>


                    <label for="cell-phone" class="col-form-label">Telefone Celular</label>
                    <input type="tel" name="cell-phone" id="cell-phone" class="cell-phone form-control" value="<?php echo $cellPhone ?>">
                    <div class=" col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            99 99999 9999
                        </span>
                    </div>

                    <label for="phone" class="col-form-label">Telefone Fixo:</label>
                    <input type="tel" id="phone" name="phone" class="phone form-control" value="<?php echo $phone ?>">
                    <span id=" passwordHelpInline" class="form-text">
                        99 9999 9999
                    </span>

                    <label class="col-form-label" for="endereco">Endereço:</label>
                    <input class="form-control" type="text" id="endereco" name="endereco" placeholder="Rua, número, bairro, etc." required value="<?php echo $endereco ?>">

                    <label for=" login-name" class="col-form-label">Nome de Login</label>
                    <input type="login-name" name="login-name" id="login-name" class="login form-control" value="<?php echo $loginName ?>">
                    <div class=" col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            Deve ter exatamente 6 caracteres alfabéticos.
                        </span>
                    </div>

                    <label for="password" class="col-form-label">Senha</label>
                    <input type="text" name="password" id="password" class="password form-control" value="<?php echo $password ?>">
                    <div class=" col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            A senha deve conter 8 caracteres alfabéticos.
                        </span>
                    </div>
                    <span id="password-error" class="error-message"></span>

                    <label for="confirm-password" class="col-form-label">Confirme sua senha</label>
                    <input type="text" name="confirm-password" id="confirm-password" class="password form-control" value="<?php echo $confirmPassword ?>">
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            A senha deve ser exatamente igual a anterior.
                        </span>
                    </div>

                    <label class="col-form-label" for="tipo_usuario">Tipo de Usuário:</label>
                    <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                        <option value="master" <?php echo ($tipoUsuario == 'master') ? 'selected' : '' ?>>Master</option>
                        <option value="comum" <?php echo ($tipoUsuario == 'comum') ? 'selected' : '' ?>>Comum</option>
                    </select>

                    <span id="confirm-password-error" class="error-message"></span>
                    <fieldset class="main-agreement">
                        <label for="agreement" id="label-infos">Você concorda com o uso das informações acima?</label>
                        <input type="checkbox" name="agreement" id="agreement">
                    </fieldset>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="container-bttn">
                        <input type="submit" id="submit-btn" class="submit btn btn-primary" name="submit">

                        <input type="reset" id="reset-btn" class="reset btn btn-primary" name="reset">
                    </div>
                </div>

            </form>
        </section>
    </div>
    <?php require_once('../components/footer.php'); ?>
    <script src="../js/cleave.min.js"></script>
    <script src="../js/cleave-phone.br.js"></script>
    <script src="../js/Cadastro.js"></script>
    <script src="../js/formatCPF.js"></script>
    <script src="../js/formatData.js"></script>

</body>

</html>