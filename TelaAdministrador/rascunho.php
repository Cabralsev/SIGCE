<div class="card mb-3">
      <div class="card-header">
        <form method="GET">
        <i class="fas fa-chart-bar"></i>Taxa de Alunos Matriculados por Desistentes<br>
        <div id="ano">
          <label>Ano:</label>
        <script>
               function retornarAnos(data){
                var ano = "";
                $.each(data, function(chave,valor){
                  ano+= '<div class="custom-control custom-checkbox custom-control-inline">';
                  ano+= '<input type="checkbox" onclick="mostragrafico(this.value)" style="margin-top:5px" value="'+valor.ano +'">';
                  ano+= '<label for="'+valor.ano +'">'+valor.ano+'</label>';
                  ano+= '</div>';

                });
                
                $('#ano').html(ano);
              }
            </script>
          </div>
          <button class="btn btn-danger" type="submit">Atualizar</button>
      </div>
    </form>
    <div class="card-body">
---------------------------------------------------------------
       <script type="text/javascript">
    $(function(){
      $('#curso').change(function(){
        if( $(this).val() ) {
          $('#turma').hide();
          $('.carregando').show();
          $.getJSON('retornar_nometurmas1.php?search=',{curso: $(this).val(), ajax: 'true'}, function(j){
            var options = '<option value="">Escolha Turma</option>'; 
            for (var i = 0; i < j.length; i++) {
              options += '<option value="' + j[i].idNome + '">' + j[i].nome_turma + '</option>';
            } 
            $('#turma').html(options).show();
            $('.carregando').hide();
          });
        } else {
          $('#turma').html('<option value="">– Escolha Turma –</option>');
        }
      });
    });
    </script>

    --------------------------------------------

    <script>

function mostrargrafico(str) {
    var xhttp;
  if (str.length == 0) { 
    document.getElementById("card-body").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("card-body").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "relatorio_alunosmatriculados.php?q="+str,true);
  xhttp.send();   
}

</script>
------------------------------------------
 echo 'var ctx = $("#teste").get(0).getContext("2d")';
 echo 'var myBarChart = new Chart(ctx, {';
 echo 'type: "bar",';
 echo 'data: data,});';
 echo '$(''button#button'').click(function() {';
 echo 'var newDataset = {';
 echo 'label: "Vendas",';
 echo 'backgroundColor: ''rgba(99, 255, 132, 0.2)'',';
 echo 'borderColor: ''rgba(99, 255, 132, 1)'',';
 echo 'borderWidth: 1,';
 echo 'data: [10, 20, 30, 40, 50, 60, 70],'
 echo '}';
 echo 'data.datasets.push(newDataset)';
 echo 'myBarChart.update()';
 echo '});';
 --------------------------------------------

 <?php

$i = 0;

$j = 0;

$valor3 = array();

$valor4 = array(); 

$label = array();

$label2= array();

$alunosaprovados = "SELECT COUNT(*) qtd,
turma.Periodo_Letivo
FROM turma 
INNER JOIN atividade
ON turma.Codigo = atividade.Turma_idTurma
WHERE atividade.Situacao = 'Aprovado'
GROUP BY turma.Periodo_Letivo
ORDER BY turma.Periodo_Letivo";

$resultado3= mysqli_query($conn , $alunosaprovados);

while ($row3 = mysqli_fetch_object($resultado3)) {
  
  $label[$i] = $row3->Periodo_Letivo;
  $valor3[$i] = $row3->qtd;
  $i = $i + 1;
}

$alunosreprovados = "SELECT COUNT(*) qtd,
turma.Periodo_Letivo
FROM turma 
INNER JOIN atividade
ON turma.Codigo = atividade.Turma_idTurma
WHERE atividade.Situacao = 'Reprovado'
GROUP BY turma.Periodo_Letivo
ORDER BY turma.Periodo_Letivo";

$resultado4= mysqli_query($conn, $alunosreprovados);

while ($row4 = mysqli_fetch_object($resultado4)) {
  
  $label2[$j] = $row4->Periodo_Letivo;
  $valor4[$j] = $row4->qtd;
  $j = $j + 1;

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
            data: <?php echo json_encode($valor3); ?>,
            label: "Alunos Aprovados",
            borderColor: "#3e95cd",
            fill: false
          }, { 
            data: <?php echo json_encode($valor4); ?>,
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
