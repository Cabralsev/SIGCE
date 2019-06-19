<?php include("session.php");?>
<?php 
  require_once("header.php");
  require_once ("navbar.php");
  require_once("sidebar.php");
  include("conexao1.php");

  
?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script src="tabelascript.js"></script> 

      <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Turmas</li>
          </ol>

  <div class="modal fade" id="Enturmar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="inserealunoturma.php" method="post">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastrando aluno na turma</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <label for="Codigo_Turma"><b>Código da Turma:</b></label>
            <select id="turma" name="turma">
       <script>
      function retornar_turmasativas(data){
            var turma = "";
            $.each(data, function(chave,valor){
              turma+= '<option value="' + valor.Codigo + '" >'+valor.Codigo+'</option>';
            });
        
        $('#turma').html(turma);
          }
      </script>
        </select><br>
            <label><b>Matricula do Aluno:</b></label>
              <input class="form-control" style="width: 300px" type="text" list="idAluno" name="idAluno" />
              <datalist id="idAluno"></datalist><br>
            </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </div>
        </div>
      </div>
    </form>
    </div>
<!-- Fechou modal-->

          <!-- DataTable -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Turmas</div>
            <div class="card-body">
              <button class="btn btn-danger" style="margin-bottom: 30px" data-toggle="modal" data-target="#Enturmar">Enturmar Aluno</button>
              <div class="table-responsive">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Código Turma </th>
                      <th class="th-sm">Nome do Professor</th>
                      <th class="th-sm">Status</th>
                      <th class="th-sm">Período Letivo</th>
                      <th class="th-sm">Nível</th>
                      <th class="th-sm">Curso</th>
                      <th class="th-sm">Turno </th>
                      <th class="th-sm">Nome da Turma </th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Código Turma</th>
                      <th>Nome do Professor</th>
                      <th>Status</th>
                      <th>Período Letivo</th>
                      <th>Nível</th>
                      <th>Curso</th>
                      <th>Turno</th>
                      <th>Nome da Turma</th>
                    </tr>
                  </tfoot>
                  <tbody>
              <?php require_once("listarturmas.php");?>
                  </tbody>
                </table>
              </div>
            </div>
           <a style="padding: 20px" href="pdfturma.php">Gerar PDF<img src="icone/pdf.png"></a>
          </div>         

      <script src="retornar_turmasativas.php?callback=retornar_turmasativas"></script>      
<?php
require_once("footer.php"); 
?>

 <script>
      $.ajax({
              type:"GET",
              url: "retornar_alunos.php",
              async:false
            }).done(function(data){
              var turma = "";
              $.each($.parseJSON(data), function(chave,valor){
                turma += '<option value ="' + valor.Matricula + '"> Nome: '+ valor.Nome_completo +'</option>';

              });
              $('#idAluno').html(turma);
            });   
</script> 

