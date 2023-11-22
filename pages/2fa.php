<?php
session_start();
require_once('../components/tokenFunc.php');
// Nome da chave do token
$token_key = 'temp_token';
// Verifique o token (se necessário)
if (verificarToken($token_key)) {
    // O usuário está autenticado
    $usuario_autenticado = true;
} else {
    $usuario_autenticado = false;
}

if (!isset($_SESSION['tipo_usuario'])) {
    $_SESSION['tipo_usuario'] = ''; // Defina um valor padrão, se necessário
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/2fa.css">
    <link rel="stylesheet" href="../styles/header_footer.css">
    <link rel="stylesheet" href="../fontawesome-free-6.4.0-web/css/all.min.css">
    <title>CPaaS MJP</title>
</head>

<body>
    <?php if ($_SESSION['tipo_usuario']) { ?>
        <?php require_once('../components/header.php'); ?>
    <?php } else { ?>
        <?php require_once('../components/headerDefault.php'); ?>
    <?php } ?>
    <div class="main-produto">
        <section class="main-produto-back">
            <div class="main-produto-titulo">
                <div>
                    <h2>2FA - Autentificação de 2 fatores</h2>
                    <a href="Login.php">Fale com nossos especialistas</a>
                </div>
                <img src="../img/2fa-top.png" alt="Essa é uma imagem 2Fa">
            </div>
        </section>
        <section class="main-produto-descri">
            <div class="main-produto-descri-texto">
                <h2>Como Funciona?</h2>
                <p>2FA, ou Autenticação de Dois Fatores, é um método de segurança utilizado para proteger suas contas
                    online e reforçar a autenticação tradicional baseada em senha. Ele adiciona uma camada extra de
                    segurança exigindo que você forneça dois elementos distintos para verificar sua identidade antes de
                    acessar uma conta.
                    O processo de 2FA geralmente envolve três componentes principais: a senha, algo que você possui e
                    algo que você é. A senha é o primeiro fator, que você já está familiarizado, e é geralmente
                    combinada com outros dois fatores para maior segurança.
                    O segundo fator pode ser algo que você possui, como um dispositivo móvel, token de segurança ou
                    chave de hardware. Isso garante que apenas você, o proprietário legítimo da conta, possa ter acesso,
                    pois o dispositivo físico é necessário para concluir o processo de autenticação.
                    O terceiro fator é algo que você é, uma característica biométrica única, como impressão digital,
                    reconhecimento facial ou de voz. Esses atributos pessoais são difíceis de serem replicados por
                    outras pessoas, aumentando ainda mais a segurança do processo de autenticação.</p>
            </div>
            <img src="../img/2fa-descri.png" alt="Essa é uma imagem de 2Fa.">
        </section>
        <section class="main-produto-obj">
            <img src="../img/2fa-descri2.png" alt="Essa é uma imagem de 2Fa.">
            <div class="main-produto-obj-texto">
                <h2>Qual Objetivo?</h2>
                <p>O objetivo principal do 2FA é proteger suas contas online contra ataques de hackers e roubo de
                    identidade. A
                    autenticação tradicional baseada apenas em senha pode ser comprometida caso sua senha seja
                    descoberta,
                    vazada ou se torne vulnerável de alguma forma. Com o 2FA, mesmo que um invasor tenha acesso à sua
                    senha, ele
                    ainda precisará do segundo fator, que geralmente é algo que eles não possuem. O 2FA é uma medida
                    eficaz para
                    aumentar a segurança de suas contas online, reduzindo significativamente as chances de que um
                    invasor possa
                    obter acesso não autorizado. Ao adotar o 2FA, você está fortalecendo sua defesa digital e protegendo
                    seus
                    dados pessoais e informações confidenciais contra ameaças cibernéticas.</p>
            </div>
        </section>
    </div>
    <?php require_once('../components/footer.php'); ?>

</body>

</html>