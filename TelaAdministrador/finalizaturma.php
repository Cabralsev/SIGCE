<?php 

$turma = $_POST["hosting-plan"];

$conn = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u457194965_tcc","u457194965_root","123321");


	$stmt = $conn ->prepare("UPDATE turma SET Status = :NOVOSTATUS WHERE Codigo = :CODIGO");
	$stmt2 = $conn ->prepare("DELETE FROM aluno_matricula_turma WHERE id_Turma = :CODIGO");

	$Inativo = "Inativada";

	$stmt ->bindParam(":NOVOSTATUS",$Inativo);
	$stmt ->bindParam(":CODIGO",$turma);
	$stmt2 ->bindParam(":CODIGO",$turma);

	$stmt->execute();
	$stmt2->execute();
	

	$result = $conn->query("SELECT atividade.Matricula_aluno , pessoa.Nome_Completo FROM atividade
							INNER JOIN pessoa ON atividade.Matricula_aluno = pessoa.Matricula
							WHERE atividade.Turma_idTurma  = '".$turma."'");

	while($row = $result->fetch()) {

		$result2 = $conn->query("SELECT aluno_matricula_turma.idAluno FROM aluno_matricula_turma 
								 WHERE idAluno = '".$row['Matricula_aluno']."'");

			$row_count = $result2->rowCount();

			if ($row_count < 1) {

   				$stmt3 = $conn ->prepare("UPDATE pessoa SET Status = :NOVOSTATUS WHERE Matricula = :CODIGO");

   				$Aguardando = "Aguardando Turma";
				$stmt3 ->bindParam(":NOVOSTATUS",$Aguardando);
				$stmt3 ->bindParam(":CODIGO",$row['Matricula_aluno']);
				$stmt3->execute();

				echo '<script language="javascript">';
				echo 'alert("O Aluno '.$row['Nome_Completo'].' teve seu status atualizado para: Aguardando Turma!")';
				echo '</script>';

			}

	}

		echo '<script language="javascript">';
		echo 'alert("Turma finalizada com sucesso!")';
		echo '</script>';
				//header('Location:register.php');
		header("Refresh: 1, notas.php");
		exit;


?>