<?php
require_once '../scripts/init.php';

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
} catch (PDOException $e) {
    echo "Erro ao atualizar cliente: " . $e->getMessage();
}
?>