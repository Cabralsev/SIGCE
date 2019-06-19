<div id="wrapper">
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">
            <i class="material-icons" style="font-size:20px;">dashboard</i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons" style="font-size:20px;">assignment</i>
            <span>Cadastro</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Telas de Cadastro:</h6>
            <a class="dropdown-item" href="aluno.php">Novo Aluno</a>
            <a class="dropdown-item" href="professor.php">Novo Professor</a>
            <a class="dropdown-item" href="funcionario.php">Novo Atendente</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Outras Funções:</h6>
            <a class="dropdown-item" href="tabelaturma.php">Enturmar Aluno</a>
            <a class="dropdown-item" href="Turmas.php">Montar Turma</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="relatorios.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Relatórios</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons" style="font-size:20px;">assignment</i>
            <span>Tabelas</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Tipos de tabelas:</h6>
            <a class="dropdown-item" href="tabelaaluno.php">Alunos</a>
            <a class="dropdown-item" href="tabelaturma.php">Turmas</a>
            <a class="dropdown-item" href="tabelacurso.php">Cursos</a>
            <a class="dropdown-item" href="tabelaprofessores.php">Professores</a>
            <h6 class="dropdown-header">Histórico:</h6>
            <a class="dropdown-item" href="tabelafrequencia.php">Presenças e Faltas</a>
            <a class="dropdown-item" href="tabelanotas.php">Notas</a>
          </div>
          </li>
         <li class="nav-item">
          <a class="nav-link" href="materialdeapoio.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Material de Apoio</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="notas.php">
            <i class="material-icons" style="font-size: 18px">add_box</i>
            <span>Lançar Notas</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#PresencaModal">
            <i class="material-icons" style="font-size: 18px">add_box</i>
            <span>Lançar Presenças</span></a>
        </li>
      </ul>

     <?php include ('modalpresenca.php');  ?>


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
              $('#pesquisaturma').html(turma);
            });
  
    </script>


    