<?php
require_once '../init.php';

// Recebendo os dados do formulário
$nome_func = isset($_POST['nome_func']) ? $_POST['nome_func'] : '';
$turno = isset($_POST['turno']) ? $_POST['turno'] : '';
$cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';

// Validação simples
if (empty($nome_func) || empty($turno) || empty($cargo)) {
    echo "Preencha todos os campos!";
    exit;
}

try {
    $PDO = db_connect();
    $sql = "INSERT INTO Funcionario (nome_func, turno, cargo) 
            VALUES (:nome_func, :turno, :cargo)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome_func', $nome_func);
    $stmt->bindParam(':turno', $turno);
    $stmt->bindParam(':cargo', $cargo);
    $stmt->execute();

    echo "Funcionario cadastrado com sucesso!";
    echo '<br><button onclick="window.location.href=\'../index.html\'">Voltar para o Início</button>';
;
} catch (PDOException $e) {
    echo "Erro ao cadastrar funcionário: " . $e->getMessage();
    echo '<br><button onclick="window.location.href=\'../index.html\'">Voltar para o Início</button>';

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Adicionar Funcionário</title>
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
    <div class="container"><a href="../index.html" class="btn btn-primary">Voltar para o Início</a></div>
</body>
</html>
