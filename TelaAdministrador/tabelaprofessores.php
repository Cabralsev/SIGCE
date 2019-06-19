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
            <li class="breadcrumb-item active">Professores</li>
          </ol>
          
           <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Professores</div>
              <div class="card-body">
              <div class="table-responsive">
               <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm">Matrícula</th>
                      <th class="th-sm">Nome do Professor</th>
                      <th class="th-sm">CPF </th>
                      <th class="th-sm">Status</th>
                      <th class="th-sm">Data de Nascimento</th>
                      <th class="th-sm">Email</th>
                      <th class="th-sm">Especialização</th>
                      <th class="th-sm">Instituição de Formação</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Matrícula</th>
                      <th>Nome do Professor</th>
                      <th>CPF</th>
                      <th>Status</th>
                      <th>Data de Nascimento</th>
                      <th>Email</th>
                      <th>Especialização</th>
                      <th>Instituição de Formação</th>
                    </tr>
                  </tfoot>
                  <tbody>
              <?php require_once("listarprofessores.php");?> 
                  </tbody>
                </table>
          </div>
        </div>
        <a style="padding: 20px" href="pdfprofessores.php">Gerar PDF<img src="icone/pdf.png"></a>
        </div>   
<?php
require_once("footer.php"); 
?>