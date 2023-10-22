<?php
  // $MYSQLHOST = $_ENV['containers-us-west-118.railway.app'];
  // $MYSQLUSER = $_ENV['root'];
  // $MYSQLPASSWORD = $_ENV['wQjnuMVOknRbYzDQ2MBw'];
  // $MYSQLDATABASE = $_ENV['railway'];
  // $MYSQLPORT = $_ENV['7529'];

  $host = 'containers-us-west-118.railway.app';
  $user = 'root';
  $password = 'wQjnuMVOknRbYzDQ2MBw';
  $database = 'railway';
  $port = '7529';
  
  $conexao = "mysql:host=$host;dbname=$database;port=$port";
  try {
    $pdo = new \PDO($conexao, $user, $password);
  } catch (\PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
  }  

  // if($conexao->connect_error) {
  //   die("Erro de conexão: " . $conexao->connect_error);
  // }
?>