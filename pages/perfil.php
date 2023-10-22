<?php
session_start();
// print_r($_SESSION);

require_once('../components/tokenFunc.php');

if (!isset($_SESSION['usu_login']) && !isset($_SESSION['usu_senha'])) {
  unset($_SESSION['usu_login']);
  unset($_SESSION['usu_senha']);
  header('Location: Login.php');
}

$token_key = 'temp_token';
if (!verificarToken($token_key)) {
  unset($_SESSION['autenticado_2fa']);
  unset($_SESSION['usu_cpf']);
  header('Location: Login.php');
}

if (!isset($_SESSION['autenticado_2fa'])) {
  unset($_SESSION['autenticado_2fa']);
  unset($_SESSION['usu_cpf']);
  header('Location: 2ffa.php');
}

$logado_login = $_SESSION['usu_login'];
$logado_senha = $_SESSION['usu_senha'];

include_once('../components/config.php');

$sql = "SELECT * FROM usuarios WHERE usu_login = :logado_login AND usu_senha = :logado_senha";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':logado_login', $logado_login, PDO::PARAM_STR);
$stmt->bindParam(':logado_senha', $logado_senha, PDO::PARAM_STR);
$stmt->execute();

if ($stmt && $stmt->rowCount() > 0) {
  $user_data_comum = $stmt->fetch(PDO::FETCH_ASSOC);

  $id = $user_data_comum['id'];
  $logado_nome = $user_data_comum['usu_nome'];
  $logado_dataNasc = $user_data_comum['usu_dataNasc'];
  $logado_sexo = $user_data_comum['usu_sexo'];
  $logado_nomeMaterno = $user_data_comum['usu_nomeMaterno'];
  $logado_cpf = $user_data_comum['usu_cpf'];
  $logado_celular = $user_data_comum['usu_celular'];
  $logado_telefoneFixo = $user_data_comum['usu_telefoneFixo'];
  $logado_endereco = $user_data_comum['usu_endereco'];
} else {
  $logado_nome = "Não encontrado";
  $logado_dataNasc = "Não encontrado";
  $logado_sexo = "Não encontrado";
  $logado_nomeMaterno = "Não encontrado";
  $logado_cpf = "Não encontrado";
  $logado_celular = "Não encontrado";
  $logado_telefoneFixo = "Não encontrado";
  $logado_endereco = "Não encontrado";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil</title>
</head>

<body>
  <h1>Bem vindo ao perfil de Usúario, <?php echo $logado_login; ?></h1>
  <p>Nome: <?php echo $logado_nome; ?></p>
  <p>Sexo: <?php echo $logado_sexo; ?></p>
  <p>Data de Nascimento: <?php echo $logado_dataNasc; ?></p>
  <p>Nome da Mãe: <?php echo $logado_nomeMaterno; ?></p>
  <p>CPF: <?php echo $logado_cpf; ?></p>
  <p>Celular: <?php echo $logado_celular; ?></p>
  <p>Telefone Fixo: <?php echo $logado_telefoneFixo; ?></p>
  <p>Endereço: <?php echo $logado_endereco; ?></p>
  <a class='btn btn-sm btn-primary' href='editCadastroComum.php?id=<?php echo $user_data_comum['id']; ?>' title='Editar'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
      <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z' />
    </svg>
  </a>
  <a href="../index.php">Home</a>
  <a href="../components/sair.php">Sair</a>
</body>

</html>