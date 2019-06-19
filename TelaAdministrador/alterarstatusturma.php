<?php 
$codigoturma = "";
$status = "";

$codigoturma = $_POST["codigoturmamodal"];
$status = $_POST["statusmodal"];

$conn = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u457194965_tcc","u457194965_root","123321");

if ($status == 'Inativada')
{
	$stmt = $conn ->prepare("UPDATE turma SET Status = :NOVOSTATUS WHERE CODIGO = :CODIGO");

	$ativo = "Ativo";

	$stmt ->bindParam(":NOVOSTATUS",$ativo);
	$stmt ->bindParam(":CODIGO",$codigoturma);

	if(!$stmt->execute())
	{
		$erro = $stmt->error;
		echo $erro;
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Turma Ativada com sucesso!")';
		echo '</script>';
				//header('Location:register.php');
		header("Refresh: 1, Turmas.php");
		exit;
	}

}
else{

	$stmt2 = $conn->prepare("UPDATE turma SET Status = :NOVOSTATUS WHERE Codigo = :CODIGO");

	$novostatus = "Inativada";

	$stmt2->bindParam(":NOVOSTATUS",$novostatus);
	$stmt2->bindParam(":CODIGO",$codigoturma);

	if(!$stmt2->execute())
	{
		$erro = $stmt->error;
		echo $erro;
	}			
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Turma inativada com sucesso!")';
		echo '</script>';
				//header('Location:register.php');
		header("Refresh: 1, Turmas.php");
		exit;
	}
}
?>