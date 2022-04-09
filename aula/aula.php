<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-size: 30px;
        }
    </style>
</head>
<body>
    

<pre>
<?php
//-------------------------------------conexão----------------------------------------------
try {
$pdo = new PDO("mysql:dbname=crud;host =localhost","root","");    
}
catch(PDOException $e){
echo'erro no banco de dados'. $e->getMessage();
}
catch(Exception $e){
echo'erro aleatorio'. $e->getMessage();
}
//-------------------------------inserção de dados----------------------------------
//metodo 1//tem que fazer esse processo todo
/*$res = $pdo->prepare("insert into pessoa (nome,telefone,email) values (:n,:t,:e) ");
$res->bindValue(':n','Cleiton'); //aceita qualquer merda
$res->bindValue(':t','2222222');
$res->bindValue(':e','teste@gmail.com');*/
//$nome='miriam';
//$res->bindParam(':n',$nome);//só trabalha com variaveis
//$res->execute();//executa oque foi passado na variavel

//metodo2//executa direto
//$pdo->query("insert into pessoa (nome,telefone,email) values ('Lucifer','666','inferno@gmail.com')")

//-------------------------delete e update-------------------------------------------------
/*$cmd = $pdo->prepare("delete from pessoa where id = :id");
$id = 2;
$cmd->bindValue(':id',$id);
$cmd->execute();*/
//$pdo->query("delete from pessoa where id = 3");

/*$cmd = $pdo->prepare("update pessoa set email = :e where id = :id");
$cmd->bindValue(':e','Miriam@gmail.com');
$cmd->bindValue(':id','1');
$cmd->execute();*/
//$pdo->query("update pessoa set telefone = '10100101010'where id ='1'");




//-------------------------------------select------------------------------------------------------------

$res = $pdo->prepare("select * from pessoa where id = :id");
$res->bindValue(":id","5");
$res->execute();
$resultado = $res->fetch(PDO::FETCH_ASSOC);//somente uma linha do banco de dados// o fetch_assoc é para somente usaros nomes do banco de dados
foreach ($resultado as $key => $value) {// o foreach vai percorrer o array e vai mostrar a a chave(pode ser o id ou email ou nome) e os valores associados às chaves
    echo $key."=".$value."<br>";
}


?>
</pre>
</body>
</html>