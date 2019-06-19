<?php 
include 'conexao.php';

$nota1 = "";
$nota2 = "";
$nota3 = "";
$media = "";
$matricula = "";
$situacao = "";
$turma = "";
	
	$nota1 = $_POST["Prova1"];
	$nota2 = $_POST["Prova2"];
	$nota3 = $_POST["Prova3"];
	$media = $_POST["medianotas"];
	$matricula = $_POST["matricula"];
	$situacao = $_POST["situacao"];
	$turma = $_POST["turma"];

		$conn = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u457194965_tcc","u457194965_root","123321");

		$stmt = $conn->prepare("UPDATE atividade SET Nota_1 = :NOTA1 , Nota_2 = :NOTA2 , Nota_3 = :NOTA3 , Media = :MEDIA , Situacao = :SITUACAO WHERE Matricula_aluno = :MATRICULA AND Turma_idTurma =:TURMA");

		$stmt ->bindParam(":NOTA1",$nota1);
		$stmt ->bindParam(":NOTA2",$nota2);
		$stmt ->bindParam(":NOTA3",$nota3);
		$stmt ->bindParam(":MEDIA",$media);
		$stmt ->bindParam(":MATRICULA",$matricula);
		$stmt ->bindParam(":SITUACAO",$situacao);
		$stmt ->bindParam(":TURMA",$turma);

		if(!$stmt->execute())
		{
			$erro = $stmt->error;
			echo $erro;
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Nota atualizada com sucesso!")';
			echo '</script>';
				//header('Location:register.php');
			header("Refresh: 1, notas.php");
			exit;
		}
?>