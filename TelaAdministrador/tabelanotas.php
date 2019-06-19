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
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Notas</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Histórico de Notas</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Matrícula</th>
                      <th class="th-sm">Nome do Aluno</th>
                      <th class="th-sm">Nome da Turma</th>
                      <th class="th-sm">Código Turma</th>
                      <th class="th-sm">Nota 1</th>
                      <th class="th-sm">Nota 2</th>
                      <th class="th-sm">Nota 3</th>
                      <th class="th-sm">Média</th>
                      <th class="th-sm">Situação</th>
                    </tr>
                  </thead>
                  <tfoot> 
                    <tr>
                      <th>Matrícula</th>
                      <th>Nome do Aluno</th>
                      <th>Nome da Turma</th>
                      <th>Código Turma</th>
                      <th>Nota 1</th>
                      <th>Nota 2</th>
                      <th>Nota 3</th>
                      <th>Média</th>
                      <th>Situação</th>
                    </tr>
                  </tfoot>
                  <tbody>
              <?php require_once("listarnotas.php");?>
                  </tbody>
                </table>
              </div>
            </div>
           
          </div>
          

<?php
require_once("footer.php"); 
?>