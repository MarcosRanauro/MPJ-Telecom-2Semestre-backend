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
    <link rel="stylesheet" href="../styles/header_footer.css">
    <link rel="stylesheet" href="../styles/calls.css">
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
                    <h2>Google Verified Calls</h2>
                    <a href="Login.php">Fale com nossos especialistas</a>
                </div>
                <img id="google-foto" src="../img/verified-calls6.png" alt="Essa é uma imagem do Google Verified Calls.">
            </div>
        </section>
        <section class="main-produto-descri">
            <div class="main-produto-descri-texto">
                <h2>Como Funciona?</h2>
                <p>O Google Verified Calls é um serviço fornecido pelo Google para ajudar os usuários a identificar
                    chamadas telefônicas legítimas e importantes. Ele foi desenvolvido para combater chamadas
                    indesejadas, incluindo chamadas de spam, golpes telefônicos e outras atividades fraudulentas.
                    </br>Quando um chamador habilita o Google Verified Calls, as informações da chamada são verificadas
                    pelo Google e exibidas no dispositivo do destinatário. Essas informações geralmente incluem o nome,
                    o logotipo da empresa e o motivo da ligação. Dessa forma, o destinatário pode tomar uma decisão
                    informada sobre se deseja atender ou não a chamada.</p>
            </div>
            <img src="../img/verified-calls5.png" alt="Essa é uma imagem do Google Verified Calls.">
        </section>
        <section class="main-produto-obj">
            <img src="../img/verified-calls7.png" alt="Essa é uma imagem do Google Verified Calls.">
            <div class="main-produto-obj-texto">
                <h2>Qual Objetivo?</h2>
                <p>Os principais objetivos do Google Verified Calls são:</p>
                <ol>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Combate a
                            chamadas de spam:</h3> O serviço visa ajudar a reduzir a quantidade de chamadas indesejadas
                        e spam que os usuários recebem diariamente. Ao exibir informações verificadas do chamador, os
                        usuários podem distinguir chamadas legítimas de spam ou golpes telefônicos e tomar a decisão
                        correta ao atender uma ligação.
                    </li>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Proteção contra
                            fraudes:</h3> O Google Verified Calls também é uma medida de segurança para proteger os
                        usuários contra atividades fraudulentas. Ao identificar as chamadas de empresas ou organizações
                        legítimas, os usuários podem ter mais confiança na autenticidade da chamada e evitar possíveis
                        golpes ou tentativas de phishing.
                    </li>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Melhoria da
                            experiência do usuário:</h3>O serviço tem como objetivo melhorar a experiência geral do
                        usuário ao receber chamadas telefônicas. Ao fornecer informações verificadas, como o nome da
                        empresa e o motivo da chamada, o Google Verified Calls ajuda os usuários a tomar decisões mais
                        informadas sobre atender ou ignorar chamadas desconhecidas. É importante notar que o Google
                        Verified Calls está disponível em determinados dispositivos e países, e os chamadores precisam
                        atender a certos critérios para que suas chamadas sejam verificadas. Empresas e organizações
                        interessadas em usar o Google Verified Calls devem seguir as diretrizes e processos fornecidos
                        pelo Google para garantir a legitimidade e autenticidade de suas chamadas.
                    </li>
                </ol>
            </div>
        </section>
    </div>
</body>
<?php require_once('../components/footer.php'); ?>

</html>