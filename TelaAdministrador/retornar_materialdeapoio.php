    <!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php 

$q = strval($_GET['q']);

$con = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql= "SELECT * FROM materialdeapoio
INNER JOIN turma ON materialdeapoio.idTurma = turma.Codigo
WHERE turma.Status = 'Ativo'
AND idTurma = '".$q."'";

$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result) < 1) {
    echo "Turma inativada, inexistente ou sem arquivos salvos no sistema!";
}
else{
echo "<table id ='dtBasicExample' class= 'table table-striped table-bordered' cellspacing='0' width='100%'>
<tr>
<th>Código da Turma</th>
<th>Descrição</th>
<th>Data de Envio</th>
<th>Arquivos no sistema</th>
<th>Download</th>
<th>Excluir</th>
</tr>";


while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['idTurma'] . "</td>";
    echo "<td>" . utf8_encode($row['Descricao']) . "</td>";
    echo "<td>" . $row['Data_envio'] . "</td>";
    echo "<td>" . $row['Nome_arquivo'] . "</td>";
    echo "<td>" . "<a href=" . "teste/".str_replace(" ", "_",$row['Nome_arquivo']).""." download>" . "<img src = " . "icone/download.png />" ."</a> </td>";
    
    echo "<td>". "<a data-toggle='modal' data-target='#ExcluiModal'
                data-idmaterial=".$row['idMaterial']." 
                data-idturma=".$row['idTurma']." 
                data-descricao=".utf8_encode($row['Descricao'])."
                data-nomearquivo=".$row['Nome_arquivo']."> ".'<img src = "icone/fechar.png"/>'." </a> </td>";
}
echo "</table>";

}

?>

 
</body>
</html>
