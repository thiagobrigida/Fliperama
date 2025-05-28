<?php
require_once '../init.php';

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;

if (empty($nome)) {
    header('Location: ../msg/msgErro.html');
    exit;
}

$pesquisa = '%' . strtoupper($nome) . '%';

$PDO = db_connect();
$sql = "SELECT id_funcionario, nome, turno, cargo 
        FROM Funcionario 
        WHERE UPPER(nome) LIKE :nome 
        ORDER BY nome ASC";

$stmt = $PDO->prepare($sql);
$stmt->bindValue(':nome', $pesquisa);
$stmt->execute();
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Resultado da Pesquisa</title>
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
  <h2>Resultado da Pesquisa</h2>
    <div class="container">
  <?php if (count($funcionarios) > 0): ?>
    <table border="1" cellpadding="10">
      <tr>
        <th>ID</th>
        <th>Nome do Funcionário</th>
        <th>Turno</th>
        <th>Cargo</th>
        <th>Ações</th>
      </tr>
      <?php foreach ($funcionarios as $funcionario): ?>
        <tr>
          <td><?= $funcionario['id_funcionario'] ?></td>
          <td><?= $funcionario['nome'] ?></td>
          <td><?= $funcionario['turno'] ?></td>
          <td><?= $funcionario['cargo'] ?></td>
          <td>
            <a href="formEditFuncionario.php?id=<?= $funcionario['id_funcionario'] ?>">Editar</a> |
            <a href="deleteFuncionario.php?id=<?= $funcionario['id_funcionario'] ?>">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>Nenhum funcionario encontrado com esse nome.</p>
  <?php endif; ?>
  </div>
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