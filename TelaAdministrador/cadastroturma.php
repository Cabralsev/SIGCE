<?php 
include ("conexao.php");

$codigo = "";
$professor = "";
$curso = "" ;
$status = "";
$nometurma ="";
$nivel =  "";
$periodo = "";
$datainicio = "";
$datafim = "";
$horarioinicio ="" ;
$horariofim = "" ;
$turno = "" ;
$nivel = "";
$escolaridaderecomendada= "";


		$codigo = $_POST["codigoturma"];
		$professor = $_POST["professor"];
		$curso = $_POST ["curso"] ;
		$status = $_POST["status"];
		$nometurma = $_POST["turma"];
		$nivel = $_POST ["nivel"];
		$periodo = $_POST["periodoletivo"];
		$datainicio = $_POST ["datainicio"];
		$datafim = $_POST ["datafim"];
		$horarioinicio = $_POST["horarioinicio"] ;
		$horariofim = $_POST["horariofinal"] ;
		$turno = $_POST ["turno"] ;
		$nivel = $_POST["nivel"];
		$escolaridaderecomendada = $_POST["escolaridaderecomendada"];


			if ($status == 'Inativo') {

				echo '<script language="javascript">';
				echo 'alert("Turma com status inativo! Ative-a antes caso queira atualizar seus dados!")';
				echo '</script>';
				header("Refresh: 1, Turmas.php");
				exit;
			}


			$stmt = $obj_mysqli->prepare("INSERT INTO `turma`(`Codigo`,`Matricula_professor`,`Status`,`Periodo_Letivo`,`Data_Inicio`,`Data_Fim`,`Horarioinicio`,`Horariofinal`,`nivel`,`Turno`,`idCurso`,`NomeTurma`,`Escolaridade_Recomendada`)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE Codigo = VALUES(Codigo),
										  						Matricula_professor = VALUES(Matricula_professor),
										  						Status = VALUES(Status),
										  						Periodo_Letivo = VALUES(Periodo_Letivo),
										  						Data_Inicio = VALUES(Data_Inicio),
										  						Data_Fim = VALUES(Data_Fim),
										  						Horarioinicio = VALUES(Horarioinicio),
										  						Horariofinal = VALUES(Horariofinal),
										  						nivel = VALUES(nivel),
										  						Turno = VALUES(Turno), 
										  						idCurso = VALUES(idCurso),
										  						 NomeTurma = VALUES(NomeTurma),
										  						 Escolaridade_Recomendada = VALUES(Escolaridade_Recomendada)");

			$stmt->bind_param('ssssssssssiis',$codigo,$professor,$status,$periodo,$datainicio,$datafim,$horarioinicio,$horariofim,$nivel,$turno,$curso,$nometurma,$escolaridaderecomendada);


			if(!$stmt->execute())
			{
				$erro = $stmt->error;
				echo $erro;
			}	
			else
			{
				echo '<script language="javascript">';
				echo 'alert("Cadastro feito com sucesso!")';
				echo '</script>';
				header("Refresh: 1, Turmas.php");
				exit;
			}		
?>