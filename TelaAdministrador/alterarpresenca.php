<?php 
$matricula = "";
$turma = "";
$frequencia = "";
$data = "";

$matricula = $_POST["matricula"];
$turma = $_POST["turma"];
$frequencia = $_POST["frequencia"];
$data = $_POST["dataaula"];

/*
echo $matricula;
echo $turma;
echo $frequencia;
echo $data;
die;
*/

$conn = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u457194965_tcc","u457194965_root","123321");

if ($frequencia == 'Presente') {
	$stmt = $conn ->prepare("UPDATE `presenca` SET `Frequencia` = :FREQUENCIA WHERE presenca.idTurma = :TURMA AND presenca.Matricula = :MATRICULA AND presenca.Data = :DATA");

	$frequencia = "Faltou";

	$stmt ->bindParam(":FREQUENCIA",$frequencia);
	$stmt ->bindParam(":TURMA",$turma);
	$stmt ->bindParam(":MATRICULA",$matricula);
	$stmt ->bindParam(":DATA",$data);
	

if(!$stmt->execute())
	{
		$erro = $stmt->error;
		echo $erro;
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Presença do aluno alterada com sucesso!")';
		echo '</script>';
						//header('Location:register.php');
		header("Location: index.php");
	}
}
else{
	$stmt2 = $conn ->prepare("UPDATE `presenca` SET `Frequencia` = :FREQUENCIA WHERE presenca.idTurma = :TURMA AND presenca.Matricula = :MATRICULA AND presenca.Data = :DATA");

	$frequencia = "Presente";

	$stmt2 ->bindParam(":FREQUENCIA",$frequencia);
	$stmt2 ->bindParam(":TURMA",$turma);
	$stmt2 ->bindParam(":MATRICULA",$matricula);
	$stmt2 ->bindParam(":DATA",$data);
	

if(!$stmt2->execute())
	{
		$erro = $stmt2->error;
		echo $erro;
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Presença do aluno alterada com sucesso!")';
		echo '</script>';
						//header('Location:register.php');
		header("Location: index.php");
	}
}

?>