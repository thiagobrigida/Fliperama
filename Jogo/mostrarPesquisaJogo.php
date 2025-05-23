<?php
require_once '../scripts/init.php';

$nome = isset($_POST['nome']) ? $_POST['nome'] : '';

if (empty($nome)) {
    echo "Informe um nome!";
    exit;
}

$pesquisa = '%' . strtoupper($nome) . '%';

$PDO = db_connect();
$sql = "SELECT * FROM Jogo WHERE UPPER(nome) LIKE :nome ORDER BY nome ASC";
$stmt = $PDO->prepare($sql);
$stmt->bindValue(':nome', $pesquisa);
$stmt->execute();
$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Editar Jogos</title>
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
      background-color: black;
      color: white;
      font-family: Arial, sans-serif;
    }
  </style>
<body style="font-family: sans-serif; text-align: center; margin-top: 10px;">
      <div class="container"; id="menu"></div>
  <h2>Resultado da Pesquisa de Jogos</h2>

  <?php if (count($jogos) > 0): ?>
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
            <a href="formEditJogo.html?id=<?= $jogo['id_jogo'] ?>">Editar</a> |
            <a href="deleteJogo.php?id=<?= $jogo['id_jogo'] ?>">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>Nenhum jogo encontrado com esse nome.</p>
  <?php endif; ?>
 <div class="container"><a href="../index.html" class="btn btn-primary">Voltar para o Início</a></div>
</body>
</html>
