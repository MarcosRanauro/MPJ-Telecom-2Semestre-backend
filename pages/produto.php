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
    <link rel="stylesheet" href="../styles/produto.css">
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
    <div class="main-cpaas">
        <div class="main-cpaas-titulo">
            <section class="cpaas-titulo">
                <h1>PLATAFORMA CPAAS</h1>
                <p>Atualize sua rede com nosso novo serviço voltado para integração dos canais de comunicação.</p>
                <a href="Login.php">Fale com nossos especialistas</a>
            </section>
            <section class="img-inicio-cpaas">
                <img src="../img/cpaas-inicio.jpg" alt="Essa é uma imagem sobre CPaaS">
            </section>
        </div>
        <div class="main-cpaas-descri">
            <section class="main-cpaas-descri-pri">
                <h2>O que é CPaaS?</h2>
                <p>CPaaS (Comunicações como Serviço, do inglês Communications Platform as a Service) é uma categoria de
                    serviços em nuvem que oferece recursos de comunicação e colaboração para empresas e desenvolvedores.
                    O CPaaS permite que as empresas integrem recursos de comunicação, como voz, vídeo, mensagens de
                    texto e autenticação de dois fatores, em seus aplicativos, serviços ou sistemas existentes por meio
                    de APIs (Interfaces de Programação de Aplicativos).</p>
            </section>
            <section class="main-cpaas-descri-sec">
                <h2>Pra que serve?</h2>
                <p>Ao adotar uma solução CPaaS, as empresas podem aproveitar as capacidades de comunicação em tempo real
                    para melhorar a experiência do cliente, aumentar a eficiência operacional e fornecer canais de
                    comunicação modernos. Isso inclui recursos como chamadas de voz e vídeo em tempo real, mensagens
                    instantâneas, notificações por SMS, autenticação de dois fatores, serviços de fax e muito mais. O
                    CPaaS
                    tem sido amplamente adotado em diversas indústrias, como atendimento ao cliente, serviços
                    financeiros,
                    comércio eletrônico, saúde e muito mais. Ele fornece uma maneira flexível e escalável de adicionar
                    recursos de comunicação em aplicativos e sistemas, permitindo que as empresas se conectem melhor com
                    seus clientes e melhorem suas operações comerciais.</p>
            </section>
        </div>
        <div class="h2-benefi">
            <h2>Serviços</h2>
        </div>
        <section class="card-beneficios">
            <div class="card">
                <img class="img" src="../img/2fa.png" alt="Imagem 1" />
                <div class="card-text">
                    <h2>2FA</h2>
                    <a href="./2fa.php">Saiba Mais</a>
                </div>
            </div>

            <div class="card">
                <img class="tell" src="../img/tell.png" alt="Imagem 2" />
                <div class="card-text">
                    <h2>Número Máscara</h2>
                    <a href="./tell.php">Saiba Mais</a>
                </div>
            </div>

            <div class="card">
                <img class="img" src="../img/email-auto.png" alt="Imagem 3" />
                <div class="card-text">
                    <h2>SMS Programável</h2>
                    <a href="./sms.php">Saiba Mais</a>
                </div>
            </div>

            <div class="card">
                <img class="img" src="../img/verify-call.png" alt="Imagem 4" />
                <div class="card-text">
                    <h2>Google Verified Calls</h2>
                    <a href="./calls.php">Saiba Mais</a>
                </div>

            </div>

        </section>
    </div>
    <?php require_once('../components/footer.php'); ?>

</body>

</html>