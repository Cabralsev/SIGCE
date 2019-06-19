<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-chart-bar"></i>
    Média de Turmas
    <br>
    <form method="GET">
      <label for="nometurma">Nome da Turma: </label>
      <select id="nometurma" name="nometurma">
        <script> 
         function retornarTurmas(data){
          var nometurma = "";
          $.each(data, function(chave,valor){
            nometurma+= '<option value="'+valor.idNome+'" >'+valor.nome_turma+'</option>';
          });
          
          $('#nometurma').html(nometurma);
        }
      </script>
    </select>
    <button class="btn btn-danger" type="submit">Atualizar</button>
  </form>
</div>
<div class="card-body">
    <canvas id="myChart"></canvas>
</div>
</div>

<?php 

include 'conexao1.php';

$idNomeTurma = $_GET["nometurma"];
//echo $idNomeTurma;
$j = 0;
$label = array();
$data = array();

$sql_turmas = "SELECT nome_turma FROM nome_turma WHERE idNome = '".$idNomeTurma."'";

$resultado_turmas = mysqli_query($conn, $sql_turmas);

$result = mysqli_fetch_object($resultado_turmas);

$nome = $result->nome_turma;

$sql_periodos = "SELECT DISTINCT turma.Periodo_Letivo 
FROM turma 
ORDER BY turma.Periodo_Letivo";

$result_periodos = mysqli_query($conn, $sql_periodos);

while ($row = mysqli_fetch_object($result_periodos)) {
  $label[$j] = $row->Periodo_Letivo;

  $procedure = "CALL MediaTurmas('".$idNomeTurma."', '".$label[$j]."')";

  $result_procedure = mysqli_query($conn, $procedure);
  $media = mysqli_fetch_object($result_procedure);
  $data[$j] = $media->resultado;

  $j = $j + 1;

  $result_procedure->close();
  $conn->next_result();
}

?>


<script>
    var chartColors = {
      color1: '#0df500',
      color2: '#f50000'
    };

    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo json_encode($label); ?>,
        datasets: [{
          label: 'Média da turma' , 
          backgroundColor: [
          chartColors.color1,
          chartColors.color2
          ]
          ,
          data: <?php echo json_encode($data); ?>
        }],
      }
    });

var colorChangeValue = 60; //set this to whatever is the deciding color change value
var dataset = myChart.data.datasets[0];
for (var i = 0; i < dataset.data.length; i++) {
  if (dataset.data[i] < 60) {
    dataset.backgroundColor[i] = chartColors.color2;
  }
  else{
   dataset.backgroundColor[i] = chartColors.color1;
 }
}
myChart.update();
</script>

