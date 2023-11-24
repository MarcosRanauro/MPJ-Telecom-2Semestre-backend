<?php
session_start();

if (!isset($_SESSION['usu_login']) || !isset($_SESSION['usu_senha']) || !isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'master') {
    unset($_SESSION['usu_login']);
    unset($_SESSION['usu_senha']);
    unset($_SESSION['tipo_usuario']);
    header('Location: Login.php');
}

$logado_login = $_SESSION['usu_login'];
$logado_senha = $_SESSION['usu_senha'];

include_once('../components/config.php');

$required_role = 'master';

if ($_SESSION['role'] !== $required_role) {
    header('Location: perfil.php');
}

$sql = "SELECT * FROM usuarios WHERE usu_login = :login AND usu_senha = :senha";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':login', $logado_login, PDO::PARAM_STR);
$stmt->bindParam(':senha', $logado_senha, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    $logado_nome = $row['usu_nome'];
    $logado_email = $row['usu_email'];
    $logado_dataNasc = $row['usu_dataNasc'];
    $logado_sexo = $row['usu_sexo'];
    $logado_nomeMaterno = $row['usu_nomeMaterno'];
    $logado_cpf = $row['usu_cpf'];
    $logado_celular = $row['usu_celular'];
    $logado_telefoneFixo = $row['usu_telefoneFixo'];
    $logado_endereco = $row['usu_endereco'];
    $logado_tipo_usuario = $row['tipo_usuario'];
} else {
    $logado_nome = "Não encontrado";
    $logado_email = "Não encontrado";
    $logado_dataNasc = "Não encontrado";
    $logado_sexo = "Não encontrado";
    $logado_nomeMaterno = "Não encontrado";
    $logado_cpf = "Não encontrado";
    $logado_celular = "Não encontrado";
    $logado_telefoneFixo = "Não encontrado";
    $logado_endereco = "Não encontrado";
    $logado_tipo_usuario = "Não encontrado";
}

$sql_dadosDB = "SELECT * FROM usuarios ORDER BY usu_nome";
$result_dadosDB = $pdo->query($sql_dadosDB);

include_once('../components/formatDate.php');

$sqlImage = "SELECT profile_image FROM usuarios WHERE id = :id";
$stmt2 = $pdo->prepare($sqlImage);
$stmt2->bindParam(':id', $id, PDO::PARAM_INT);
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

if ($row2) {
    $image_data = $row2['profile_image'];
    if ($image_data !== null) {
        $image_path = 'data:image/jpeg;base64,' . base64_encode($image_data);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link href="../styles/perfilMaster.css" rel="stylesheet">
  <link href="../styles/header_footer.css" rel="stylesheet">
  <title>Perfil Master</title>
</head>

<body>
  <?php if ($_SESSION['tipo_usuario']) { ?>
    <?php require_once('../components/header.php'); ?>
  <?php } else { ?>
    <?php require_once('../components/headerDefault.php'); ?>
  <?php } ?>
  <div class="container-titulo">
    <h1>Perfil do Usuário</h1>
  </div>
  <div class="m-1 container-master">
    <div class="container-perfil">
      <div class="container-imagem">
        <form id="upload-form" action="../components/upload.php" method="POST" enctype="multipart/form-data">
          <div class="image-preview">
            <img src="<?php echo $image_path ?>">
          </div>
          <div class="container-buttons">
            <input type="file" class="upload-files" name="profile_image" accept="image/*">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="tipo_usuario" value="<?php echo $logado_tipo_usuario ?>">
            <input type="submit" class="upload-button" value="Carregar Foto">
          </div>
        </form>
        <div id="alert" style="display: none;"></div>
        <form id="delete-form" action="../components/delete_image.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="tipo_usuario" value="<?php echo $logado_tipo_usuario ?>">
          <input type="submit" class="delete-button" value="Excluir Foto" name="delete" onclick="return confirm('Tem certeza de que deseja excluir sua foto de perfil?');">
        </form>
      </div>


      <div class="container-infos">
        <h2>Bem vindo ao perfil de Administrador, <?php echo $logado_login; ?></h2>
        <p>Nome: <?php echo $logado_nome; ?></p>
        <p>E-Mail: <?php echo $logado_email; ?></p>
        <p>Sexo: <?php echo $logado_sexo; ?></p>
        <p>Data de Nascimento: <?php echo $logado_dataNasc; ?></p>
        <p>Nome da Mãe: <?php echo $logado_nomeMaterno; ?></p>
        <p>CPF: <?php echo $logado_cpf; ?></p>
        <p>Celular: <?php echo $logado_celular; ?></p>
        <p>Telefone Fixo: <?php echo $logado_telefoneFixo; ?></p>
        <p>Endereço: <?php echo $logado_endereco; ?></p>
        <a class="btn btn-primary" href="mensagensSuporte.php" role="button">Mensagens do Suporte</a>
      </div>

    </div>
    <div class="container-pesquisa">
      <h3>Pesquisa de Usuarios</h3>
      <select id="criteria" class="form-select form-select-sm" aria-label="Small select example">
        <option selected>Escolha o Parâmetro de Pesquisa</option>
        <option value="email">E-Mail</option>
        <option value="nome">Nome</option>
        <option value="id">ID</option>
        <option value="cpf">CPF</option>
      </select>
      <input type="search" class="form-control rounded" placeholder="Pesquisar" id="pesquisar" />
      <button type="button" class="btn btn-outline-primary" id="btn-pesquisar"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
        </svg></button>
    </div>
    <div>
      <table class="table table-success table-striped">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">E-Mail</th>
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
            <th scope="col">Estado do Usuario</th>
            <th scope="col">Configurações</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($user_data = $result_dadosDB->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>";
              echo "<td data-criteria='id'>" . $user_data['id'] . "</td>";
              echo "<td data-criteria='nome'>" . $user_data['usu_nome'] . "</td>";
              echo "<td data-criteria='email'>" . $user_data['usu_email'] . "</td>";
              echo "<td>" . $user_data['usu_dataNasc'] . "</td>";
              echo "<td>" . $user_data['usu_sexo'] . "</td>";
              echo "<td>" . $user_data['usu_nomeMaterno'] . "</td>";
              echo "<td data-criteria='cpf'>" . $user_data['usu_cpf'] . "</td>";
              echo "<td>" . $user_data['usu_celular'] . "</td>";
              echo "<td>" . $user_data['usu_telefoneFixo'] . "</td>";
              echo "<td>" . $user_data['usu_endereco'] . "</td>";
              echo "<td>" . $user_data['usu_login'] . "</td>";
              echo "<td>" . $user_data['usu_senha'] . "</td>";
              echo "<td>" . $user_data['usu_confirmarSenha'] . "</td>";
              echo "<td>" . $user_data['tipo_usuario'] . "</td>";
              echo "<td>" . $user_data['usu_estado'] . "</td>";
              echo "<td>
                    <a class='btn btn-sm btn-primary' href='editCadastro.php?id=$user_data[id]' title='Editar'><span><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                    <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                  </svg>Editar</span>
                  </a>
                  <a class='btn btn-sm btn-danger' href='../components/inativo.php?id=$user_data[id]' title='Desativar'><span><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person-fill-lock' viewBox='0 0 16 16'>
                  <path d='M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z'/>
                </svg>Desativar</span>
                </a>
                <a class='btn btn-sm btn-success' href='../components/ativo.php?id=$user_data[id]' title='Ativar'><span><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person-fill-add' viewBox='0 0 16 16'>
                <path d='M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z'/>
                <path d='M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z'/>
              </svg>Ativar</span>
                </a>
              </td>";
              echo "</tr>";
          }
?>
        </tbody>
      </table>
    </div>
  </div>
  <?php require_once('../components/footer.php'); ?>

  <script src="../js/pesquisaUsuarios.js"></script>
</body>

</html>