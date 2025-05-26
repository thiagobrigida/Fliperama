<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT Maquina.*, Jogo.nome AS nome_jogo 
        FROM Maquina 
        INNER JOIN Jogo ON Maquina.id_jogo = Jogo.id_jogo 
        ORDER BY Maquina.numero_serie ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$maquinas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Exibir Maquina</title>
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
  <h2>Máquinas Cadastradas</h2>
  <table border="1" cellpadding="10">
    <tr>
      <th>ID</th>
      <th>Número de Série</th>
      <th>Jogo</th>
      <th>Estado</th>
      <th>Ações</th>
    </tr>

    <?php foreach ($maquinas as $maq): ?>
      <tr>
        <td><?= $maq['id_maquina'] ?></td>
        <td><?= $maq['numero_serie'] ?></td>
        <td><?= $maq['nome_jogo'] ?></td>
        <td><?= $maq['estado'] ?></td>
        <td>
          <a href="formEditMaquina.php?id=<?= $maq['id_maquina'] ?>">Editar</a> |
          <a href="deleteMaquina.php?id=<?= $maq['id_maquina'] ?>" onclick="return confirm('Deseja excluir esta máquina?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
      <div class="container"><a href="../index.html" class="btn btn-primary">Voltar para o Início</a></div>
</body>
</html>
