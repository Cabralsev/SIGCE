<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
include ("conexao.php");
include ("conexao1.php");


$idAluno = "";
$idTurma = "";
$nota1 = 0;
$nota2 = 0;
$nota3 = 0;
$media = 0;
$Situacao = 'Reprovado';

$idAluno = $_POST["idAluno"];
$idTurma = $_POST["turma"];

$sql = $conn->query("SELECT aluno.Matricula_pessoa , pessoa.Status FROM aluno
					INNER JOIN pessoa ON aluno.Matricula_pessoa = pessoa.Matricula
					WHERE Matricula_pessoa = '".$_POST["idAluno"]."' AND pessoa.Status = 'Ativo' OR pessoa.Status = 'Aguardando Turma'");

if (mysqli_num_rows($sql)>= 1) {

	$sql2 = $conn->query("SELECT Matricula_aluno , Turma_idTurma FROM atividade WHERE Matricula_aluno= '".$_POST["idAluno"]."' AND Turma_idTurma = '".$_POST["turma"]."'");

	if(mysqli_num_rows($sql2)>= 1){
		echo '<script language="javascript">';
		echo 'alert("Aluno já está matriculado nessa turma no sistema!")';
		echo '</script>';
		echo "<div class='carregargif'><i class='fas fa-spinner fa-pulse'></i><span class='sr-only'>Loading...</span></div>";
				//header('Location:register.php');
		header("Refresh: 1, tabelaturma.php");
		exit;
	} 
	else{

		$conn = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u457194965_tcc","u457194965_root","123321");
		$stmt = $conn->prepare("UPDATE pessoa SET Status = :NOVOSTATUS WHERE Matricula = :CODIGO");

		$ativo = "Ativo";
		$stmt ->bindParam(":NOVOSTATUS",$ativo);
		$stmt ->bindParam(":CODIGO",$_POST["idAluno"]);

		$data = date('Y-m-d');		
		$stmt2 = $obj_mysqli->prepare("INSERT INTO `aluno_matricula_turma`(`idAluno`,`id_Turma`,`data_matricula`)VALUES(?,?,?)");

		$stmt2 ->bind_param('sss',$idAluno,$idTurma,$data);

		$stmt3 = $obj_mysqli->prepare("INSERT INTO `atividade`(`Nota_1`,`Nota_2`,`Nota_3`,`Turma_idTurma`,`Matricula_aluno`,`Situacao`,`Media`) VALUES(?,?,?,?,?,?,?)");

		$stmt3->bind_param('iiisssi',$nota1, $nota2,$nota3,$idTurma,$idAluno,$Situacao,$media);

		if(!$stmt->execute())
		{
		$erro = $stmt->error;
		echo $erro;
		}
		if(!$stmt2->execute())
		{
			$erro = $stmt->error;
			echo $erro;
		}
		if(!$stmt3->execute())
		{
			$erro = $stmt2->error;
			echo $erro;
		}

		else
		{
			echo '<script language="javascript">';
			echo 'alert("Cadastro feito com sucesso!")';
			echo '</script>';
			echo "<div class='carregargif'><i class='fas fa-spinner fa-pulse'></i><span class='sr-only'>Loading...</span></div>";
				//header('Location:register.php');
			header("Refresh: 1, tabelaturma.php");
			exit;
		}
	}

	

}
else {
	echo '<script language="javascript">';
	echo 'alert("Matricula informada não existe no sistema!")';
	echo '</script>';
	echo "<div class='carregargif'><i class='fas fa-spinner fa-pulse'></i><span class='sr-only'>Loading...</span></div>";
				//header('Location:register.php');
	header("Refresh: 1, tabelaturma.php");
	exit;
}
?>