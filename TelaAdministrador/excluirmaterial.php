<?php
//include ("conexao.php");
include ("conexao1.php");

$idmaterial = "";
$nomearquivo = "";

$idmaterial = $_POST["idmaterial"];
$nomearquivo = $_POST["nomearquivo"];

$arquivo = "teste/";
$arquivo .= $nomearquivo;


//echo $idmaterial;
//echo $arquivo;
//die;

	$conn->query("DELETE FROM materialdeapoio WHERE idMaterial = '$idmaterial'");
	//$resultado_usuario = mysqli_query($conn, $result_usuario);
	if(mysqli_affected_rows($conn) > 0){
		unlink($arquivo);

				echo '<script language="javascript">';
				echo 'alert("Arquivo deletado com sucesso!")';
				echo '</script>';

			header("Refresh: 2, materialdeapoio.php");
	}
	else{
		
			echo '<script language="javascript">';
			echo 'alert("Houve um erro ao excluir!")';
			echo '</script>';

		header("Refresh: 2, materialdeapoio.php");
	}
