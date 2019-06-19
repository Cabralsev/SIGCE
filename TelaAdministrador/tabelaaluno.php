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
            <li class="breadcrumb-item active">Alunos</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Alunos</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="dtBasicExample" cellspacing="0" width="100%" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th class="th-sm">Nome do Aluno</th>
                      <th class="th-sm">CPF</th>
                      <th class="th-sm">Email</th>
                      <th class="th-sm">Matrícula</th>
                      <th class="th-sm">Status</th>
                      <th class="th-sm">Data de Nascimento</th>
                      <th class="th-sm">Escolaridade</th>
                      <th class="th-sm">Nome do Responsável</th>
                      <th class="th-sm">Data de Inativação</th>
                      <th class="th-sm">Motivo de Saída</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nome do Aluno</th>
                      <th>CPF</th>
                      <th>Email</th>
                      <th>Matrícula</th>
                      <th>Status</th>
                      <th>Data de Nascimento</th>
                      <th>Escolaridade</th>
                      <th>Nome do Responsável</th>
                      <th>Data de Inativação</th>
                      <th>Motivo de Saída</th>
                    </tr>
                  </tfoot>
                  <tbody>
              <?php require_once("listaralunos.php");?>    
                  </tbody>
                </table>
              </div>
            </div>
           <a style="padding: 20px" href="pdfaluno.php">Gerar PDF<img src="icone/pdf.png"></a>
          </div>

          </div>
        

        
<?php
require_once("footer.php"); 
?>