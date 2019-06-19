<?php 

include ("conexao.php");


$nometurma= "";
$curso = "";

$nometurma = $_POST["nometurma"];
$curso = $_POST["curso"];

$stmt = $obj_mysqli->prepare("INSERT INTO `nome_turma`(`nome_turma`,`idCurso`)VALUES(?,?)");
$stmt -> bind_param('si',$nometurma,$curso);

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
				header("Refresh: 1, index.php");
				
				exit;
			}

?>