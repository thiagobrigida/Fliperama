
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Adicionar Funcionario</title>
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
</body>
</html>

<?php
require_once '../init.php';

$nome = $_POST['nome'];
$turno = $_POST['turno'];
$cargo = $_POST['cargo'];

if (empty($nome) || empty($turno) || empty($cargo)) {
    echo "Preencha todos os campos!";
    exit;
}

try {
    $PDO = db_connect();
    $sql = "INSERT INTO Funcionario (nome, turno, cargo) VALUES (:nome, :turno, :cargo)";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':turno' => $turno,
        ':cargo' => $cargo
    ]);
    echo "Funcionário cadastrado com sucesso!";
    echo '<br><button onclick="window.location.href=\'../index.html\'">Voltar para o Início</button>';

} catch (PDOException $e) {
    echo "Erro ao cadastrar Funcionário: " . $e->getMessage();
    echo '<br><button onclick="window.location.href=\'../index.html\'">Voltar para o Início</button>';
}
?>

<style>
    body {
      background-color: gray;
      color: white;
      font-family: Arial, sans-serif;
    }
  </style>