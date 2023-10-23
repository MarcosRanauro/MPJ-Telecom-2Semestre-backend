<?php
session_start();
// print_r($_SESSION);

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
$result_dadosDB = $pdo->query($sql_dadosDB);
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
  <header>
    <section class="cabecalho-primario">
      <ul class="navbar-left">
        <li><a class="menu-primario" href="#">Empresas</a></li>
        <li><a class="menu-primario" href="#">Wholesale</a></li>
        <li><a class="menu-primario" href="#">Institucional</a></li>
      </ul>
      <ul class="navbar-right">
        <?php if ($_SESSION['tipo_usuario']) { ?>
          <?php require_once('../components/header.php'); ?>
        <?php } else { ?>
          <li><a class="menu-primario" href="#">WhatsApp</a></li>
          <li><a class="menu-primario" href="#">FAQ</a></li>
          <li><a class="menu-primario" href="#">Carreiras</a></li>
          <li><a class="menu-primario" href="#">Contato</a></li>
          <li><a class="menu-primario" href="#">Português</a></li>
          <a class="botao-login" href="./pages/Login.php">
            <i class="fa-solid fa-user" style="color: #ffffff;"></i>
            <button class="botao-login-b">Área do Cliente</button>
          </a>
        <?php } ?>
      </ul>
    </section>

    <section class="cabecalho-secundario-cpaas">
      <a href="../index.php">
        <img src="../img/mjp-att.png" alt="essa é a logo da MJP" style="height:65px; width:250px">
      </a>
      <nav>
        <ul class="menu">
          <li class="navbar"><a class="menu-opcoes" href="#">Internet</a>
            <ul>
              <li><a class="submenu" href="#">Internet Dedicada</a></li>
              <li><a class="submenu" href="#">Banda Larga</a></li>
              <li><a class="submenu" href="#">Wi-Fi</a></li>
            </ul>
          </li>
          <li class="navbar"><a class="menu-opcoes" href="#">Telefonia</a>
            <ul>
              <li><a class="submenu" href="#">PABX IP Virtual</a></li>
              <li><a class="submenu" href="#">E1/SIP TRUNK</a></li>
              <li><a class="submenu" href="#">Números 0800 e 40XX</a></li>
            </ul>
          </li>
          <li class="navbar"><a class="menu-opcoes" href="#">Rede e infraestrutura</a>
            <ul>
              <li><a class="submenu" href="#">Ponto-a-Ponto</a></li>
              <li><a class="submenu" href="#">MPLS</a></li>
              <li><a class="submenu" href="#">Fibra Apagada e Dutos</a></li>
              <li><a class="submenu" href="#">Co-locations</a></li>
            </ul>
          </li>
          <li class="navbar"><a class="menu-opcoes" href="#">Mobilidade</a>
            <ul>
              <li><a class="submenu" href="#">Celular Empresarial</a></li>
              <li><a class="submenu" href="#">MVNA/E</a></li>
            </ul>
          </li>
          <li class="navbar"><a class="menu-opcoes" href="./produto.php">CPaaS</a></li>

          <li class="navbar"><a class="menu-opcoes" href="#">Outras soluções</a>
            <ul>
              <li><a class="submenu" href="#">Outsourcing de Hardware</a></li>
            </ul>
          </li>

        </ul>
      </nav>
    </section>
  </header>
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
          while ($user_data = $result_dadosDB->fetch(PDO::FETCH_ASSOC)) {
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
  <footer>
    <section class="container-footer">
      <img class="logo-footer" src="../img/mjp-footer.png" alt="Essa é a logo da MJP" style="height:150px; width:270px">
      <div>
        <button class="media-button">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
          </svg>
        </button>
        <button class="media-button">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
          </svg>
        </button>
        <button class="media-button">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
          </svg>
        </button>
      </div>
      <div>
        <span>Copyright <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-c-circle" viewBox="0 0 16 16">
            <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512Z" />
          </svg> 2023 MJP telecomunicações. Todos os direitos reservados.</span>
      </div>
    </section>
  </footer>
</body>

</html>