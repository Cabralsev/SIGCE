<?php 
  require_once("Tela/header.php");
  require_once ("Tela/navbar.php");
  require_once("Tela/sidebar.php");
  include("conexao1.php");

  
?>


      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Enturmar Aluno</li>
          </ol>

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Alunos</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Matricula</th>
                      <th>Nome Completo</th>
                      <th>Adicionar aluno</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Matricula</th>
                      <th>Nome Completo</th>
                      <th>Adicionar aluno</th>
                     
                    </tr>
                  </tfoot>
                  <tbody>
              <?php require_once("enturmaraluno.php");?>
                     </tbody>
                </table>
              </div>
            

            </div>           
          </div>

          </div>
    </div>    

        
<?php
require_once("Tela/footer.php"); 
?>