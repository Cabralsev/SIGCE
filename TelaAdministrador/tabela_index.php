<?php 

$con = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");

$sql = "SELECT aluno_matricula_turma.id_Turma, nome_turma.nome_turma, count(*) AS QTD FROM `turma` 
INNER JOIN nome_turma ON turma.Nometurma = nome_turma.idNome
INNER JOIN aluno_matricula_turma ON turma.Codigo = aluno_matricula_turma.id_Turma
INNER JOIN pessoa ON pessoa.Matricula = aluno_matricula_turma.idAluno
WHERE turma.Status = 'Ativo' AND pessoa.Status = 'Ativo'
GROUP BY aluno_matricula_turma.id_Turma, nome_turma.nome_turma";

$result_alunos = mysqli_query($con,$sql);
if (mysqli_num_rows($result_alunos) < 1) {
    echo "Sem registro de alunos matriculados!";
}

else{

while($row = mysqli_fetch_array($result_alunos)) {
    
    echo"<tr>";   
    echo"<td>" .  $row['id_Turma']. "</td>";
    echo"<td>" .  $row['nome_turma']. "</td>";
    echo"<td>" .  $row['QTD']. "</td>";
    echo"</tr>";
}

}


?>