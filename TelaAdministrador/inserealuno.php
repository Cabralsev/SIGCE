<?php
require_once ("conexao.php");

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
$escolaridade= "";
$nomeresponsavel = "";
$cpfresponsavel = "";
$telefoneresponsavel = "";
$saida = "";
$nivel = "";
$datadesistencia = "";
$EstadoCivil = "";
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
		$escolaridade = $_POST["escolaridade"];
		$EstadoCivil = $_POST["estadocivil"];	
		//$nomeresponsavel = $_POST["nomeresponsavel"];
		//$cpfresponsavel = $_POST["cpfresponsavel"];
		//$telefoneresponsavel = $_POST["telefoneresponsavel"];

			
		if(empty($nomeresponsavel = $_POST['nomeresponsavel'])){
       		$nomeresponsavel = NULL;
		}
		if(empty($cpfresponsavel = $_POST['cpfresponsavel'])){
       		$cpfresponsavel = NULL;
		}
		if(empty($telefoneresponsavel = $_POST['telefoneresponsavel'])){
       		$telefoneresponsavel = NULL;
		}
		
		
		$datadesistencia = NULL;
		$saida = $_POST["saida"];
		$nivel = $_POST["nivel"];
		//$cargo = $_POST["cargo"];
/*
echo $matricula;
echo $nome;
echo $cpf;
echo $email;
echo $cidade;
echo $estado;
echo $cep;
echo $bairro;
echo $logradouro;
echo $complemento;
echo $numero;
echo $status;
echo $datanascimento;
echo $senha;
echo $telefone;
echo $tipo;
echo $sexo;
echo $celular;
echo $escolaridade;
echo $nomeresponsavel;
echo $cpfresponsavel;
echo $telefoneresponsavel;
echo $saida;
echo $nivel;
echo $datadesistencia;
die;
*/
					if ($status == 'Inativado') {

						echo '<script language="javascript">';
						echo 'alert("Aluno com status Inativo, ative-o caso queira atualizar seus dados!")';
						echo '</script>';
						header("Refresh: 1, aluno.php");
						exit;
					}
					else{

			$stmt = $obj_mysqli->prepare("INSERT INTO `pessoa`(`Matricula`,`Nome_Completo`,`Email`,`CPF`,`Cidade`,`Estado`,`Bairro`,`CEP`,`Logradouro`,`Numero_endereco`,`Status`,`Data_Nascimento`,`Complemento`,`Senha`,`Sexo`,`Nivel_Usuario`,`EstadoCivil`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,sha1(?),?,?,?)
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
										  						 Nivel_Usuario = VALUES(Nivel_Usuario),
										  						 EstadoCivil = VALUES(EstadoCivil)");

			$stmt->bind_param('sssssssssssssssss',$matricula, $nome, $email, $cpf, $cidade, $estado, $bairro, $cep, $logradouro, $numero, $status, $datanascimento, $complemento, $senha, $sexo, $nivel, $EstadoCivil);

			$stmt2 = $obj_mysqli->prepare("INSERT INTO `telefone`(`Numero`,`Tipo`,`Matricula_pessoa`,`Numero_celular`) VALUES(?,?,?,?) 
											ON DUPLICATE KEY UPDATE Numero = VALUES(Numero),
											Tipo = VALUES(Tipo),
											Matricula_pessoa = VALUES(Matricula_pessoa),
											Numero_celular = VALUES(Numero_celular)");
			$stmt2->bind_param('ssss',$telefone, $tipo, $matricula, $celular);

			$stmt3 = $obj_mysqli->prepare("INSERT INTO `aluno`(`nome_Responsavel`,`Escolaridade`,`CPF_Responsavel`,`Telefone_Responsavel`,`Motivo_saida`,`Matricula_pessoa`)VALUES(?,?,?,?,?,?)
											 ON DUPLICATE KEY UPDATE nome_Responsavel = VALUES(nome_Responsavel) ,
											 								 Escolaridade = VALUES(Escolaridade) ,
											 								 CPF_Responsavel = VALUES(CPF_Responsavel),
											 								 Telefone_Responsavel = VALUES(Telefone_Responsavel),
											 								 Motivo_saida = VALUES(Motivo_saida),
											 								 Matricula_pessoa = VALUES(Matricula_pessoa)");
			$stmt3 ->bind_param('ssssss',$nomeresponsavel,$escolaridade,$cpfresponsavel,$telefoneresponsavel,$saida,$matricula);

			//$stmt4 = $obj_mysqli->prepare("INSERT INTO `funcionario`(`cargo`,`Matricula_pessoa`)VALUES(?,?)");
			//$stmt4 -> bind_param('ss',$cargo,$matricula);
		
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
				header("Refresh: 2, aluno.php");
				exit;
			}

		}

?>