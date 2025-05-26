<?php
require_once '../init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$PDO = db_connect();
$sql = "SELECT * FROM Cliente WHERE id_cliente = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    echo "Cliente não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
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
    <h1 style="color: aliceblue;">Editar Informações de Cliente</h1>
    <div class="container">
  <form action="editCliente.php" method="post">
    <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">

    <label for="nome">Nome:</label><br>
    <input type="text" name="nome" value="<?= $cliente['nome'] ?>" required><br><br>

    <label for="data_nascimento">Data de Nascimento:</label><br>
    <input type="date" name="data_nascimento" value="<?= $cliente['data_nascimento'] ?>" required><br><br>

    <label for="telefone">Telefone:</label><br>
    <input type="text" name="telefone" value="<?= $cliente['telefone'] ?>" required><br><br>

    <input type="submit" value="Salvar Alterações">
  </form>
  </div>
  <div class="container"><a href="../index.html" class="btn btn-primary">Voltar para o Início</a></div>
</body>
</html>