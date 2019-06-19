<?php
 include ("conexao.php");

$turmacodigo = $_POST["retornaprofessor"];
//$turmacodigo = '55555';


$stmt = $obj_mysqli->prepare("SELECT pessoa.Nome_Completo , turma.Periodo_Letivo , nome_turma.nome_turma , curso.Tipo
								FROM turma
								INNER JOIN professor ON professor.Matricula_pessoa = turma.Matricula_professor
								INNER JOIN pessoa ON pessoa.Matricula = professor.Matricula_pessoa
                                INNER JOIN curso ON curso.idCurso = turma.idCurso
                                INNER JOIN nome_turma on nome_turma.idNome = turma.NomeTurma
                                	WHERE turma.Codigo = ? AND turma.Status = 'Ativo'");

$stmt -> bind_param('i', $turmacodigo); 
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
$Nome = $aux_query["Nome_Completo"]; 
$Periodo_Letivo = $aux_query["Periodo_Letivo"];
$nome_turma = $aux_query["nome_turma"];
$Tipo = $aux_query["Tipo"]; 

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