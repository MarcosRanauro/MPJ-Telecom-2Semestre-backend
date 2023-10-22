<?php
  $dbHost = "127.0.0.1";
  $dbUserName = "root";
  $dbPassword = "1234";
  $dbName = "Telefonia";

  $conexao = new mysqli($dbHost, $dbUserName, $dbPassword, $dbName);

  if($conexao->error) {
    die("Erro: " . $conexao->error);
  }

  // if($conexao->connect_errno) {
  //   echo "Erro";
  // } else {
  //   echo "Conectado com sucesso";
  // };
?>