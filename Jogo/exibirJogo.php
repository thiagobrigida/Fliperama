<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT * FROM Jogo ORDER BY nome ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Exibir Jogos</title>
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
  <h2>Jogos Cadastrados</h2>
  <table border="1" cellpadding="10">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Categoria</th>
      <th>Faixa Etária</th>
      <th>Ações</th>
    </tr>

    <?php foreach ($jogos as $jogo): ?>
      <tr>
        <td><?= $jogo['id_jogo'] ?></td>
        <td><?= $jogo['nome'] ?></td>
        <td><?= $jogo['categoria'] ?></td>
        <td><?= $jogo['faixa_etaria'] ?>+</td>
        <td>
          <a href="formEditJogo.php?id=<?= $jogo['id_jogo'] ?>">Editar</a> |
          <a href="deleteJogo.php?id=<?= $jogo['id_jogo'] ?>" onclick="return confirm('Deseja excluir este jogo?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
      <div class="container"><a href="../index.html" class="btn btn-secondary" style="margin-top: 5%;">Voltar para o Início</a></div>
</body>
</html>


<style>
    body {
      background-color: black;
      color: white;
      font-family: Arial, sans-serif;
    }
  </style>