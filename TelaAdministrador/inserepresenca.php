<?php 

include ("conexao1.php");

$data = $_POST['data'];
$codigo = $_POST['codigo'];
$idAluno = $_POST['idAluno'];

foreach($_POST['Frequencia'] as $idAluno => $Frequencia){

    $result_situacao_itens = "INSERT INTO presenca (idTurma, Matricula, Data, Frequencia) VALUES ('$codigo', '$idAluno', '$data' , '$Frequencia')";
    $resultado_situacao_itens = mysqli_query($conn, $result_situacao_itens);

}
  echo '<script language="javascript">';
  echo 'alert("Cadastros efetuados com sucesso!")';
  echo '</script>';
  header("Refresh: 1, index.php");
?>


