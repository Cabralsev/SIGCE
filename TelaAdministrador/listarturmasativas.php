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
$sql= "SELECT Codigo as Codigo_Turma, pessoa.Nome_Completo, turma.Status , Periodo_Letivo, nivel, Turno, nome_turma, curso.Tipo 
        FROM nome_turma
         INNER JOIN turma ON idNome = NomeTurma
         INNER JOIN curso ON turma.idCurso = curso.idCurso
         INNER JOIN pessoa ON turma.idProfessor = pessoa.Matricula
          WHERE turma.Status = 'Ativo'";

$result = mysqli_query($con,$sql);
echo "Turmas recomendadas para alunos de: ", $q;
echo "<table>
<tr>
<th>Código da Turma</th>
<th>Nome do Professor</th>
<th>Status da Turma</th>
<th>Periodo Letivo</th>
<th>Nivel</th>
<th>Turno</th>
<th>Nome Turma</th>
<th>Curso</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['Codigo_Turma'] . "</td>";
    echo "<td>" . utf8_encode($row['Nome_Completo']) . "</td>";
    echo "<td>" . $row['Status'] . "</td>";
    echo "<td>" . $row['Periodo_Letivo'] . "</td>";
    echo "<td>" . $row['nivel'] . "</td>";
    echo "<td>" . utf8_encode($row['Turno']) . "</td>";
    echo "<td>" . $row['nome_turma'] . "</td>";
    echo "<td>" . utf8_encode($row['Tipo']) . "</td>";
    echo "</tr>";
}
echo "</table>";



?>
</body>
</html>