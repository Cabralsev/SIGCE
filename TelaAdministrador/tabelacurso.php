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
            <li class="breadcrumb-item active">Cursos</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Cursos</div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Nome do Curso </th>
                      <th class="th-sm">Descricao </th>
                      <th class="th-sm">Turma Relacionada </th>
                    </tr>
                  </thead>
                  <tfoot> 
                    <tr>
                      <th>Nome do Curso</th>
                      <th>Descricao </th>
                      <th>Turma Relacionada</th>
                    </tr>
                  </tfoot>
                  <tbody>
              <?php require_once("listarcursos.php");?>
                  </tbody>
                </table>
              </div>
              <a style="padding: 20px" href="pdfcurso.php">Gerar PDF<img src="icone/pdf.png"></a>
            </div>
           
          </div>
          
        
 
<?php
require_once("footer.php"); 
?>