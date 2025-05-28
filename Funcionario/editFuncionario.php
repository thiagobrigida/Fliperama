
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
</body>
</html>

<?php
require_once '../init.php';

$id = isset($_POST['id_funcionario']) ? (int) $_POST['id_funcionario'] : 0;
$nome = $_POST['nome'];
$turno = $_POST['turno'];
$cargo = $_POST['cargo'];

if (empty($nome) || empty($turno) || empty($cargo)) {
  echo "Preencha todos os campos!";
  exit;
}

try {
    $PDO = db_connect();
    $sql = "UPDATE Funcionario SET nome = :nome, turno = :turno, cargo = :cargo WHERE id_funcionario = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':turno', $turno);
    $stmt->bindParam(':cargo', $cargo);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo "Funcionario atualizado com sucesso!";
    echo '<br><button onclick="window.location.href=\'../index.html\'">Voltar para o Início</button>';

} catch (PDOException $e) {
    echo "Erro ao atualizar funcionario: " . $e->getMessage();
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