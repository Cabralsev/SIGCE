<?php include("session.php");?>
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
            <li class="breadcrumb-item active">Material de Apoio</li>
          </ol>
                   
        </div>       
       

    
    <form action="inserematerial.php" method="post" enctype="multipart/form-data" style="vertical-align: ">
<label for="Codigo_Turma" style="padding: 10px"><b>Código da Turma:</b></label>
      <input style="width: 120px" onchange="mostrarturmas(this.value)" type="text" list="hosting-plan" name="hosting-plan" />
    <datalist id="hosting-plan" onchange="mostrarturmas(this.value)"></datalist><br>

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
        xmlhttp.open("GET","retornar_materialdeapoio.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
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
     
      </div>        
      
        <div style="padding: 10px">
    <label for="descrição"><b>Descrição:</b></label>
      <input style="width: 330px" type="text" name="descricao" required>

    <label>Selecione o Arquivo:</label>
      <input type="file" name="arquivo" id="arquivo">

      <input type="submit" value="Cadastrar">
        </div>
</form>

           
    
    <div class="modal fade" id="ExcluiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel"></h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="excluirmaterial.php" enctype="multipart/form-data">
              <div class="container">
                <div class="form-group">
                  <input type="hidden" name="idmaterial" id="idmaterial">
                  <label for="idturma" class="control-label">Código da Turma:</label><br>
                  <input name="idturma" type="text" class="form-control" id="idturma" readonly><br>
                  <label for="descricao" class="control-label">Descricao:</label>
                  <input name="descricao" class="form-control" id="descricao" readonly>
                  <label for="nomearquivo" style="padding-top: 20px" class="control-label">Nome do Material:</label>
                  <input name="nomearquivo" class="form-control" id="nomearquivo" readonly>
                </div>
              </div>
              <button type="submit" class="btn btn-danger">Excluir</button>
              <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </form>
          </div> 
        </div>
      </div>
    </div>

      
    
    </div>    

  <script type="text/javascript">
  $('#ExcluiModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipientidmaterial = button.data('idmaterial')
      var recipientidturma = button.data('idturma') // Extract info from data-* attributes
      var recipientdescricao = button.data('descricao')
      var recipientnomearquivo = button.data('nomearquivo')
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('Deseja excluir o seguinte arquivo do sistema?')
      modal.find('#idmaterial').val(recipientidmaterial)
      modal.find('#idturma').val(recipientidturma)
      modal.find('#descricao').val(recipientdescricao)
      modal.find('#nomearquivo').val(recipientnomearquivo)
      
    })
  </script>

  
     
<?php
require_once("footer.php"); 
?>