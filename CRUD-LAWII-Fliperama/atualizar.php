<?php
require_once 'init . php ';

$id = $_POST [ 'id '];
$nome = $_POST [ 'nome ' ];
$email = $_POST [ 'email '];
$cpf = $_POST [ 'cpf '];
$dataNascimento = $_POST [ 'dataNascimento '];

$PDO = db_connect() ;
$sql = "UPDATE usuarios SET nome=:nome, email=:email, cpf =:cpf ,
dataNascimento=:dataNascimento WHERE id =:id" ;
$stmt = $PDO->prepare($sql);
$stmt->bindParam( ': nome ', $nome );
$stmt->bindParam( ': email ', $email );
$stmt->bindParam( ': cpf ', $cpf ) ;
$stmt->bindParam( ': dataNascimento ',$dataNascimento );
$stmt->bindParam( ': id ', $id,PDO::PARAM_INT);
if ($stmt->execute())
{
header ( 'Location: exibir.php ') ;
}
else
{
echo "Erro ao alterar";
print_r( $stmt->errorInfo () );
}
?>