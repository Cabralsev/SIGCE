<?php
$obj_mysqli = new mysqli("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");


if ($obj_mysqli->connect_errno)
{
	echo "Ocorreu um erro na conexão com o banco de dados.";
	exit;
}
 
mysqli_set_charset($obj_mysqli, 'utf8');
?>