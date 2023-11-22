<?php
session_start();
require_once('./components/tokenFunc.php');
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
    $_SESSION['tipo_usuario'] = '';
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/header_footer.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.min.css">
    <title>MPJ</title>
</head>

<body>
    <?php if ($_SESSION['tipo_usuario']) { ?>
        <?php require_once('./components/headerIndex.php'); ?>
    <?php } else { ?>
        <?php require_once('./components/headerDefaultIndex.php'); ?>
    <?php } ?>

    <main class="container-main">
        <div class="container-produto">
            <h1>CPAAS, SERVIÇO DE QUALIDADE!</h1>
            <p>Venha conhecer nosso novo serviço voltado para o CPaaS!</br>
                Saiba mais e fale com um dos nossos especialistas.</p>
            <a class="saiba-mais-button" href="./pages/produto.html">Saiba mais</a>
        </div>
        <div class="container-quem-somos">
            <div class="esq-quem-somos">
                <h1>Quem Somos</h1>
                <p>A MJP é uma operadora de telecomunicações brasileira que oferece a seus clientes o mais alto
                    padrão
                    de qualidade, velocidade e acessibilidade em soluções de comunicação. Serviços que incluem uma ampla
                    gama de valores agregados, oferecendo aos clientes operações mais produtivas, inovadoras e eficazes.
                    Com
                    mais de 20 anos de experiência na indústria global, a MJP hoje é sinônimo de qualidade e
                    eficiência.</p>
            </div>
            <div class="dir-quem-somos">
                <img src="img/quem-somos.png" alt="Essa é a imagem da MJP">
            </div>
        </div>
        <div class="container-mapa">
            <h1>Presença em todo o Rio de Janeiro...</h1>
        </div>
    </main>
    <?php require_once('./components/footerIndex.php'); ?>

</body>

</html>