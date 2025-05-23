<?php
require_once '../scripts/init.php';

$id = $_POST['id_jogo'];
$nome = $_POST['nome'];
$categoria = $_POST['categoria'];
$faixa = $_POST['faixa_etaria'];

if (empty($nome) || empty($categoria) || empty($faixa)) {
    echo "Preencha todos os campos!";
    exit;
}

try {
    $PDO = db_connect();
    $sql = "UPDATE Jogo SET nome = :nome, categoria = :categoria, faixa_etaria = :faixa WHERE id_jogo = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':faixa', $faixa);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo "Jogo atualizado com sucesso!";
    echo '<br><button onclick="window.location.href=\'../index.html\'">Voltar para o Início</button>';
} catch (PDOException $e) {
    echo "Erro ao atualizar jogo: " . $e->getMessage();
    echo '<br><button onclick="window.location.href=\'../index.html\'">Voltar para o Início</button>';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Editar Jogo</title>
  <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="bootstrap/js/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
  <script src="bootstrap/js/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $(function () {
        $("#menu").load("navbar.html");
      });
    });
  </script>
</head>

<style>
    body {
      background-color: gray;
      color: white;
      font-family: Arial, sans-serif;
    }
  </style>
<body style="font-family: sans-serif; text-align: center; margin-top: 10px;">
      <div class="container"; id="menu"></div>
    <div class="container"><a href="../index.html" class="btn btn-primary">Voltar para o Início</a></div>
</body>
</html>