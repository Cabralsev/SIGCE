<?php include("session.php");
?>
<?php 
require_once("header.php");
require_once ("navbar.php");
require_once("sidebar.php");

?>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Lançamento de Presenças</li>
    </ol>

<?php 
$codigo = $_POST['codigopesquisaturma'];
$data = $_POST['datadeaula'];

$con = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$consulta = "SELECT Data_Inicio , Data_Fim FROM turma WHERE Codigo = $codigo";
$resultado_consulta = mysqli_query($con,$consulta);

while($row_consulta = mysqli_fetch_assoc($resultado_consulta)){

$dateStart = $row_consulta['Data_Inicio'];
$dateEnd = $row_consulta['Data_Fim'];

$dateRange = array();

    while($dateStart <= $dateEnd){
        $dateRange[] = $dateStart;//->format('Y-m-d');
        $diasemana_numero = date('w', strtotime($dateStart));
        $dateStart = date('Y-m-d', strtotime("+1 days",strtotime($dateStart)));
              
    }
}

if (in_array($data, $dateRange)) {

		$sql= "SELECT presenca.idTurma , presenca.Matricula , presenca.Data , presenca.Frequencia, pessoa.Nome_Completo
		FROM `presenca` 
		INNER JOIN aluno_matricula_turma ON presenca.Matricula = aluno_matricula_turma.idAluno
		AND presenca.idTurma = aluno_matricula_turma.id_Turma
		INNER JOIN pessoa ON aluno_matricula_turma.idAluno = pessoa.Matricula
		WHERE presenca.Data = '".$data."' AND presenca.idTurma = '".$codigo."'";

		$result = mysqli_query($con,$sql);

		if (mysqli_num_rows($result) < 1) {
		$sql2 = "SELECT aluno_matricula_turma.id_Turma , aluno_matricula_turma.idAluno, pessoa.Nome_Completo 
		FROM aluno_matricula_turma
		INNER JOIN pessoa ON aluno_matricula_turma.idAluno = pessoa.Matricula
		WHERE id_Turma = '".$codigo."'";

		$result2 = mysqli_query($con,$sql2);

		echo "<div class='alert alert-danger' role='alert'>Esta turma não possui presenças e/ou faltas cadastradas para a data '".date("d/m/Y",strtotime($data))."'<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

		echo "<form action='inserepresenca.php' method='POST'>";
		echo "<table id ='dtBasicExample' class= 'table table-striped table-bordered' cellspacing='0' width='100%'>
		<tr>
		<th>Código da Turma</th>
		<th>Matricula</th>
		<th>Nome do Aluno</th>
		<th>Data de Aula</th>
		<th>Presença</th>
		</tr>";

			while($row = mysqli_fetch_array($result2)){
			    $Frequencia = $row['idAluno'];
			    echo "<tr>";
			    echo "<td> <input type='hidden' name='codigo' value='".$codigo."'><p><b>".$codigo."</b></p></td>";

			    echo "<td><input type='hidden' value='". $row['idAluno'] ."' name ='idAluno'><p><b>". $row['idAluno'] ."</b></td>";

			    echo "<td> <p><b>". $row['Nome_Completo'] ."</b></p></td>";

			    echo "<td> <input value ='".$data."'  name='data' type ='hidden'><p><b>".date("d/m/Y",strtotime($data))."</b></p></td>";

			    echo "<td>" ."<input type='radio' name='Frequencia[$Frequencia]' value='Presente'>Presente";
			    echo "<input type='radio' name='Frequencia[$Frequencia]' value='Faltou'>Faltou"."</td>";
			    echo "</tr>";
			    
			}

			echo "</table>";
			echo "<input type='submit' class='btn btn-primary btn-block' value='Salvar'>";
			echo "</form>";

			}

			else{
			 echo "<div class='alert alert-success' role='alert'>Esta turma possui presenças e/ou faltas cadastradas para a data '".date("d/m/Y",strtotime($data))."'<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

			echo "<table id ='dtBasicExample' class= 'table table-striped table-bordered' cellspacing='0' width='100%'>
			<tr>
			<th>Código da Turma</th>
			<th>Matricula</th>
			<th>Data de Aula</th>
			<th>Nome do Aluno</th>
			<th>Presença</th>
			<th>Atualizar Presença</th>
			</tr>";

			while($row = mysqli_fetch_array($result)){
			    $Frequencia = $row['idAluno'];
			    echo "<tr>";
			    echo "<td>" . $row['idTurma'] . "</td>";
			    echo "<td>" . $row['Matricula'] . "</td>";
			    echo "<td>" . date("d/m/Y",strtotime($row['Data']))."</td>";    
			    echo "<td>" . $row['Nome_Completo'] . "</td>";
			    echo "<td>".$row['Frequencia']."</td>";
			    echo "<td>". "<button type='button' class='btn btn-sm btn-danger' data-toggle='modal'
			    data-target='#ModalAltera'
			    data-frequencia=".$row['Frequencia']." 
                data-matricula=".$row['Matricula']." 
                data-dataaula=".$row['Data']."
                data-turma=".$row['idTurma']."> Alterar </button> </td>";		    

		}
			echo "</table>";

		}

	}

	else{
		echo "<div class='alert alert-danger' role='alert'>A data '".date("d/m/Y",strtotime($data))."' está fora do período estipulado para esta turma! Contate a administração!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		echo "<p>Voltar a página<a href='index.php'> inicial.<a/></p>";
	}

?>
	<div class="modal fade" id="ModalAltera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel" style="padding-right: 90px"></h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="alterarpresenca.php" enctype="multipart/form-data">
              <div class="container">
                <div class="form-group">
                  <label for="recipientpresenca" class="control-label">Presença:</label><br>
                  <input name="frequencia" type="text" class="form-control" id="frequencia" readonly><br>
                  <label for="recipient-name" class="control-label">Data da aula:</label><br>
                  <input name="dataaula" type="date" class="form-control" id="dataaula" readonly><br>
                  <label for="Matricula" class="control-label">Matricula:</label>
                  <input name="matricula" class="form-control" id="matricula" readonly>
                  <label style="padding-top: 20px" for="Turma" class="control-label">Turma:</label>
                  <input name="turma" class="form-control" id="turma" readonly>
                </div>
              </div>
              <button type="submit" class="btn btn-danger">Alterar</button>
              <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </form>
          </div> 
        </div>
      </div>
    </div>

	<script>
  $('#ModalAltera').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipientfrequencia = button.data('frequencia')
      var recipientdataaula = button.data('dataaula') // Extract info from data-* attributes
      var recipientmatricula = button.data('matricula')
      var recipientturma = button.data('turma')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('Deseja alterar a presença do aluno?')
      modal.find('#frequencia').val(recipientfrequencia)
      modal.find('#dataaula').val(recipientdataaula)
      modal.find('#matricula').val(recipientmatricula)
      modal.find('#turma').val(recipientturma)

      
    })
  </script>

  </div>
</div>
<?php
  require_once("footer.php"); 
?>