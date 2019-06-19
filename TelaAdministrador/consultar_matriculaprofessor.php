<?php
 include ("conexao.php");

$matricula = $_POST["matricula"];
//$matricula = '2014123052';


$stmt = $obj_mysqli->prepare("SELECT pessoa.Matricula,pessoa.Nome_Completo ,pessoa.CPF, pessoa.Data_Nascimento,pessoa.Sexo,pessoa.Email,pessoa.CEP,pessoa.Numero_endereco, pessoa.Complemento, telefone.Numero,telefone.Tipo,telefone.Numero_celular, professor.especializacao,professor.instituicao_formacao 
		FROM pessoa
		INNER JOIN telefone ON pessoa.Matricula = telefone.Matricula_pessoa
		INNER JOIN professor ON pessoa.Matricula = professor.Matricula_pessoa
		WHERE Matricula = ?");

$stmt -> bind_param('i', $matricula); 
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
$email = $aux_query["Email"]; 
$cpf = $aux_query["CPF"];
$datanascimento = $aux_query["Data_Nascimento"];
$telefone = $aux_query["Numero"]; 
$Numero_endereco = $aux_query["Numero_endereco"];
$Complemento = $aux_query["Complemento"];
$tipo = $aux_query["Tipo"]; 
$celular = $aux_query["Numero_celular"];
$sexo = $aux_query["Sexo"];
$cep = $aux_query["CEP"];
$especializacao = $aux_query["especializacao"];
$instituicao_formacao = $aux_query["instituicao_formacao"];

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