<?php

$i = 0;

$data_ap = array();

$data_rp = array();

$label = array();

$sql_periodos = "SELECT DISTINCT turma.Periodo_Letivo 
FROM turma 
ORDER BY turma.Periodo_Letivo";

$result_periodos = mysqli_query($conn , $sql_periodos);

while ($row = mysqli_fetch_object($result_periodos)) {
  $label[$i] = $row->Periodo_Letivo;

  $sql_alunosaprovados = "SELECT COUNT(*) qtd
  FROM turma 
  INNER JOIN atividade
  ON turma.Codigo = atividade.Turma_idTurma
  WHERE atividade.Situacao = 'Aprovado' AND turma.Periodo_letivo = '".$label[$i]."'";

  $sql_alunosreprovados = "SELECT COUNT(*) qtd
  FROM turma 
  INNER JOIN atividade
  ON turma.Codigo = atividade.Turma_idTurma
  WHERE atividade.Situacao = 'Reprovado' AND turma.Periodo_letivo = '".$label[$i]."'";

  $result_aprovados = mysqli_query($conn , $sql_alunosaprovados);
  $qtd_aprovados = mysqli_fetch_object($result_aprovados);
  $data_ap[$i] = $qtd_aprovados->qtd;

  $result_reprovados = mysqli_query($conn , $sql_alunosreprovados);
  $qtd_reprovados = mysqli_fetch_object($result_reprovados);
  $data_rp[$i] = $qtd_reprovados->qtd;

  $i = $i + 1;
}

?>
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-chart-bar"></i>
  Taxa de Alunos aprovados por reprovados</div>
  <div class="card-body">
    <canvas id="line-chart" width="800" height="450"></canvas>
    <script>
      new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
          labels: <?php echo json_encode($label); ?>,
          datasets: [{ 
            data: <?php echo json_encode($data_ap); ?>,
            label: "Alunos Aprovados",
            borderColor: "#3e95cd",
            fill: false
          }, { 
            data: <?php echo json_encode($data_rp); ?>,
            label: "Alunos Reprovados",
            borderColor: "#f44336",
            fill: false
          }
          ]
        },
        options: {
          title: {
            display: true,
            text: 'Relatorio de aprovações'
          }
        }
      });
    </script>
  </div>
</div>
