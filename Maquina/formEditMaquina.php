<?php
require_once '../init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$PDO = db_connect();
$sql = "SELECT * FROM Maquina WHERE id_maquina = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$maquina = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$maquina) {
    echo "Máquina não encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Editar Maquina</title>
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
  <h2>Editar Máquina</h2>
  <form action="editMaquina.php" method="post">
    <input type="hidden" name="id_maquina" value="<?= $maquina['id_maquina'] ?>">

    <label for="numero_serie">Número de Série:</label><br>
    <input type="text" name="numero_serie" value="<?= $maquina['numero_serie'] ?>" required><br><br>

    <label for="id_jogo">ID do Jogo:</label><br>
    <input type="number" name="id_jogo" value="<?= $maquina['id_jogo'] ?>" required><br><br>

    <label for="estado">Estado:</label><br>
    <input type="text" name="estado" value="<?= $maquina['estado'] ?>" required><br><br>

    <input type="submit" value="Salvar Alterações">
  </form>
   <div class="container"><a href="../index.html" class="btn btn-primary">Voltar para o Início</a></div>
</body>
</html>
