<?php
$matricula = "";
$turma = "";

$matricula = $_POST["matricula"];
$turma = $_POST["turma"];

	$conn = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u457194965_tcc","u457194965_root","123321");

	$stmt = $conn->prepare("DELETE FROM atividade WHERE Matricula_aluno = :MATRICULA AND Turma_idTurma = :TURMA");
	$stmt->bindParam(":MATRICULA",$matricula);
	$stmt->bindParam(":TURMA",$turma);

	$stmt2 = $conn->prepare("DELETE FROM aluno_matricula_turma WHERE idAluno = :MATRICULA2 AND id_Turma = :TURMA2");
	$stmt2->bindParam(":MATRICULA2",$matricula);
	$stmt2->bindParam(":TURMA2",$turma);

		if(!$stmt->execute())
		{
			$erro = $stmt->error;
			echo $erro;
		}
		if(!$stmt2->execute())
		{
			$erro = $stmt2->error;
			echo $erro;
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Dados do aluno excluídos com sucesso!")';
			echo '</script>';
				//header('Location:register.php');
			header("Refresh: 1, notas.php");
			exit;
		}

?>