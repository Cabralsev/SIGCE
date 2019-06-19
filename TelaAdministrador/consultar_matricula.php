<?php
 include ("conexao.php");

$matricula = $_POST["matricula"];
//$matricula = '2014123528';


$stmt = $obj_mysqli->prepare("SELECT pessoa.Matricula,pessoa.Nome_Completo , pessoa.CPF,pessoa.Data_Nascimento,pessoa.Sexo,pessoa.Email,pessoa.CEP, pessoa.Numero_endereco, pessoa.Complemento,pessoa.EstadoCivil ,telefone.Numero,telefone.Tipo,telefone.Numero_celular,aluno.Escolaridade,aluno.nome_Responsavel,aluno.CPF_Responsavel,aluno.Telefone_Responsavel,aluno.Motivo_saida,pessoa.Status FROM pessoa
					 INNER JOIN telefone ON pessoa.Matricula = telefone.Matricula_pessoa
  					 INNER JOIN aluno ON pessoa.Matricula = aluno.Matricula_pessoa
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
$Status = $aux_query["Status"];
$escolaridade = $aux_query["Escolaridade"];
$EstadoCivil = $aux_query["EstadoCivil"];
$nomeresponsavel = $aux_query["nome_Responsavel"];
$cpfresponsavel = $aux_query["CPF_Responsavel"];
$telefoneresponsavel = $aux_query["Telefone_Responsavel"];
$saida = $aux_query["Motivo_saida"];

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