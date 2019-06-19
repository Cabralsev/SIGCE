<!--"<td>"  "<button class = 'btn btn-danger waves-effect waves-light btn-sm' data-toggle ='modal' data-target='#Enturmar' > Atualizar </button> "  "</td>"; --->

<?php 
include 'conexao1.php';

$matricula = $_POST['mat'];

$result = mysqli_query($conn, 
	"SELECT atividade.Nota_1, atividade.Nota_2 , atividade.Nota_3, atividade.Matricula_aluno, atividade.Media , atividade.Situacao
	FROM atividade
	WHERE Matricula_aluno = '".$matricula."'");




?>