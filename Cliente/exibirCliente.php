<?php
require_once '../init.php';

$PDO = db_connect();
$sql = "SELECT * FROM Cliente ORDER BY nome ASC";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Exibir Cliente</title>
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

<body style="font-family: sans-serif; text-align: center; margin-top: 50px; background-color:gray;">
    <div class="container">
      <div id="menu"></div>
    </div>

    <h2>Clientes Cadastrados</h2>
    <div class="container">
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
    <?php foreach ($clientes as $cliente): ?>
      <tr>
        <td><?= $cliente['id_cliente'] ?></td>
        <td><?= $cliente['nome'] ?></td>
        <td><?= date('d/m/Y', strtotime($cliente['data_nascimento'])) ?></td>
        <td><?= $cliente['telefone'] ?></td>
        <td>
          <a href="formEditCliente.php?id=<?= $cliente['id_cliente'] ?>">Editar</a> |
          <a href="deleteCliente.php?id=<?= $cliente['id_cliente'] ?>" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  </div>
</body>
</html>