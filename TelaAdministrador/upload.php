<?php 
require("conection.php"); // arquivo onde contem parametros de conexão com o MYSQL

if((isset($_GET['operacao'])) && ($_GET['operacao'] == "upload")) // recebe váriáves

{

$file = $_FILES['file']['name'];

$file_size = $_FILES['file']['size'];

$descricao = $_POST['descricao'];

// mude para o diretório que você quizer a partir da raiz do site

$diretorio = "diretoriodestino/";

// tamanho em bytes do seu arquivo - Especifique o tamanho desejado

$max_file_size = 16000; // mais ou menos 120x120 (avatar)

// caso não seja inserido um arquivo

if(empty($file)

{

echo "<center>Arquivo não existente, você deve enviar um arquivo</center>";

echo '<meta http-equiv="refresh" content="3; URL=teste.php">';

}

// caso o arquivo seja maior do que o desejado

elseif ($file_size > $max_file_size)

{

echo "<center>Arquivo muito grande</center>";

echo '<meta http-equiv="refresh" content="3; URL=teste.php">';

}

// se tudo der ok..... prossegue enviando e salvando

else

{

// move o arquivo do temp para o diretório especificado + nome do arquivo

move_uploaded_file($_FILES['avatar']['tmp_name'], $diretorio.$file);

// Grava no banco de dados

$gravar = mysql_query("INSERT INTO tabela (arquivo, descricao) VALUES ('$file', '$descricao')", $con);

//$con = conexão com MYSQL -- >> require("conection.php");

}

}

?>
