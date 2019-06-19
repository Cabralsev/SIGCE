<?php
include ("conexao.php");

$matricula= "";
$nome   = "";
$cpf    = "";
$email  = "";
$cidade = "";
$estado = "";
$cep = "";
$bairro = "";
$logradouro = "";
$complemento = "";
$numero = "";
$status = "";
$datanascimento = "";
$senha = "";
$telefone = "";
$tipo = "";
$sexo = "";
$celular = "";
$especializacao = "";
$instiuicao = "";
$nivel = "";
//$cargo = "";

		
		$matricula = $_POST["matricula"];		
		$nome   = $_POST["nome"];
		$cpf    = $_POST["cpf"];
		$email  = $_POST["email"];
		$cidade = $_POST["cidade"];
		$estado = $_POST["estado"];
		$bairro = $_POST["bairro"];
		$cep = $_POST["cep"];
		$logradouro = $_POST["logradouro"];
		$numero = $_POST["numero"];
		$status = $_POST["status"];
		$datanascimento = $_POST["datanascimento"];
		$complemento = $_POST["complemento"];
		$senha = $_POST["senha"];
		$telefone = $_POST["telefone"];
		$tipo = $_POST["tipo"];
		$sexo = $_POST["sexo"];
		$celular = $_POST["celular"];
		$cargo = $_POST["cargo"];
		$nivel = $_POST["nivel"];
		

			$stmt = $obj_mysqli->prepare("INSERT INTO `pessoa`(`Matricula`,`Nome_Completo`,`Email`,`CPF`,`Cidade`,`Estado`,`Bairro`,`CEP`,`Logradouro`,`Numero_endereco`,`Status`,`Data_Nascimento`,`Complemento`,`Senha`,`Sexo`,`Nivel_Usuario`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,sha1(?),?,?) 
																ON DUPLICATE KEY UPDATE Matricula = VALUES(Matricula),
										  						Nome_Completo = VALUES(Nome_Completo),
										  						Email= VALUES(Email),
										  						CPF = VALUES(CPF),
										  						Cidade = VALUES(Cidade),
										  						Estado = VALUES(Estado),
										  						Bairro = VALUES(Bairro),
										  						CEP = VALUES(CEP),
										  						Logradouro = VALUES(Logradouro),
										  						Numero_endereco = VALUES(Numero_endereco), 
										  						Status = VALUES(Status),
										  						Data_Nascimento = VALUES(Data_Nascimento),
										  						Complemento = VALUES(Complemento),
										  						Senha = VALUES(Senha),
										  						Sexo = VALUES(Sexo),
										  						Nivel_Usuario = VALUES(Nivel_Usuario)");
			$stmt->bind_param('ssssssssssssssss',$matricula, $nome, $email, $cpf, $cidade, $estado, $bairro, $cep, $logradouro, $numero, $status, $datanascimento, $complemento, $senha, $sexo, $nivel);

			$stmt2 = $obj_mysqli->prepare("INSERT INTO `telefone`(`Numero`,`Tipo`,`Matricula_pessoa`,`Numero_celular`) VALUES(?,?,?,?)
											ON DUPLICATE KEY UPDATE Numero = VALUES(Numero),
											Tipo = VALUES(Tipo),
											Matricula_pessoa = VALUES(Matricula_pessoa),
											Numero_celular = VALUES(Numero_celular)");
			$stmt2->bind_param('ssss',$telefone, $tipo, $matricula, $celular);

			$stmt3 = $obj_mysqli->prepare("INSERT INTO `funcionario`(`cargo`,`Matricula_pessoa`)VALUES(?,?)
											ON DUPLICATE KEY UPDATE cargo = VALUES(cargo),
											Matricula_pessoa = VALUES(Matricula_pessoa)");
			$stmt3 ->bind_param('ss',$cargo,$matricula);

		
			if(!$stmt->execute())
			{
				$erro = $stmt->error;
				echo $erro;
			}			
			if(!$stmt2->execute())
			{
				$erro = $stmt2->error;
				echo $erro;

			}
			if(!$stmt3->execute())
			{
				$erro = $stmt3->error;
				echo $erro;

			}
			//if(!$stmt4->execute())
			//{
			//	$erro = $stmt4->error;
			//	echo $erro;

			//}
			else
			{
				echo '<script language="javascript">';
				echo 'alert("Cadastro feito com sucesso!")';
				echo '</script>';
				//header('Location:register.php');
				header("Refresh: 2, funcionario.php");
				exit;
			}


?>