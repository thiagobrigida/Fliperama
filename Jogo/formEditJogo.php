<?php
require_once '../init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$PDO = db_connect();
$sql = "SELECT * FROM Jogo WHERE id_jogo = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$jogo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$jogo) {
    echo "Jogo não encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Editar Jogos</title>
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
  <h2>Editar Jogo</h2>
  <form action="editJogo.php" method="post">
    <input type="hidden" name="id_jogo" value="<?= $jogo['id_jogo'] ?>">

    <label for="nome">Nome do Jogo:</label><br>
    <input type="text" name="nome" value="<?= $jogo['nome'] ?>" required><br><br>

    <label for="categoria">Categoria:</label><br>
    <input type="text" name="categoria" value="<?= $jogo['categoria'] ?>" required><br><br>

    <label for="faixa_etaria">Faixa Etária:</label><br>
    <input type="text" name="faixa_etaria" value="<?= $jogo['faixa_etaria'] ?>" required><br><br>

    <input type="submit" value="Salvar Alterações">
  </form>
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