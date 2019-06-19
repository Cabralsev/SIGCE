<?php 
if(isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["matricula"]) && isset($_POST["cpf"]) && isset($_POST["email"]) && isset($_POST["datanascimento"]) && isset($_POST["telefone"]) && isset($_POST["celular"]) && isset($_POST["cep"]) && isset($_POST["sexo"]) && isset($_POST["senha"]) && isset($_POST["numero"]))
{

	if(empty($_POST["nome"]))
		$erro = "Campo nome obrigatório";
	else
	if(empty($_POST["matricula"]))
		$erro = "Campo matricula obrigatório";
	else
	if(empty($_POST["cpf"]))
	$erro = "Campo CPF obrigatório";
	else
	
	if(empty($_POST["email"]))
	$erro = "Campo e-mail obrigatório";
	else
	
	if(empty($_POST["datanascimento"]))
	$erro = "Campo Data de Nascimento obrigatório";
	else
	
	if(empty($_POST["telefone"]))
		$erro = "Campo telefone obrigatório";
	else
	
	if(empty($_POST["celular"]))
		$erro = "Campo celular obrigatório";
	else
	
	if(empty($_POST["cep"]))
		$erro = "Campo CEP obrigatório";
	else
	
	if(empty($_POST["sexo"]))
		$erro = "Campo sexo obrigatório";
	else
	
	if(empty($_POST["senha"]))
		$erro = "Campo senha obrigatório";
	else
	
	if(empty($_POST["numero"]))
		$erro = "Campo numero obrigatório";
	else{
	
		echo "cadastro enviado";
	}

}

?>