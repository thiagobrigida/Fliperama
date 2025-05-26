<?php
require_once '../init.php';

$id = $_POST['id_maquina'];
$numero_serie = $_POST['numero_serie'];
$id_jogo = $_POST['id_jogo'];
$estado = $_POST['estado'];

if (empty($numero_serie) || empty($id_jogo) || empty($estado)) {
    echo "Preencha todos os campos!";
    exit;
}

try {
    $PDO = db_connect();
    $sql = "UPDATE Maquina 
            SET numero_serie = :numero_serie, id_jogo = :id_jogo, estado = :estado 
            WHERE id_maquina = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([
        ':numero_serie' => $numero_serie,
        ':id_jogo' => $id_jogo,
        ':estado' => $estado,
        ':id' => $id
    ]);
    echo "Máquina atualizada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao atualizar máquina: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<div class="container"><a href="../index.html" class="btn btn-primary">Voltar para o Início</a></div>
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
      background-color: gray;
      color: white;
      font-family: Arial, sans-serif;
    }
  </style>
<body style="font-family: sans-serif; text-align: center; margin-top: 10px;">
      <div class="container"; id="menu"></div>
</body>
</html>