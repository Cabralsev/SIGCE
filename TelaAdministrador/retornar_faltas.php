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

$q = $_GET['q'];
$d = $_GET['d'];

$con = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");

$sql= "SELECT presenca.idTurma , presenca.Matricula , presenca.Data , presenca.Frequencia, pessoa.Nome_Completo
        FROM `presenca` 
        INNER JOIN aluno_matricula_turma ON presenca.Matricula = aluno_matricula_turma.idAluno
        AND presenca.idTurma = aluno_matricula_turma.id_Turma
        INNER JOIN pessoa ON aluno_matricula_turma.idAluno = pessoa.Matricula
        WHERE presenca.Data = ".$q." AND presenca.idTurma = '".$d."'";

$result_alunos = mysqli_query($con,$sql);
if (mysqli_num_rows($result_alunos) < 1) {
    echo "Turma inativada ou inexistente no sistema!";
}

else{
    echo "teste";
}



?>



</body>
</html>
