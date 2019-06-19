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
//$q = 1111111144;

$con = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql= "SELECT atividade.Nota_1,atividade.Nota_2,atividade.Nota_3,atividade.Media,atividade.Situacao,atividade.Media , nome_turma.nome_turma , turma.Codigo, turma.Periodo_Letivo
FROM atividade
INNER JOIN turma ON atividade.Turma_idTurma = turma.Codigo
INNER JOIN nome_turma ON turma.Nometurma = nome_turma.idNome
WHERE atividade.Matricula_aluno = '".$q."'";

$result = mysqli_query($con,$sql);
if (mysqli_num_rows($result) < 1) {
    echo "Matrícula não utilizada no sistema!";
}

else{
echo " <div class='card-body'>
              <div class='table-responsive'>
<table id='dtBasicExample' class='table table-striped table-bordered table-sm' cellspacing='0' width='100%'>
<tr>
<th>Codigo da Turma</th>
<th>Nome da Turma</th>
<th>Nota 1</th>
<th>Nota 2</th>
<th>Nota 3</th>
<th>Média</th>
<th>Periodo Letivo</th>
<th>Situação</th>
<th>Faltas</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['Codigo'] . "</td>";
    echo "<td>" . $row['nome_turma'] . "</td>";
    echo "<td>" . $row['Nota_1'] . "</td>";
    echo "<td>" . $row['Nota_2'] . "</td>";
    echo "<td>" . $row['Nota_3'] . "</td>";
    echo "<td>" . $row['Media'] . "</td>";
    echo "<td>" . $row['Periodo_Letivo'] . "</td>";
    echo "<td>" . $row['Situacao'] . "</td>";

    $sql2 = "SELECT COUNT(*) AS Faltas FROM presenca WHERE presenca.idTurma  = '".$row['Codigo']."' AND presenca.Matricula = '".$q
    ."' AND presenca.Frequencia = 'Faltou'";
    
    $result2 = mysqli_query($con,$sql2);
    while($row2 = mysqli_fetch_array($result2)){
    echo "<td>" . $row2['Faltas'] . "</td>";    
    }

    echo "</tr>";
}
    echo "</table>";
    echo "</div>";
    echo "</div>";
}
?>
</body>
</html>