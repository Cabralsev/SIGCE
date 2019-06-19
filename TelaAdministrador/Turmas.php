<?php include("session.php");?>
<?php 
require_once("header.php");
require_once ("navbar.php");
require_once("sidebar.php");
include ("conexao1.php");
?>

<style type="text/css">
      .carregando{
        color:#ff0000;
        display:none;
      }
    </style>
<script src="limparcampos.js"></script>

<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Cadastro de Turma</li>
    </ol>
    


    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Dados Gerais</li>
    </ol>
    <div class="container-fluid">
      <form method="POST" action="cadastroturma.php" style="display: table-cell";>
        <div class="row">
          <label style="top:13px;" class="label-control col-md-1 col-sm-1" for="codigoturma"><b>Código:</b></label>
          <div class="col-sm-2 col-md-2">
            <input style="width: 100px;" id="codigoturma" type="text" maxlength="5" class="form-control" placeholder="Código" name="codigoturma" required><br>
          </div>

          <SCRIPT>
               /* Executa a requisição quando o campo CEP perder o foco */
               $('#codigoturma').blur(function(){
                 /* Configura a requisição AJAX */
                 $.ajax({
                  url : 'consultar_codigoturma.php',/* URL que será chamada */ 
                  type : 'POST', /* Tipo da requisição */ 
                  data: 'codigoturma=' + $('#codigoturma').val(), /* dado que será enviado via POST */
                  dataType: 'json', /* Tipo de transmissão */
                  
                  success: function(data){
                    limparcamposturma();
                    //$('#codigoturma').val(data.Codigo);
                    $('#professor').val(data.Matricula);
                    $('#curso').val(data.idCurso);
                    $('#turma').val(data.idNome);
                    $('#nivel').val(data.nivel);
                    $('#escolaridaderecomendada').val(data.Escolaridade_Recomendada);
                    $('#periodoletivo').val(data.Periodo_Letivo);
                    $('#datainicio').val(data.Data_Inicio);
                    $('#datafim').val(data.Data_Fim);
                    $('#horarioinicio').val(data.Horarioinicio);
                    $('#horariofinal').val(data.Horariofinal);
                    $('#turno').val(data.Turno);
                    $('#status').val(data.Status);   
                    
                  }
                });   
                 return false;    
               });
          </SCRIPT>

          <label for="professor" style="padding-top: 10px" class="page1 control-label col-sm-2 col-md-2"><b>Professor:</b></label>
          <div style="padding-top: 10px">
            <select style="width: 160px" class="form-control" id="professor" name="professor">

              <script>
               function retornarprofessores(data){
                var professor = "";
                $.each(data, function(chave,valor){
                  professor+= '<option value="' + valor.Matricula + '" >'+valor.Nome_Completo+'</option>';
                });
                
                $('#professor').html(professor);
              }
            </script>

          </select><br>
        </div>
      </div>
      <div class="row">
        <label for="curso" style="padding-right: 60px" class="page1 control-label col-sm-1 col-md-1"><b>Curso:</b></label>
          <select style="width: 150px" class="browser-default custom-select" name="curso" id="curso">
        <option value=""></option>
        <?php
          $result_cat_post = "SELECT idCurso , Tipo FROM curso ORDER BY Tipo";
          $resultado_cat_post = mysqli_query($conn, $result_cat_post);
          while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post) ) {
            echo '<option value="'.$row_cat_post['idCurso'].'">'.$row_cat_post['Tipo'].'</option>';
          }
        ?>
      </select><br><br>

        <label style="padding-right: 60px" for="turma" class="page1 control-label col-sm-1 col-md-1"><b>Turma:</b></label>
        <select style="width: 150px" class="form-control" id="turma" name="turma">
          <option value="" selected></option>
          <script>
               function retornarTurmas(data){
                var Turma = "";
                $.each(data, function(chave,valor){
                  Turma+= '<option value="' + valor.idNome + '" >'+valor.nome_turma+'</option>';
                });
                
                $('#turma').html(Turma);
              }
            </script>
        </select>

        <label for="nivel" class="page1 control-label col-sm-1 col-md-1"><b>Nível:</b></label>
          <select id="nivel" style="width: 60px" class="form-control" name="nivel">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option>
            <option>8</option>
            <option>9</option>
            <option>10</option>
            <option>11</option>
          </select><br>

      </div>

      <label for="escolaridaderecomendada"><b>Escolaridade Recomendada:</b></label>

      <select class="browser-default custom-select" style="width: 200px" id="escolaridaderecomendada" name="escolaridaderecomendada">  
        <option name="Educação infantil" id="Educação infantil">Educação infantil</option>
        <option name="Ensino fundamental" id="Ensino fundamental">Ensino fundamental</option>
        <option name="Ensino médio" id="Ensino médio">Ensino médio</option>
        <option name="Ensino superior" id="Ensino superior">Ensino superior</option>
      </select> 
      

      <label for="periodoletivo"><b>Período Letivo:</b></label>
      <input type="text" maxlength="6" style="width:100px" class="form-control" placeholder="Ex:2018.1" id="periodoletivo" name="periodoletivo" required><br>
      <script type="text/javascript">
        $("#periodoletivo").mask("0000.0");
      </script>

      <label for= "datainicio" style="margin-bottom: 1.5rem"><b>Data de Início das Aulas:</b></label>
      <input type="date" id="datainicio" name="datainicio" style= "width:180px ">
      <label for= "datafim"><b>Data de Fim das Aulas:</b></label>
      <input type="date" id="datafim" name="datafim" style= "width:180px "><br>
      <div class="row">
        <label class="label-control col-sm-3 col-md-3" for="horarioinicio" style="font-style: italic"><b>Horário de início:</b></label>
        <div class="col-md-2 col-sm-2">
          <input type="time" style="width: 100px; margin-bottom: 0.5rem" id="horarioinicio" maxlength="5" class="form-control" name="horarioinicio" required>
        </div>
        
        <label class="label-control col-sm-3 col-md-3" for="horariofinal" style="font-style: italic"><b>Horário final:</b></label>
        <div class="col-md-2 col-sm-2">
          <input type="time" style="width: 100px; margin-bottom: 1rem" id="horariofinal" maxlength="5" class="form-control" name="horariofinal" required>
        </div>
      </div>
      
      <label for="turno"><b>Turno:</b></label>
      <select class="browser-default custom-select" style="width: 100px" name ="turno" id="turno">
        <option name ="turno" value="Manhã">Manhã</option>
        <option name ="turno" value="Tarde">Tarde</option>
        <option name ="turno" value="Noite">Noite</option>
      </select>

      <label for="Status"><b>Status</b></label>
      <input type="text" class="form-control" value="Ativo" style="width: 100px" name="status" id="status" readonly><br>  
      
      <button class="btn btn-primary" type="submit" id="submit">Salvar Dados</button>
    </form>

    <button class="btn btn-warning" onclick="return alert('Atenção Sr(a) Administrador \n\nInativando a turma, o status passará a ser inativo e alunos não poderão ser matriculados nessa turma.');" data-toggle="modal" data-target="#Inativar">Alterar Status da Turma</button>
    <button class="btn btn-danger"  data-toggle="modal" data-target="#Excluir">Excluir Turma</button>

    <div class="modal fade" id="Inativar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form action="alterarstatusturma.php" method="post">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alterando Status da Turma</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="Codigoturma"><b>Código da Turma:</b></label>
              <input style="width: 120px" type="text" id="codigoturmamodal" name="codigoturmamodal" required/><br>
              <label for="statusmodal"><b>Status da Turma:</b></label>
              <input style="width: 100px" type="text" class="form-control" name="statusmodal" id="statusmodal" readonly>
            </div>
            <script>
                  /* Executa a requisição quando o campo CEP perder o foco */
                  $('#codigoturmamodal').blur(function(){
                    /* Configura a requisição AJAX */
                    $.ajax({
                      url : 'consultar_statusturma.php',/* URL que será chamada */ 
                      type : 'POST', /* Tipo da requisição */ 
                      data: 'codigoturmamodal=' + $('#codigoturmamodal').val(), /* dado que será enviado via POST */
                      dataType: 'json', /* Tipo de transmissão */
                      
                      success: function(data){
                        limparcampos();
                        $('#statusmodal').val(data.Status);
                      }
                    });   
                    return false;    
                  });
            </script>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Alterar Status</button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <div class="modal fade" id="Excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form action="excluirturma.php" method="post">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Excluindo Turma</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="curso"><b>Código da Turma:</b></label>
              <input style="width: 120px" type="text" list="excluir" name="excluir" required/>
              <datalist id="excluir"></datalist><br>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              <button onclick="return confirm('Atenção Sr(a) Administrador \n\n Excluindo a turma, todos os dados dessa turma serão deletados do banco de dados, alunos não poderão ser matriculados nessa turma e alunos já matriculados nessa turma serão removidos. \n\n Confirma?');" type="submit" class="btn btn-danger">Excluir</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  
</div>

<!-- Sticky Footer -->

<script>

 
  $.ajax({
    type:"GET",
    url: "retornar_turmasdatalist.php",
    async:false
  }).done(function(data){
    var turma = "";
    $.each($.parseJSON(data), function(chave,valor){
      turma += '<option value ="' + valor.Codigo_Turma + '"> Turma: '+ valor.nome_turma +' /Nivel: '+ valor.nivel + '/Status: ' + valor.Status_Turma +'</option>';

    });
    $('#excluir').html(turma);
  });

  
</script>


<script src= "retornar_professores.php?callback=retornarprofessores"></script>
<script src="retornar_nometurmas.php?callback=retornarTurmas"></script>
<?php
require_once("footer.php"); 

?>
