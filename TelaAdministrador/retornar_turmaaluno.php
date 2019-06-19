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

$sql= "SELECT atividade.Matricula_aluno , pessoa.Nome_Completo , atividade.Nota_1, atividade.Nota_2 ,atividade.Nota_3, atividade.Situacao, atividade.Media , atividade.Turma_idTurma
        FROM atividade
        INNER JOIN pessoa ON atividade.Matricula_aluno = pessoa.Matricula
        INNER JOIN turma ON atividade.Turma_idTurma = turma.Codigo
            WHERE turma.Status = 'Ativo' AND Turma_idTurma = '".$q."'";

$result_alunos = mysqli_query($con,$sql);
if (mysqli_num_rows($result_alunos) < 1) {
    echo "Turma inativada ou inexistente no sistema!";
}

else{
echo "<table id ='dtBasicExample' class= 'table table-striped table-bordered' cellspacing='0' width='100%'>
<tr>
<th>Matricula</th>
<th>Nome do Aluno</th>
<th>Prova 1</th>
<th>Prova 2</th>
<th>Prova Extra</th>
<th>Média</th>
<th>Situação</th>
<th>Atualizar Notas</th>
<th>Excluir Aluno</th>
</tr>";



while($row = mysqli_fetch_array($result_alunos)) {
    echo"<tr>";
    echo"<td>" . $row['Matricula_aluno'] . "</td>";
    echo"<td>" . $row['Nome_Completo'] . "</td>";   
    echo"<td>" .  $row['Nota_1']. "</td>";
    echo"<td>" .  $row['Nota_2']. "</td>";
    echo"<td>" .  $row['Nota_3']. "</td>";
    echo"<td>" .  $row['Media']. "</td>";
    echo"<td>" .  $row['Situacao']."</td>";

    echo "<td>". "<button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#exampleModal' 
                data-matricula=".$row['Matricula_aluno']." 
                data-nome=".$row['Nome_Completo']."
                data-prova1=".$row['Nota_1']." 
                data-prova2=".$row['Nota_2']."
                data-turma=".$row['Turma_idTurma']."
                data-prova3=".$row['Nota_3']."> Atualizar </button> </td>";

    echo "<td>". "<button type='button' class='btn btn-sm btn-danger' data-toggle='modal' data-target='#ExcluiModal' 
                data-matricula=".$row['Matricula_aluno']." 
                data-nome=".$row['Nome_Completo']."
                data-turma=".$row['Turma_idTurma']."> Excluir </button> </td>";
    echo"</tr>";
}
echo "</table>";
}


?>



</body>
</html>
