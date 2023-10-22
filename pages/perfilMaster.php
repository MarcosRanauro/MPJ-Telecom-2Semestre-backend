<?php
session_start();
// print_r($_SESSION);

if (!isset($_SESSION['usu_login']) == true && !isset($_SESSION['usu_senha']) == true && !isset($_SESSION['tipo_usuario']) == 'master') {
  unset($_SESSION['usu_login']);
  unset($_SESSION['usu_senha']);
  unset($_SESSION['tipo_usuario']);
  header('Location: Login.php');
}

$logado_login = $_SESSION['usu_login'];
$logado_senha = $_SESSION['usu_senha'];

$required_role = 'master';

if ($_SESSION['role'] !== $required_role) {
  header('Location: perfil.php');
}

include_once('../components/config.php');

$sql = "SELECT * FROM usuarios WHERE usu_login = '$logado_login' AND usu_senha = '$logado_senha'";
$result = $conexao->query($sql);

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $logado_nome = $row['usu_nome'];
  $logado_dataNasc = $row['usu_dataNasc'];
  $logado_sexo = $row['usu_sexo'];
  $logado_nomeMaterno = $row['usu_nomeMaterno'];
  $logado_cpf = $row['usu_cpf'];
  $logado_celular = $row['usu_celular'];
  $logado_telefoneFixo = $row['usu_telefoneFixo'];
  $logado_endereco = $row['usu_endereco'];
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

$sql_dadosDB = "SELECT * FROM usuarios ORDER BY usu_nome";
$result_dadosDB = $conexao->query($sql_dadosDB);
// print_r($result_dadosDB);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <title>Master</title>
</head>

<body>
  <div class="m-5">
    <h1>Perfil Master</h1>
    <div>
      Bem vindo ao perfil de Usúario Master, <?php echo $logado_login; ?> <br>
      Nome: <?php echo $logado_nome; ?><br>
      Sexo: <?php echo $logado_sexo; ?><br>
      Data de Nascimento: <?php echo $logado_dataNasc; ?> <br>
      Nome da Mãe: <?php echo $logado_nomeMaterno; ?> <br>
      CPF: <?php echo $logado_cpf; ?> <br>
      Celular: <?php echo $logado_celular; ?> <br>
      Telefone Fixo: <?php echo $logado_telefoneFixo; ?> <br>
      Endereço: <?php echo $logado_endereco; ?> <br>
      <a href="../index.php">Home</a>
      <a href="../components/sair.php">Sair</a>
    </div>
    <div>
      <table class="table table-success table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Genero</th>
            <th scope="col">Nome Materno</th>
            <th scope="col">CPF</th>
            <th scope="col">Telefone Celular</th>
            <th scope="col">Telefone</th>
            <th scope="col">Endereço</th>
            <th scope="col">Login</th>
            <th scope="col">Senha</th>
            <th scope="col">Confirmação de senha</th>
            <th scope="col">Tipo de Usuario</th>
            <th scope="col">...</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($user_data = mysqli_fetch_assoc($result_dadosDB)) {
            echo "<tr>";
            echo "<td>" . $user_data['id'] . "</td>";
            echo "<td>" . $user_data['usu_nome'] . "</td>";
            echo "<td>" . $user_data['usu_dataNasc'] . "</td>";
            echo "<td>" . $user_data['usu_sexo'] . "</td>";
            echo "<td>" . $user_data['usu_nomeMaterno'] . "</td>";
            echo "<td>" . $user_data['usu_cpf'] . "</td>";
            echo "<td>" . $user_data['usu_celular'] . "</td>";
            echo "<td>" . $user_data['usu_telefoneFixo'] . "</td>";
            echo "<td>" . $user_data['usu_endereco'] . "</td>";
            echo "<td>" . $user_data['usu_login'] . "</td>";
            echo "<td>" . $user_data['usu_senha'] . "</td>";
            echo "<td>" . $user_data['usu_confirmarSenha'] . "</td>";
            echo "<td>" . $user_data['tipo_usuario'] . "</td>";
            echo "<td>
                    <a class='btn btn-sm btn-primary' href='editCadastro.php?id=$user_data[id]' title='Editar'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                    <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                  </svg>
                  </a>
                  <a class='btn btn-sm btn-danger' href='../components/delete.php?id=$user_data[id]' title='Deletar'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                  <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                  <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
                </svg>
                </a>
              </td>";
            echo "</tr>";
          }

          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>