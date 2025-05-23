<?php
require_once '../init.php';

// Recebendo os dados do formulário
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';

// Validação simples
if (empty($nome) || empty($data_nascimento) || empty($telefone)) {
    echo "Preencha todos os campos!";
    exit;
}

try {
    $PDO = db_connect();
    $sql = "INSERT INTO Cliente (nome, data_nascimento, telefone) 
            VALUES (:nome, :data_nascimento, :telefone)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':data_nascimento', $data_nascimento);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->execute();

    echo "Cliente cadastrado com sucesso!";
    echo '<br><button onclick="window.location.href=\'../index.html\'">Voltar para o Início</button>';
;
} catch (PDOException $e) {
    echo "Erro ao cadastrar cliente: " . $e->getMessage();
    echo '<br><button onclick="window.location.href=\'../index.html\'">Voltar para o Início</button>';

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Adicionar Cliente</title>
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
    <div class="container"><a href="../index.html" class="btn btn-primary">Voltar para o Início</a></div>
</body>
</html>
