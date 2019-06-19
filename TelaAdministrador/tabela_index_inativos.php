<?php 

$con = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"ajax_demo");

$sql ="SELECT COUNT(*) AS QTD, Motivo_saida FROM `aluno`
	   WHERE aluno.Motivo_saida <> ''
	   GROUP BY Motivo_saida";

$result_alunos = mysqli_query($con,$sql);
if (mysqli_num_rows($result_alunos) < 1) {
    echo "Sem registro de alunos inativos!";
}

else{

while($row = mysqli_fetch_array($result_alunos)) {
    
    echo"<tr>";   
    echo"<td>" .  $row['QTD']. "</td>";
    echo"<td>" .  $row['Motivo_saida']. "</td>";
    echo"</tr>";
}

}

?>