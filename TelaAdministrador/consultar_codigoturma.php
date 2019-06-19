<?php 
include ("conexao.php");

$codigoturma = $_POST["codigoturma"];
//$codigoturma = 45611;

$stmt = $obj_mysqli->prepare("SELECT curso.idCurso , nome_turma.idNome, pessoa.Matricula, turma.Codigo, turma.Status, turma.Periodo_Letivo,
turma.Data_Inicio, turma.Data_Fim, turma.nivel, turma.Horarioinicio, turma.Horariofinal, turma.Turno, turma.Escolaridade_Recomendada
FROM turma
INNER JOIN nome_turma ON nome_turma.idNome = turma.NomeTurma
INNER JOIN curso ON curso.idCurso = turma.idCurso
INNER JOIN professor ON professor.Matricula_pessoa = turma.Matricula_professor
INNER JOIN pessoa ON pessoa.Matricula = professor.Matricula_pessoa
WHERE turma.Codigo = ?");

$stmt -> bind_param('i', $codigoturma); 
$stmt->execute();

$result = $stmt -> get_result();
$aux_query = $result -> fetch_assoc();

/*
$stmt2 = $obj_mysqli->prepare("SELECT Numero, Tipo, Numero_celular FROM `telefone` WHERE Matricula_pessoa = ?");
$stmt2->bind_param('i', $matricula); 
$stmt2->execute();

$result2 = $stmt2->get_result();
$aux_query2 = $result2->fetch_assoc();  

*/
$idCurso = $aux_query["idCurso"]; 
$idNome = $aux_query["idNome"]; 
$Matricula = $aux_query["Matricula"];
$Codigo = $aux_query["Codigo"];
$Status = $aux_query["Status"]; 
$Periodo_Letivo = $aux_query["Periodo_Letivo"];
$Data_Inicio = $aux_query["Data_Inicio"];
$Data_Fim = $aux_query["Data_Fim"]; 
$nivel = $aux_query["nivel"];
$Horarioinicio = $aux_query["Horarioinicio"];
$Horariofinal = $aux_query["Horariofinal"];
$Turno = $aux_query["Turno"];
$Escolaridade_Recomendada = $aux_query["Escolaridade_Recomendada"];

$stmt->close();
//$stmt2->close();

/*
if(!$stmt->execute())
			{
				$erro = $stmt->error;
				echo $erro;
			}			
			/*if(!$stmt2->execute())
			{
				$erro = $stmt2->error;
				echo $erro;

			}
			*/
//			else{
//$stmt->close();	
//}
echo json_encode($aux_query);
//echo json_encode($aux_query2);

?>