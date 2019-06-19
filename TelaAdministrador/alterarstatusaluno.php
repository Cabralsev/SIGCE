<?php 
$matricula = "";
$status = "";
$datadesistencia = "";
$saida = "";

$matricula = $_POST["codigoaluno"];
$status = $_POST["statusmodal"];
$saida = $_POST["saida1"];

$conn = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u457194965_tcc","u457194965_root","123321");

if ($status == 'Inativado')
{
	$stmt = $conn ->prepare("UPDATE pessoa SET Status = :NOVOSTATUS WHERE Matricula = :CODIGO");
	$stmt3 = $conn -> prepare("UPDATE aluno SET data_desistencia = :DESISTENCIA, Motivo_saida = :SAIDA WHERE Matricula_pessoa = :CODIGO");

	$saida = NULL;
	$ativo = "Aguardando Turma";
	$datadesistencia = NULL;

	$stmt ->bindParam(":NOVOSTATUS",$ativo);
	$stmt ->bindParam(":CODIGO",$matricula);
	$stmt3->bindParam(":CODIGO",$matricula);
	$stmt3->bindParam(":DESISTENCIA",$datadesistencia);
	$stmt3->bindParam(":SAIDA",$saida);

	if(!$stmt->execute())
	{
		$erro = $stmt->error;
		echo $erro;
	}
	if(!$stmt3->execute())
	{
		$erro = $stmt3->error;
		echo $erro;
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Status aluno ativado com sucesso!")';
		echo '</script>';
				//header('Location:register.php');
		header("Refresh: 1, aluno.php");
		exit;
	}

}
else{

	$stmt2 = $conn->prepare("UPDATE pessoa SET Status = :NOVOSTATUS WHERE Matricula = :CODIGO");
	$stmt4 = $conn->prepare("UPDATE aluno SET data_desistencia = :DESISTENCIA , Motivo_saida = :SAIDA WHERE Matricula_pessoa = :CODIGO");
	$stmt5 = $conn->prepare("DELETE FROM aluno_matricula_turma WHERE idAluno = :CODIGO");

	$novostatus = "Inativado";
	$datadesistencia = date('Y/m/d');

	$stmt2->bindParam(":NOVOSTATUS",$novostatus);
	$stmt2->bindParam(":CODIGO",$matricula);
	$stmt4->bindParam(":DESISTENCIA",$datadesistencia);
	$stmt4->bindParam(":CODIGO",$matricula);
	$stmt4->bindParam(":SAIDA",$saida);
	$stmt5->bindParam(":CODIGO",$matricula);

	if(!$stmt2->execute())
	{
		$erro = $stmt2->error;
		echo $erro;
	}
	if(!$stmt4->execute())
	{
		$erro = $stmt4->error;
		echo $erro;
	}
	if(!$stmt5->execute())
	{
		$erro = $stmt5->error;
		echo $erro;
	}			
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Aluno inativado com sucesso!")';
		echo '</script>';
				//header('Location:register.php');
		header("Refresh: 1, aluno.php");
		exit;
	}
}


?>