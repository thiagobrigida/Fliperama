<?php
require_once 'init.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$dataNascimento = $_POST['dataNascimento'];

$PDO = db_connect();
$sql = "INSERT INTO usuarios (nome, email, cpf, dataNascimento) VALUES (:nome, :email, :cpf, :dataNascimento)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':dataNascimento', $dataNascimento);

if ($stmt->execute()) {
    header('Location: exibir.php');
} else {
    echo "Erro ao cadastrar";
    print_r($stmt->errorInfo());
}
?>
ntendo Bootstrap, JQuery e Popper 