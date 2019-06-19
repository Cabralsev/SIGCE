<?php include("session.php");?>
<?php 
  require_once("header.php");
  require_once ("navbar.php");
  require_once("sidebar.php");
  include("conexao1.php");

  
?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript" src="tabelascript.js"></script> 

	       <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Presenças e Faltas</li>
          </ol>

          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Frequência</div>
              <div class="card-body">
              <div class="table-responsive">
               <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Código da Turma</th>
                      <th class="th-sm">Nome do Aluno</th>
                      <th class="th-sm">Matrícula</th>
                      <th class="th-sm">Data</th>
                      <th class="th-sm">Frequência</th>                     
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Código da Turma</th>
                      <th>Nome do Aluno</th>
                      <th>Matrícula</th>
                      <th>Data</th>
                      <th>Frequência</th>
                    </tr>
                  </tfoot>
                  <tbody>
              <?php require_once("listarpresencas.php");?> 
                  </tbody>
                </table>
          </div>
        </div>
        </div>   


<?php
require_once("footer.php"); 
?>