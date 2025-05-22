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
} catch (PDOException $e) {
    echo "Erro ao cadastrar cliente: " . $e->getMessage();
}
?>