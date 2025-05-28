<?php
require_once '../init.php';

$numero_serie = $_POST['numero_serie'];
$id_jogo = $_POST['id_jogo'];
$estado = $_POST['estado'];

if (empty($numero_serie) || empty($id_jogo) || empty($estado)) {
    echo "Preencha todos os campos!";
    exit;
}

try {
    $PDO = db_connect();
    $sql = "INSERT INTO Maquina (numero_serie, id_jogo, estado) 
            VALUES (:numero_serie, :id_jogo, :estado)";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([
        ':numero_serie' => $numero_serie,
        ':id_jogo' => $id_jogo,
        ':estado' => $estado
    ]);
    echo "Máquina cadastrada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao cadastrar máquina: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Adicionar Maquina</title>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="../bootstrap/js/popper.min.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>
  <script src="../bootstrap/js/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $(function () {
        $("#menu").load("../navbar/navbar.html");
      });
    });
  </script>
</head>

<body style="font-family: sans-serif; text-align: center; margin-top: 10px;">
      <div class="container"; id="menu"></div>
      <div class="container"><a href="../index.html" class="btn btn-secondary" style="margin-top: 5%;">Voltar para o Início</a></div>
</body>
</html>


<style>
    body {
      background-color: gray;
      color: white;
      font-family: Arial, sans-serif;
    }
  </style>
  