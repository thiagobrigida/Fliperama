<?php
require 'init.php';
$id = isset ( $_GET ['id ']) ? ( int ) $_GET [ 'id ']:null;
$PDO = db_connect() ;
$sql = " SELECT nome, email, cpf, dataNascimento FROM usuarios WHERE id=
: d ";
$stmt = $PDO->prepare( $sql );
$stmt->bindParam( ': id ', $id , PDO :: PARAM_INT);
$stmt->execute () ;
$user = $stmt->fetch ( PDO::FETCH_ASSOC);
// se o método fetch () não retornar um array , significa que o ID não corresponde a um usuário válido

if (!is_array( $user ))
{
header ( 'Location: exibir.php') ;
}
?>
<!DOCTYPE html >
<html lang ="pt-br" >
<head>
<meta charset=" UTF-8" >
<meta name =" viewport" content=" width = device-width ,initial-scale=1.0 " >
<link rel =" stylesheet" href ="../bootstrap/css/bootstrap.min.css" >
<title> CRUD PDO </title >
</head>
<body>
<!-- EXIBIR O MENU -->
<div class =" container" >
<div class =" jumbotron text-center " >
<p class =" h4" > Cadastro de Usuários </p >
</div >
<form action =" atualizar. php" method =" post " >
<input type =" hidden " name =" id" value =" <?php echo $id ?>" >
<div class =" row" >
<div class =" col -sm -6 " >
<div class =" form - group " >
<label for=" name " > Nome : </ label >
<input type =" text " class =" form - control col - sm" name =" nome "
value =" <?php echo $user [ 'nome '] ?>" required >
</div >
</div >
<div class =" col -sm -6 " >
<div class =" form - group " >
<label for=" email " > Email : </ label >
<input type =" text " class =" form-control col-sm " name =" email "
value =" <?php echo $user [ 'email '] ?>" required >
</div >
</div >
</div >
<div class ="row" >
<div class ="col-sm-6" >
<div class =" form-grou " >
<label for=" cpf"> CPF: </label >
<input type =" text " class ="form-control col-sm" name =" cpf"
maxlength=" 15 " onkeypress=" formatar ( '###.###.### -## ' ,
this ) " value =" <?php echo $user [ 'cpf '] ?>" required >
</div >
</div >
<div class =" col -sm -6 " >
<div class =" form - group " >
<label for=" dataNascimento" > Data de Nascimento: </label >
<input type =" date " class =" form - control col - sm " name ="
dataNascimento" style =" width :50%; " value =" <?php echo $user
[ 'dataNascimento '] ?>" required >
</div >
</div >
</div >
<div class =" form - group " >
<button type =" submit " class =" btn btn - primary" > Atualizar <button >
</div >
</form >
</div >
</body >
<script>
function formatar( mascara ,documento) {
let i = documento.value.length;
let saida = '# ';
let texto = mascara. substring(i);
while ( texto . substring (0 ,1) != saida && texto . length ){
documento. value += texto . substring (0 ,1) ;
i ++;
texto = mascara. substring(i);
}
}
</script>
</html>