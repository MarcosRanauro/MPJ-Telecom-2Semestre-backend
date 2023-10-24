<?php
if (isset($_POST['submit'])) {
    include_once('../components/config.php');

    $nome = $_POST['nome'];
    $dataNascimento = $_POST['dataNascimento'];
    $sexo = $_POST['sexo'];
    $nomeMaterno = $_POST['nomeMaterno'];
    $cpf = $_POST['cpf'];
    $cellPhone = $_POST['cell-phone'];
    $phone = $_POST['phone'];
    $endereco = $_POST['endereco'];
    $loginName = $_POST['login-name'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Inicialize um array para armazenar mensagens de erro
    $errors = array();

    // Verifique o campo "login-name" para ter exatamente 6 letras
    if (strlen($loginName) !== 6) {
        $errors[] = "O campo de Login deve ter exatamente 6 letras.";
    }

    // Verifique as senhas para terem exatamente 8 letras
    if (strlen($password) !== 8 || strlen($confirmPassword) !== 8) {
        $errors[] = "A senha deve ter exatamente 8 letras.";
    }

    // Verifique se as senhas são iguais
    if ($password !== $confirmPassword) {
        $errors[] = "As senhas não coincidem. Por favor, verifique.";
    }

    // Mais validações podem ser adicionadas aqui...

    // Após as verificações, você pode verificar se há erros
    if (count($errors) > 0) {
        // Codifique as mensagens de erro em um formato JSON para passar como parâmetro
        $errorMessages = json_encode($errors);

        // Redirecione o usuário para a página de erro com as mensagens de erro
        header("Location: ../components/erro.php?errors=$errorMessages");
        exit; // Encerre o script
    } else {
        // Não houve erros, prossiga com a inserção no banco de dados usando PDO
        $sql = "INSERT INTO usuarios(usu_nome, usu_dataNasc, usu_sexo, usu_nomeMaterno, usu_cpf, usu_celular, usu_telefoneFixo, usu_endereco, usu_login, usu_senha, usu_confirmarSenha) VALUES (:nome, :dataNascimento, :sexo, :nomeMaterno, :cpf, :cellPhone, :phone, :endereco, :loginName, :password, :confirmPassword)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascimento', $dataNascimento, PDO::PARAM_STR);
        $stmt->bindParam(':sexo', $sexo, PDO::PARAM_STR);
        $stmt->bindParam(':nomeMaterno', $nomeMaterno, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':cellPhone', $cellPhone, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
        $stmt->bindParam(':loginName', $loginName, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':confirmPassword', $confirmPassword, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Redirecione o usuário para uma página de sucesso
            header("Location: Login.php");
            exit; // Encerre o script
        } else {
            // Redirecione o usuário para a página de erro
            header("Location: ../components/erro.php");
            exit; // Encerre o script
        }
    }
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
    <title>Cadastro</title>
</head>

<body>
    <?php include_once('../components/headerDefault.php'); ?>
    <main class="container-main">
        <section class="container-img">
            <img src="../img/img-cadastro.png" alt="essa é a imagem principal da página">
        </section>
        <section>
            <form action="Cadastro.php" method="POST" class="container" id="form">
                <div class="form-control form-control-lg input-container">
                    <h1>Crie sua conta</h1>
                    <label for="nome" class="col-form-label">Nome</label>
                    <input class="form-control" type="text" name="nome" id="nome" minlength="15" maxlength="60" require>

                    <label for="dataNascimento" class="col-form-label">Data de Nascimento:</label>
                    <input class="form-control" type="date" id="dataNascimento" name="dataNascimento">

                    <label class="col-form-label" for="sexo">Sexo:</label>
                    <select class="form-control" id="sexo" name="sexo">
                        <option value="null" selected></option>
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="nao-informar">Prefiro não informar</option>
                    </select>

                    <label for="nomeMaterno" class="col-form-label">Nome Materno</label>
                    <input class="form-control" type="text" name="nomeMaterno" id="nomeMaterno" minlength="15" maxlength="60">

                    <label class="col-form-label" for="cpf">CPF:</label>
                    <input class="form-control" type="text" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">


                    <label for="cell-phone" class="col-form-label">Telefone Celular</label>
                    <input type="tel" name="cell-phone" id="cell-phone" class="cell-phone form-control">
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            99 99999 9999
                        </span>
                    </div>

                    <label for="phone" class="col-form-label">Telefone Fixo:</label>
                    <input type="tel" id="phone" name="phone" class="phone form-control">
                    <span id="passwordHelpInline" class="form-text">
                        99 9999 9999
                    </span>

                    <label class="col-form-label" for="endereco">Endereço:</label>
                    <input class="form-control" type="text" id="endereco" name="endereco" placeholder="Rua, número, bairro, etc." required>

                    <label for="login-name" class="col-form-label">Nome de Login</label>
                    <input type="login-name" name="login-name" id="login-name" class="login form-control">
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            Deve ter exatamente 6 caracteres alfabéticos.
                        </span>
                    </div>

                    <label for="password" class="col-form-label">Senha</label>
                    <input type="password" name="password" id="password" class="password form-control">
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            A senha deve conter 8 caracteres alfabéticos.
                        </span>
                    </div>
                    <span id="password-error" class="error-message"></span>

                    <label for="confirm-password" class="col-form-label">Confirme sua senha</label>
                    <input type="password" name="confirm-password" id="confirm-password" class="password form-control">
                    <div class="col-auto">
                        <span id="passwordHelpInline" class="form-text">
                            A senha deve ser exatamente igual a anterior.
                        </span>
                    </div>
                    <span id="confirm-password-error" class="error-message"></span>
                    <fieldset class="main-agreement">
                        <label for="agreement" id="label-infos">Você concorda com o uso das informações acima?</label>
                        <input type="checkbox" name="agreement" id="agreement">
                    </fieldset>

                    <input type="submit" id="submit-btn" class="submit btn btn-primary" name="submit">

                    <input type="reset" id="reset-btn" class="reset btn btn-primary" name="reset">
                </div>

            </form>
        </section>
    </main>
    <?php include_once('../components/footer.php'); ?>

    <script src="../js/cleave.min.js"></script>
    <script src="../js/cleave-phone.br.js"></script>
    <script src="../js/Cadastro.js"></script>

</body>

</html>