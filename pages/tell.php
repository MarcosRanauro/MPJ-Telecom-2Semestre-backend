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
    <link rel="stylesheet" href="../styles/tell.css">
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
                    <h2>Number Mask (Número Mascarado)</h2>
                    <a href="Login.php">Fale com nossos especialistas</a>
                </div>
                <img id="nm-principal" src="../img/number-maskingatt.png" alt="Essa é uma imagem de Número Mascarado.">
            </div>
        </section>
        <section class="main-produto-descri">
            <div class="main-produto-descri-texto">
                <h2>Como Funciona?</h2>
                <p>O Número Mascarado é um recurso utilizado para proteger a privacidade dos usuários ao fazerem
                    chamadas telefônicas. Ele funciona como um intermediário entre o chamador e o receptor, ocultando o
                    número real do chamador e fornecendo um número temporário ou fictício no lugar. Em resumo, o Número
                    Mascarado é uma ferramenta que ajuda a proteger a privacidade e a segurança dos usuários durante
                    chamadas telefônicas. Ao ocultar o número real do chamador e fornecer um número temporário, o Number
                    Mask oferece uma camada adicional de anonimato e controle sobre a comunicação telefônica</p>
            </div>
            <img src="../img/number-masking.png" alt="Essa é uma imagem de Número Mascarado.">
        </section>
        <section class="main-produto-obj">
            <img src="../img/Phone-Number-Masking.jpg" alt="Essa é uma imagem de Número Mascarado." id="img-2">
            <div class="main-produto-obj-texto">
                <h2>Qual Objetivo?</h2>
                <p>O principal objetivo do Número Mascarado é preservar a privacidade dos indivíduos, permitindo que
                    eles façam chamadas sem revelar seu número de telefone pessoal. Isso pode ser útil em várias
                    situações, como:</p>
                <ol>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Privacidade do
                            usuário:</h3> Muitas pessoas preferem manter seu número de telefone pessoal
                        confidencial ao ligar para empresas, fornecedores, ou até mesmo para desconhecidos. O Number
                        Mask permite que eles ocultem seu número real e usem um número temporário para manter sua
                        privacidade.
                    </li>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Segurança:</h3>
                        Ao ocultar seu número, os usuários podem evitar possíveis ameaças à segurança,
                        como assédio telefônico, rastreamento ou até mesmo tentativas de fraude. Ao usar um número
                        temporário fornecido pelo Number Mask, é mais difícil para pessoas mal-intencionadas obterem
                        informações pessoais.
                    </li>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Anonimato em
                            transações comerciais:</h3> Em transações comerciais online, o Number Mask pode ser
                        usado para ocultar o número de telefone do vendedor ou comprador. Isso é particularmente
                        útil em plataformas de comércio eletrônico, onde as partes envolvidas podem querer manter
                        seu contato pessoal restrito.
                    </li>
                    <li>
                        <h3><i class="fa fa-check-circle" style="color: #047100;" aria-hidden="true"></i>Controle de
                            comunicação:</h3> O Number Mask também oferece aos usuários maior controle sobre com
                        quem eles compartilham seus números de telefone. Ao fornecer um número temporário, é
                        possível limitar a comunicação apenas a determinados períodos de tempo ou bloquear o número
                        de contato se necessário.
                    </li>
                </ol>
                <p>O funcionamento do Número Mascarado pode variar dependendo da plataforma ou serviço utilizado. Alguns
                    serviços fornecem números temporários que expiram após um determinado período de tempo ou quantidade
                    de
                    chamadas. Outros podem permitir que os usuários personalizem as configurações de privacidade para
                    cada
                    chamada individualmente</p>
            </div>
        </section>
    </div>
    <?php require_once('../components/footer.php'); ?>
</body>

</html>