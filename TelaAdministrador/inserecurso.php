<?php 

include ("conexao.php");


$curso= "";
$descricao = "";

$curso = $_POST["curso"];
$descricao = $_POST["descricao"];

$stmt = $obj_mysqli->prepare("INSERT INTO `curso`(`Tipo`,`Descricao`)VALUES(?,?)");
$stmt -> bind_param('ss',$curso,$descricao);

			if(!$stmt->execute())
			{
				$erro = $stmt->error;
				echo $erro;
			}	

			else
			{
				//header('Location:register.php');
				
				echo '<script language="javascript">';
				echo 'alert("Cadastro feito com sucesso!")';
				echo '</script>';
				header("Refresh: 1, index.php");
				exit;
			}

?>