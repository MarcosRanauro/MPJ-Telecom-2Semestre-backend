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
    <link rel="stylesheet" href="../styles/sms.css">
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
                    <h2>Mensagem de texto (SMS) Programável</h2>
                    <a href="Login.php">Fale com nossos especialistas</a>
                </div>
                <img id="sms-foto" src="../img/sms-platform.png" alt="Essa é uma imagem de um SMS Programável.">
            </div>
        </section>
        <section class="main-produto-descri">
            <div class="main-produto-descri-texto">
                <h2>Como Funciona?</h2>
                <p>SMS programável refere-se à capacidade de enviar e receber mensagens de texto (SMS) de forma
                    automatizada e personalizada por meio de APIs (interfaces de programação de aplicativos). Essa
                    tecnologia permite que as empresas enviem mensagens de texto em larga escala para seus clientes,
                    colaboradores ou usuários, de maneira personalizada e programada, utilizando plataformas de
                    comunicação. Em resumo, o SMS programável é uma solução poderosa que permite às empresas automatizar
                    o envio de mensagens de texto personalizadas e programadas para uma ampla audiência. Com isso, é
                    possível melhorar a comunicação, aumentar o engajamento do cliente e otimizar processos internos,
                    tudo por meio de uma forma rápida e confiável de comunicação direta.</p>
            </div>
            <img src="../img/sms-platform3.png" alt="Essa é uma imagem de um SMS Programável.">
        </section>
        <section class="main-produto-obj">
            <img id="sms-foto2" src="../img/sms-platform2.png" alt="Essa é uma imagem de um SMS Programável.">
            <div class="main-produto-obj-texto">
                <h2>BENEFÍCIOS</h2>
                <p>O SMS programável oferece várias possibilidades e benefícios para as empresas:</p>
                <ol>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Comunicação em
                            massa:</h3> Com o SMS programável, é possível enviar mensagens para uma grande quantidade de
                        destinatários simultaneamente. Isso é especialmente útil para empresas que precisam transmitir
                        informações importantes, como atualizações de serviços, ofertas especiais, alertas de segurança,
                        lembretes de compromissos ou notificações em tempo real.
                    </li>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Automação de
                            mensagens:</h3> Através de APIs, as empresas podem automatizar o envio de mensagens de texto
                        com base em eventos específicos ou ações desencadeadas por seus sistemas. Por exemplo, um
                        aplicativo pode enviar automaticamente uma mensagem de boas-vindas personalizada assim que um
                        novo usuário se cadastrar.</h3>
                    </li>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Personalização:
                        </h3> Com o SMS programável, as mensagens podem ser personalizadas para cada destinatário. É
                        possível incluir informações como nome, número de pedido, valor da transação, entre outros
                        detalhes relevantes para criar uma experiência mais personalizada e relevante para o
                        destinatário.
                    </li>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Integração com
                            sistemas existentes:</h3> As APIs de SMS programável podem ser integradas a outros sistemas
                        e aplicativos empresariais, como CRMs, sistemas de comércio eletrônico ou software de
                        gerenciamento de eventos. Isso possibilita o envio de mensagens automatizadas com base em
                        eventos específicos ou dados de outros sistemas, agilizando a comunicação e melhorando a
                        eficiência operacional.
                    </li>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Verificação e
                            autenticação:</h3>O SMS programável também é amplamente utilizado para fins de autenticação
                        e verificação de identidade. Por exemplo, ao se cadastrar em um serviço online, é comum receber
                        um código de verificação por SMS para confirmar a identidade e validar o número de telefone.
                    </li>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Engajamento do
                            cliente:</h3> O SMS programável oferece uma maneira direta e eficaz de se envolver com os
                        clientes. As empresas podem enviar pesquisas de satisfação, solicitar feedback, enviar cupons ou
                        promover campanhas de marketing por meio de mensagens de texto.
                    </li>
                </ol>
            </div>
        </section>
    </div>
    <?php require_once('../components/footer.php'); ?>
</body>

</html>