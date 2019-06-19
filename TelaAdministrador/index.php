<?php include("session.php");?>
<?php 
require_once("header.php");
require_once ("navbar.php");
require_once("sidebar.php");
include ("conexao1.php");
?>
<style>
 #detalhes {
  padding: 12px;
  text-align: center;

}

#painel {
  padding: 30px;
  display: none;
}

#painelinativo {
  padding: 30px;
  display: none;
}
th, td , tr{
  padding: 8px;
}
</style>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script src="tabelascript.js"></script> 
<?php
$result_events = "SELECT id, title, color, start, end FROM events";
$resultado_events = mysqli_query($conn, $result_events);
?>
        <link href='css/fullcalendar.min.css' rel='stylesheet' />
        <link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
               
        <script src='js/moment.min.js'></script>
        <script src='js/fullcalendar.min.js'></script>
        <script src='locale/pt-br.js'></script>
<script>
      $(document).ready(function() {
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          defaultDate: Date(),
          navLinks: true, // can click day/week names to navigate views
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          eventClick: function(event) {
            
            $('#visualizar #id').text(event.id);
            $('#visualizar #id').val(event.id);
            $('#visualizar #title').text(event.title);
            $('#visualizar #title').val(event.title);
            $('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
            $('#visualizar #start').val(event.start.format('DD/MM/YYYY HH:mm:ss'));
            $('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
            $('#visualizar #end').val(event.end.format('DD/MM/YYYY HH:mm:ss'));
            $('#visualizar #color').val(event.color);
            $('#visualizar').modal('show');
            return false;

          },
          
          selectable: true,
          selectHelper: true,
          select: function(start, end){
            $('#cadastrar #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
            $('#cadastrar #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
            $('#cadastrar').modal('show');            
          },
          events: [
            <?php
              while($row_events = mysqli_fetch_array($resultado_events)){
                ?>
                {
                id: '<?php echo $row_events['id']; ?>',
                title: '<?php echo $row_events['title']; ?>',
                start: '<?php echo $row_events['start']; ?>',
                end: '<?php echo $row_events['end']; ?>',
                color: '<?php echo $row_events['color']; ?>',
                },<?php
              }
            ?>
          ]
        });
      });
      
      //Mascara para o campo data e hora
      function DataHora(evento, objeto){
        var keypress=(window.event)?event.keyCode:evento.which;
        campo = eval (objeto);
        if (campo.value == '00/00/0000 00:00:00'){
          campo.value=""
        }
       
        caracteres = '0123456789';
        separacao1 = '/';
        separacao2 = ' ';
        separacao3 = ':';
        conjunto1 = 2;
        conjunto2 = 5;
        conjunto3 = 10;
        conjunto4 = 13;
        conjunto5 = 16;
        if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
          if (campo.value.length == conjunto1 )
          campo.value = campo.value + separacao1;
          else if (campo.value.length == conjunto2)
          campo.value = campo.value + separacao1;
          else if (campo.value.length == conjunto3)
          campo.value = campo.value + separacao2;
          else if (campo.value.length == conjunto4)
          campo.value = campo.value + separacao3;
          else if (campo.value.length == conjunto5)
          campo.value = campo.value + separacao3;
        }else{
          event.returnValue = false;
        }
      }
    </script>

<div id="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Visão Geral</li>
    </ol>

    <!-- Icon Cards-->
    <div class="row">

      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
          <?php
          $hoje = date("d-m-Y");
          
          $sql = "SELECT COUNT(idMensagem) AS Mensagens FROM mensagem WHERE mensagem.Data_envio = '".$hoje."'"; 
              $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
               while ($record = mysqli_fetch_assoc($resultset)) {
           ?>
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-comments"></i>
            </div>
            <div class="mr-5">
              <?php 
              if (($record['Mensagens']) < 1) {
                echo "Nenhuma mensagem recebida hoje!";
              }
              else{
              echo "Mensagens recebidas hoje: ";echo $record['Mensagens']; 
              }
              ?>
              
            </div>
          </div>
        <?php } ?>
          <a class="card-footer text-white clearfix small z-1" href="#tabela">
            <span class="float-left">Ver Detalhes</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
          <?php
          $ano = date("Y");
          $sql = "SELECT COUNT(*) qtd, 
                  YEAR(data_matricula) ano
                  FROM aluno
                  INNER JOIN pessoa
                  ON aluno.Matricula_pessoa = pessoa.Matricula
                  WHERE YEAR(data_matricula) = '".$ano."'";
          $resultset = mysqli_query($conn,$sql) or die ("database error:". mysqli_error($conn));
          while ($record = mysqli_fetch_assoc($resultset)) {
            ?>
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-fw fa-list"></i>
            </div>
            <div class="mr-5"><?php echo $record['qtd'];echo " Alunos matriculados em ";echo $record['ano'];echo"!"; ?></div>
          </div>
        <?php } ?>
          <a class="card-footer text-white clearfix small z-1" href="relatorios.php">
            <span class="float-left">Ver Detalhes</span>
            <span class="float-right">
              <i class="fas fa-angle-right"></i>
            </span>
         </a>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-info o-hidden h-100">
          <?php
          $sql = "SELECT COUNT(*) AS ativos
                  FROM aluno_matricula_turma
                  INNER JOIN pessoa ON aluno_matricula_turma.idAluno = pessoa.Matricula
                  INNER JOIN turma ON aluno_matricula_turma.id_Turma = turma.Codigo
                  WHERE pessoa.Status = 'Ativo' AND turma.Status = 'Ativo'";

          $resultativos = mysqli_query($conn,$sql) or die ("database error:". mysqli_error($conn));
            while ($ativo = mysqli_fetch_assoc($resultativos)){

          ?>
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="mr-5"><?php echo $ativo['ativos'];echo " Alunos ativos!";  ?></div>
          </div>
          <?php } ?>
          <a class="card-footer text-white clearfix small z-1" id="detalhes">
            <span class="float-left" id="detalhes1">Ver Detalhes</span>
            <script>
              $(document).ready(function(){
               $("#detalhes").click(function(){
               $("#painel").slideToggle("slow");
               $("#detalhes1").toggle();
               $("#detalhes2").toggle();
                });
              });
            </script>
               <div id="painel">
                 <table class="row d-flex justify-content-center border border-info">
                  <thead> 
                    <tr>
                      <th scope="col">Código</th>
                      <th scope="col">Turma</th>
                      <th scope="col">Alunos</th>
                    </tr>
                  </thead>
                   <tbody>
                    <?php  
                    include ("tabela_index.php");
                    ?>
                  </tbody>
                </table>
              </div>
            <span class="float-right" id="detalhes2">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>

      <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
          <?php
          $sql = "SELECT COUNT(*) AS inativos
                  FROM aluno
                  INNER JOIN pessoa ON aluno.Matricula_pessoa = pessoa.Matricula
                  WHERE pessoa.Status = 'Inativado'";
          $resultinativos = mysqli_query($conn,$sql) or die ("database error:". mysqli_error($conn));
            while ($inativo = mysqli_fetch_assoc($resultinativos)){
          ?>
          <div class="card-body">
            <div class="card-body-icon">
              <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="mr-5"><?php echo $inativo['inativos'];echo " Alunos Inativos!";  ?></div>
          </div>
          <?php } ?>
          <a class="card-footer text-white clearfix small z-1" id="detalhesinativos">
            <span class="float-left" id="detalhes3">Ver Detalhes</span>
            <script>
              $(document).ready(function(){
               $("#detalhesinativos").click(function(){
               $("#painelinativo").slideToggle("slow");
               $("#detalhes3").toggle();
               $("#detalhes4").toggle();
                });
              });
            </script>
               <div id="painelinativo">
                 <table class="row d-flex justify-content-center border border-info" style="margin-bottom: 50px;">
                  <thead style="text-align: justify;"> 
                    <tr>
                      <th scope="col">Quantidade</th>
                      <th scope="col">Motivo Desistência</th>
                    </tr>
                  </thead>
                   <tbody style="text-align: center;">
                    <?php  
                    include ("tabela_index_inativos.php");
                    ?>
                  </tbody>
                </table>
              </div>
            <span class="float-right" id="detalhes4">
              <i class="fas fa-angle-right"></i>
            </span>
          </a>
        </div>
      </div>
      

        <!-- Modal-->
        <div class="modal fade" id="Enturmar"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <form action="inserecurso.php" method="post">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Adicionando Curso</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="container">
                  <label for="curso"><b>Novo Curso:</b></label>
                  <input class="form-control" type="text" style="width: 50%" placeholder="Ex:Inglês" name="curso" required><br>

                  <label for= "descrição"><b>Descrição do Curso:</b></label>
                  <input class="form-control" type="text" style="width: 100%" name="descricao" required>    

                </div>

                <div class="container" style="background-color:#f1f1f1">
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- Fechou modal-->

<div class="modal fade" id="modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <form action="insereturma.php" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Adicionando Turma</h5>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
           </button>
         </div>
        <div class="container" style="padding: 10px ">
          <label for="nometurma" class="page1 control-label col-sm-0 col-md-0"><b>Nome da Turma:</b></label>
          <div>
            <input id="nometurma" class="form-control" type="text" maxlength="15" placeholder="Nome da Turma" name="nometurma" required><br>
          </div>   
        </div>
        <div class="container" style="padding: 10px">
          <label for="curso"><b>Curso correspondente:</b></label>
          <select class="browser-default custom-select" id="curso" name="curso">      
          </select>
        </div>
        <div class="container" style="background-color:#f1f1f1">
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

</div>
</div>

<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-plus-square"></i>
  Adicionar novas turmas e cursos</div>
  <div class="card-body">

  <button style="margin: 10px" class="btn btn-primary" type="submit" id="submit" data-toggle="modal" data-target="#Enturmar" style="width:auto">Adicionar Curso</button>
  <button style="margin: 10px" class="btn btn-primary" type="submit" id="submit" data-toggle="modal" data-target="#modal" style="width:auto">Adicionar Turma</button>


  </div>
</div>

  <div class="card mb-3">
    <div class="card-header">
      <i class="far fa-calendar"></i>
    Agenda</div>
    <div class="card-body"> 
    <div class="container">
      <?php
      if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      }
      ?>
    
      <div id='calendar'></div>
    </div>  
  <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" style="margin-right: 145px">Dados do Evento</h4>
          </div>
          <div class="modal-body">
            <div class="visualizar">
              <dl class="dl-horizontal">
                <dt>ID do Evento</dt>
                <dd id="id"></dd>
                <dt>Titulo do Evento</dt>
                <dd id="title"></dd>
                <dt>Inicio do Evento</dt>
                <dd id="start"></dd>
                <dt>Fim do Evento</dt>
                <dd id="end"></dd>
              </dl>
            </div>
            <div class="form">
              <form class="form-horizontal" method="POST" action="proc_edit_evento.php">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Titulo do Evento">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Cor</label>
                  <div class="col-sm-10">
                    <select name="color" class="form-control" id="color">
                      <option value="">Selecione</option>     
                      <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                      <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                      <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                      <option style="color:#8B4513;" value="#8B4513">Marrom</option>  
                      <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                      <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                      <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                      <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>                    
                      <option style="color:#228B22;" value="#228B22">Verde</option>
                      <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)">
                  </div>
                </div>
                <input type="hidden" class="form-control" name="id" id="id">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </form>
              
            
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" style="margin-right: 145px">Cadastrar Evento</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" method="POST" action="proc_cad_evento.php">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Titulo</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" placeholder="Titulo do Evento">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Cor</label>
                <div class="col-sm-10">
                  <select name="color" class="form-control" id="color">
                    <option value="">Selecione</option>     
                    <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                    <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                    <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                    <option style="color:#8B4513;" value="#8B4513">Marrom</option>  
                    <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                    <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                    <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                    <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>                    
                    <option style="color:#228B22;" value="#228B22">Verde</option>
                    <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="start" id="start" onKeyPress="DataHora(event, this)">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Data Final</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="end" id="end" onKeyPress="DataHora(event, this)">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-success">Cadastrar</button>
                  <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <script>
      $('.btn-canc-vis').on("click", function() {
        $('.form').slideToggle();
        $('.visualizar').slideToggle();
      });
      $('.btn-canc-edit').on("click", function() {
        $('.visualizar').slideToggle();
        $('.form').slideToggle();
      });
    </script>
  <!-- DataTables Example -->
  <div class="card mb-3" id="tabela">
    <div class="card-header">
      <i class="far fa-comment-dots"></i>
    Mensagens Recebidas</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dtBasicExample" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="th-sm">Nome</th>
              <th class="th-sm">Email</th>
              <th class="th-sm">Texto</th>
              <th class="th-sm">Data de envio</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Texto</th>
              <th>Data de envio</th>
             </tr>
          </tfoot>
           <tbody>
            <?php require_once("listarmensagens.php");?>
          </tbody>
        </table>
      </div>
    </div>

</div>
<!-- /.container-fluid -->
<script>


  $.ajax({
    type:"GET",
    url: "retornar_cursos.php",
    async:false
  }).done(function(data){
    var curso = "";
    $.each($.parseJSON(data), function(chave,valor){
      curso += '<option name = "curso" value ="' + valor.idCurso + '">'+ valor.Tipo +'</option>';

    });
    $('#curso').html(curso);
  });
  
</script>

<?php 
require_once("footer.php"); 
?>