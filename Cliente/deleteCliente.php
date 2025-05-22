<?php
require_once '../init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    echo "ID inválido!";
    exit;
}

try {
    $PDO = db_connect();
    $sql = "DELETE FROM Cliente WHERE id_cliente = :id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo "Cliente removido com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao remover cliente: " . $e->getMessage();
}
?>