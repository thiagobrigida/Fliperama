<?php
require_once '../init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$PDO = db_connect();
$sql = "SELECT * FROM Funcionario WHERE id_funcionario = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$funcionario) {
    echo "Funcionário não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Editar Funcionario</title>
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
    <h1 style="color: aliceblue;">Editar Informações de Funcionário</h1>
    <div class="container">
  <form action="editFuncionario.php" method="post">
    <input type="hidden" name="id_funcionario" value="<?= $funcionario['id_funcionario'] ?>">

    <label for="nome">Nome do Funcionário:</label><br>
    <input type="text" name="nome" value="<?= $funcionario['nome'] ?>" required><br><br>

    <label for="turno">Turno:</label><br>
    <input type="text" name="turno" value="<?= $funcionario['turno'] ?>" required><br><br>

    <label for="cargo">Cargo:</label><br>
    <input type="text" name="cargo" value="<?= $funcionario['cargo'] ?>" required><br><br>

    <input type="submit" value="Salvar Alterações">
  </form>
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