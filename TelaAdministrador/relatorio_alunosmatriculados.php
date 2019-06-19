<?php
 include 'conexao1.php';
?>

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-chart-bar"></i>Taxa de Alunos Matriculados por Desistentes<br>
        <form method="POST">
        <div id="ano1">
          <label>Ano:</label>
          <select id="ano" name="ano">
        <script>
               function retornarAnos(data){
                var ano = "";
                $.each(data, function(chave,valor){ 
                  ano+= '<option id="ano" name="ano" value="'+valor.ano +'">'+valor.ano+'</option>';    
                });
                
                $('#ano').html(ano);
              }
            </script>
          </select>
          </div>
          <button class="btn btn-danger" type="submit">Atualizar</button>
        </form>          
      </div>

 <div class="row">
  <div class="col-sm-6 mb-3 mb-md-0">
    <div class="card">
      <div class="card-body">


<?php
$id = NULL;
$id = $_POST["ano"];

$valor3 = array();
$valor3[1] = 0;
$valor3[2] = 0;
$valor3[3] = 0;
$valor3[4] = 0;
$valor3[5] = 0;
$valor3[6] = 0;
$valor3[7] = 0;
$valor3[8] = 0;
$valor3[9] = 0;
$valor3[10] = 0;
$valor3[11] = 0;
$valor3[12] = 0;

$valor4 = array();
$valor4[1] = 0;
$valor4[2] = 0;
$valor4[3] = 0;
$valor4[4] = 0;
$valor4[5] = 0;
$valor4[6] = 0;
$valor4[7] = 0;
$valor4[8] = 0;
$valor4[9] = 0;
$valor4[10] = 0;
$valor4[11] = 0;
$valor4[12] = 0;

//$q = '2018';
//echo $q;
$sql_alunosmatriculados = "SELECT COUNT(*) qtd,
MONTH(data_matricula) mes, 
YEAR(data_matricula) ano
FROM aluno
INNER JOIN pessoa
ON aluno.Matricula_pessoa = pessoa.Matricula
WHERE YEAR(data_matricula) = '".$id."'
GROUP BY MONTH(data_matricula), YEAR(data_matricula)
ORDER BY MONTH(data_matricula), YEAR(data_matricula)";

$resultado3 = mysqli_query($conn, $sql_alunosmatriculados);

while ($row3 = mysqli_fetch_object($resultado3)){

  $valor3[$row3->mes] = $row3->qtd;
  
}

$sql_alunosdesistentes = "SELECT COUNT(*) qtd,
MONTH(data_desistencia) mes, 
YEAR(data_desistencia) ano
FROM aluno
WHERE YEAR(data_desistencia) = '".$id."'
GROUP BY MONTH(data_desistencia), YEAR(data_desistencia)
ORDER BY MONTH(data_desistencia), YEAR(data_desistencia)";

$resultado4 = mysqli_query($conn, $sql_alunosdesistentes);

while ($row4 = mysqli_fetch_object($resultado4)) {

  $valor4[$row4->mes] = $row4->qtd;

}

/*     
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>';
  */
 echo '<canvas id="teste1"></canvas>'; 

 echo '<script>';

 echo 'new Chart(document.getElementById("teste1"), {';
 echo "type: 'bar',";
 echo 'data: {';
 echo 'labels: ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],';
 echo 'datasets: [';
 echo ' { ';
 echo 'label: "Alunos Matriculados em '.$id.'",';
 echo 'backgroundColor: "#3e95cd",';

 echo "data: [".$valor3[1].",".$valor3[2].",".$valor3[3].",".$valor3[4].",".$valor3[5].",".$valor3[6].",".$valor3[7].",".$valor3[8].",".$valor3[9].",".$valor3[10].",".$valor3[11].",".$valor3[12]."]"; 


 echo '}, {';
 echo 'label: "Alunos Desistentes em '.$id.'",';
 echo 'backgroundColor: "#f44336",';

 echo "data: [".$valor4[1].",".$valor4[2].",".$valor4[3].",".$valor4[4].",".$valor4[5].",".$valor4[6].",".$valor4[7].",".$valor4[8].",".$valor4[9].",".$valor4[10].",".$valor4[11].",".$valor4[12]."]";

 echo'}';
 echo']';
 echo'},';
 echo 'options: {';
 echo 'title: {';
 echo 'display: true,';
 echo 'text: "Taxa de novos alunos por alunos desistentes"';
 echo '}';
 echo '}';
 echo ' });';

 echo '</script>';
?> 

  </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <?php  

$valor = array();
$valor[1] = 0;
$valor[2] = 0;
$valor[3] = 0;
$valor[4] = 0;
$valor[5] = 0;
$valor[6] = 0;
$valor[7] = 0;
$valor[8] = 0;
$valor[9] = 0;
$valor[10] = 0;
$valor[11] = 0;
$valor[12] = 0;

$valor2 = array();
$valor2[1] = 0;
$valor2[2] = 0;
$valor2[3] = 0;
$valor2[4] = 0;
$valor2[5] = 0;
$valor2[6] = 0;
$valor2[7] = 0;
$valor2[8] = 0;
$valor2[9] = 0;
$valor2[10] = 0;
$valor2[11] = 0;
$valor2[12] = 0;

//$q = '2018';
//echo $q;
$alunosmatriculados = "SELECT COUNT(*) qtd,
MONTH(data_matricula) mes, 
YEAR(data_matricula) ano
FROM aluno
INNER JOIN pessoa
ON aluno.Matricula_pessoa = pessoa.Matricula
WHERE YEAR(data_matricula) = '".date("Y")."'
GROUP BY MONTH(data_matricula), YEAR(data_matricula)
ORDER BY MONTH(data_matricula), YEAR(data_matricula)";

$resultado = mysqli_query($conn, $alunosmatriculados);

while ($row = mysqli_fetch_object($resultado)){

  $valor[$row->mes] = $row->qtd;
  
}

$alunosdesistentes = "SELECT COUNT(*) qtd,
MONTH(data_desistencia) mes, 
YEAR(data_desistencia) ano
FROM aluno
WHERE YEAR(data_desistencia) = '".date("Y")."'
GROUP BY MONTH(data_desistencia), YEAR(data_desistencia)
ORDER BY MONTH(data_desistencia), YEAR(data_desistencia)";

$resultado2 = mysqli_query($conn, $alunosdesistentes);

while ($row2 = mysqli_fetch_object($resultado2)) {

  $valor2[$row2->mes] = $row2->qtd;

}

/*     
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>';
  */
 echo '<canvas id="teste" width="500" height="250"></canvas>'; 

 echo '<script>';

 echo 'new Chart(document.getElementById("teste"), {';
 echo "type: 'bar',";
 echo 'data: {';
 echo 'labels: ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],';
 echo 'datasets: [';
 echo ' { ';
 echo 'label: "Alunos Matriculados no ano atual",';
 echo 'backgroundColor: "#3e95cd",';

 echo "data: [".$valor[1].",".$valor[2].",".$valor[3].",".$valor[4].",".$valor[5].",".$valor[6].",".$valor[7].",".$valor[8].",".$valor[9].",".$valor[10].",".$valor[11].",".$valor[12]."]"; 


 echo '}, {';
 echo 'label: "Alunos Desistentes no ano atual",';
 echo 'backgroundColor: "#f44336",';

 echo "data: [".$valor2[1].",".$valor2[2].",".$valor2[3].",".$valor2[4].",".$valor2[5].",".$valor2[6].",".$valor2[7].",".$valor2[8].",".$valor2[9].",".$valor2[10].",".$valor2[11].",".$valor2[12]."]";

 echo'}';
 echo']';
 echo'},';
 echo 'options: {';
 echo 'title: {';
 echo 'display: true,';
 echo 'text: "Taxa de novos alunos por alunos desistentes"';
 echo '}';
 echo '}';
 echo ' });';

 echo '</script>';

?>
      </div>
    </div>
  </div>
</div>
</div>
