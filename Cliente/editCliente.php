
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
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

$id = isset($_POST['id_cliente']) ? (int) $_POST['id_cliente'] : 0;
$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$telefone = $_POST['telefone'];

if (empty($nome) || empty($data_nascimento) || empty($telefone)) {
    echo "Preencha todos os campos!";
    exit;
}

try {
    $PDO = db_connect();
    $sql = "UPDATE Cliente SET nome = :nome, data_nascimento = :data_nascimento, telefone = :telefone WHERE id_cliente = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':data_nascimento', $data_nascimento);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo "Cliente atualizado com sucesso!";
    echo '<br><button onclick="window.location.href=\'../index.html\'">Voltar para o Início</button>';

} catch (PDOException $e) {
    echo "Erro ao atualizar cliente: " . $e->getMessage();
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
