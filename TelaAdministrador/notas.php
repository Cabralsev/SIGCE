<?php include("session.php");?>
<?php 

require_once("header.php");
require_once ("navbar.php");
require_once("sidebar.php");

?>
<script src="limparcampos.js"></script>
<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Lançamento de Notas</li>
    </ol>

  <form method="POST" action="finalizaturma.php">
    <label for="Codigo_Turma" style="padding: 10px"><b>Código da Turma:</b></label>

    <input minlength="5" maxlength="5" style="width: 120px" onchange="mostrarturmas(this.value)" id="retornaprofessor" type="text" list="hosting-plan" placeholder="Turmas" name="hosting-plan" required>

    <button class="btn btn-danger" onclick="return confirm('Atenção Sr(a) Administrador \n\nFinalizando a turma, seu status se tornará inativo, não será possível adicionar alunos ou alterar notas dos mesmos já matriculados.\n\nConfirma?');" type="submit" id="submit">Finalizar Turma</button>

    <datalist id="hosting-plan"></datalist><br>
  </form>

    <div class="card mb-3">
      <div class="card-header">

        <script>
          function mostrarturmas(str) {
            if (str == "") {
              document.getElementById("txtHint1").innerHTML = "";
              return;
            } else { 
              if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("txtHint1").innerHTML = this.responseText;
            }
          };
          xmlhttp.open("GET","retornar_turmaaluno.php?q="+str,true);
          xmlhttp.send();
        }

        $(document).ready(function() {
         /* Executa a requisição quando o campo CEP perder o foco */
         $('#retornaprofessor').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
            url : 'retornar_professorperiodo.php', /* URL que será chamada */ 
            type : 'POST', /* Tipo da requisição */ 
            data: 'retornaprofessor=' + $('#retornaprofessor').val(), /* dado que será enviado via POST */
            dataType: 'json', /* Tipo de transmissão */
            success: function(data){
              limparcamposnotas();
              $('#professor').val(data.Nome_Completo);
              $('#periodoletivo').val(data.Periodo_Letivo);
              $('#nome_turma').val(data.nome_turma);
              $('#curso').val(data.Tipo);
            }
          });   
           return false;    
         })
       })

      }
    </script>
    
    <div class="container-fluid">
      <label for="professor">Professor</label>
      <input type="text" class="form-control" style="width: 300px" name="professor" id="professor" readonly>

      <label for="periodoletivo">Período Letivo</label>
      <input type="text" class="form-control" style="width: 100px" name="periodoletivo" id="periodoletivo" readonly>

      <label for="turma">Nome da Turma</label>
      <input type="text" class="form-control" style="width: 140px" name="nome_turma" id="nome_turma" readonly>

      <label for="curso">Curso</label>
      <input type="text" class="form-control" style="width: 140px" name="curso" id="curso" readonly>
    </div>

    <div id="txtHint1"></div>
    
    <script>


      $.ajax({
        type:"GET",
        url: "retornar_turmasdatalistativas.php",
        async:false
      }).done(function(data){
        var turma = "";
        $.each($.parseJSON(data), function(chave,valor){
          turma += '<option name = "codigo" value ="' + valor.Codigo_Turma + '"> Turma: '+ valor.nome_turma +' /Nivel: '+ valor.nivel +'</option>';

        });
        $('#hosting-plan').html(turma);
      });
      
    </script>

<!--MODAIS -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel" style="padding-right: 90px">Notas</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="inserenotas.php" enctype="multipart/form-data">
              <div class="container">
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Nome do Aluno:</label><br>
                  <input name="nome" type="text" class="form-control" id="recipient-name" readonly><br>
                  <label for="Turma" class="control-label">Turma:</label>
                  <input name="turma" class="form-control" id="turma" readonly>
                  <label style="padding-top: 15px" for="Matricula" class="control-label">Matricula:</label>
                  <input name="matricula" class="form-control" id="matricula" readonly>
                </div>
                <div class="row" style="padding: 10px">
                  <label style="padding: 5px" for="Prova1" class="control-label">Prova 1: </label>
                  <input type= "text" name="Prova1" id="Prova1" onfocus="somarValores()" maxlength="6"  class="form-control" style="width: 80px">
                  <label style="padding: 5px" for="Prova2" class="control-label">Prova 2: </label>
                  <input type="text" name="Prova2" id="Prova2" onblur="somarValores()" maxlength="6"  class="form-control" style="width: 80px">
                  <label style="padding: 5px" for="Prova3" class="control-label">Prova 3: </label>
                  <input type="text" name="Prova3" id="Prova3" maxlength="6" onblur="somarValores()" class="form-control" style="width: 80px">
                </div> 
                <div class="form-group">
                  <label for="Media">Média</label>
                  <input type="text" name="medianotas" id="medianotas" class="form-control" style="width: 80px" readonly>
                  <label>Caso o aluno esteja de recuperação, Prova 3 é necessário nota acima de 60!</label><br>

                  <label for="Situação">Situação</label>
                  <input type="text" name="situacao" id="situacao" class="form-control" readonly>
                </div>
              </div>
              <button type="submit" class="btn btn-success">Alterar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </form>
          </div> 
        </div>
      </div>
    </div>

    <div class="modal fade" id="ExcluiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel" style="padding-right: 90px"></h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="excluiraluno.php" enctype="multipart/form-data">
              <div class="container">
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Nome do Aluno:</label><br>
                  <input name="nome" type="text" class="form-control" id="recipient-name" readonly><br>
                  <label for="Matricula" class="control-label">Matricula:</label>
                  <input name="matricula" class="form-control" id="matricula" readonly>
                  <label style="padding-top: 20px" for="Turma" class="control-label">Turma:</label>
                  <input name="turma" class="form-control" id="turma" readonly>
                </div>
              </div>
              <button onclick="return confirm('Atenção Administrador!! \n\nExcluindo o aluno, todo o histórico de notas desse aluno nesta turma será apagado, o registro de matrícula desse aluno nessa turma também será apagado. \n\nConfirma?');" type="submit" class="btn btn-danger">Excluir</button>
              <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </form>
          </div> 
        </div>
      </div>
    </div>

  </div>                    
</div>
<script>
  function somarValores(){
    var s1 = parseInt(document.getElementById('Prova1').value);
    var s2 = parseInt(document.getElementById('Prova2').value);
    var s3 = parseInt(document.getElementById('Prova3').value); 
    var maiornota = 0;  

    document.getElementById('medianotas').value = (s1 + s2)/2;

    if (document.getElementById('medianotas').value >= 60) { 
      document.getElementById('situacao').value = 'Aprovado';
      document.getElementById("Prova3").disabled = true;
    }
    if (document.getElementById('medianotas').value < 60) { 
      document.getElementById("Prova3").disabled = false;    
      if (s1 >= s2) {
        maiornota = s1;
      }
      else{
        maiornota = s2;
      }

      if (document.getElementById('Prova3').value >= 60) {
        document.getElementById('medianotas').value = (maiornota + s3)/2;
      }

      if (document.getElementById('medianotas').value >= 60) {
        document.getElementById('situacao').value = 'Aprovado';
      }
      else{

        document.getElementById('situacao').value = 'Reprovado';
      }

    }

  }

</script>

<script type="text/javascript">
  $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipientnome = button.data('nome') // Extract info from data-* attributes
      var recipientmatricula = button.data('matricula')
      var recipientturma = button.data('turma')
      var recipientprova1 = button.data('prova1')
      var recipientprova2 = button.data('prova2')
      var recipientprova3 = button.data('prova3')
      
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('Atualizar nota de ' + recipientnome)
      modal.find('#recipient-name').val(recipientnome)
      modal.find('#matricula').val(recipientmatricula)
      modal.find('#turma').val(recipientturma)
      modal.find('#Prova1').val(recipientprova1)
      modal.find('#Prova2').val(recipientprova2)
      modal.find('#Prova3').val(recipientprova3)

      
    })
  </script>

  <script type="text/javascript">
  $('#ExcluiModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipientnome = button.data('nome') // Extract info from data-* attributes
      var recipientmatricula = button.data('matricula')
      var recipientturma = button.data('turma')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('Excluir cadastro na turma do aluno: ' + recipientnome)
      modal.find('#recipient-name').val(recipientnome)
      modal.find('#matricula').val(recipientmatricula)
      modal.find('#turma').val(recipientturma)

      
    })
  </script>

  <?php
  require_once("footer.php"); 
  ?>
