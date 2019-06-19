<?php 

$conn = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u457194965_tcc","u457194965_root","123321");

$codigo = $_POST["excluir"];

$stmt = $conn->prepare("DELETE FROM turma WHERE Codigo = :CODIGO");

$stmt->bindParam(":CODIGO",$codigo);


$stmt2 = $conn ->prepare("DELETE FROM aluno_matricula_turma WHERE id_Turma = :CODIGO");

$stmt2->bindParam(":CODIGO",$codigo);


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
				echo 'alert("Exclusão feita com sucesso!")';
				echo '</script>';
				//header('Location:register.php');
				header("Refresh: 2, Turmas.php");
				exit;
			}

?>