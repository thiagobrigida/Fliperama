<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Deletar Jogo</title>
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

<?php
require_once '../init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    echo "ID inválido!";
    exit;
}

try {
    $PDO = db_connect();
    $sql = "DELETE FROM Jogo WHERE id_jogo = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "Jogo excluído com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao excluir jogo: " . $e->getMessage();
}
?>

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