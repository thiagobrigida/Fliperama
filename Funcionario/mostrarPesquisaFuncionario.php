<?php
require_once '../init.php';

$nome_func = isset($_POST['nome_func']) ? $_POST['nome_func'] : null;

if (empty($nome_func)) {
    header('Location: ../msg/msgErro.html'); // ou exibir uma mensagem de erro simples
    exit;
}

$pesquisa = '%' . strtoupper($nome_func) . '%';

$PDO = db_connect();
$sql = "SELECT id_funcionario, nome_func, turno, cargo 
        FROM Funcionario 
        WHERE UPPER(nome_func) LIKE :nome_func 
        ORDER BY nome_func ASC";

$stmt = $PDO->prepare($sql);
$stmt->bindValue(':nome_func', $pesquisa);
$stmt->execute();
$funcionario = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Resultado da Pesquisa</title>
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
          <td><?= $funcionario['nome_func'] ?></td>
          <td><?= $funcionario['turno'] ?></td>
          <td><?= $funcionario['cargo'] ?></td>
          <td>
            <a href="formEditFuncionario.php?id=<?= $funcionario['id_funcionario'] ?>">Editar</a> |
            <a href="deleteFuncionario.php?id=<?= $funcionario['id_funcionario'] ?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>Nenhum funcionario encontrado com esse nome.</p>
    <a href="../index.html" class="btn btn-primary">Voltar para o Início</a>
  <?php endif; ?>
  </div>
</body>
</html>