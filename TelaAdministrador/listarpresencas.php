<?php
include 'conexao1.php';

if(isset($_SESSION['msg'])){
   echo $_SESSION['msg'];
   unset($_SESSION['msg']);
  }
     
    //Receber o número da página
    $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);   
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
    
    //Setar a quantidade de itens por pagina
    $qnt_result_pg = 100;
    
    //calcular o inicio visualização
    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
    
      

    $result_usuarios = "SELECT presenca.idTurma , presenca.Matricula , presenca.Data , presenca.Frequencia ,
    pessoa.Nome_Completo 
                      FROM presenca
                      INNER JOIN aluno_matricula_turma ON presenca.Matricula = aluno_matricula_turma.idAluno AND presenca.idTurma = aluno_matricula_turma.id_Turma
                      INNER JOIN pessoa ON aluno_matricula_turma.idAluno = pessoa.Matricula
                                  LIMIT 
                                    $inicio, 
                                    $qnt_result_pg";

    $resultado_usuarios = mysqli_query($conn, $result_usuarios);

      while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
   
    
      echo '<tr>';
      echo '<td>'. $row_usuario['idTurma'] . '</td>';
      echo '<td>'. $row_usuario['Nome_Completo'] . '</td>';
      echo '<td>'. $row_usuario['Matricula'] . '</td>';
      echo '<td>'. date("d/m/Y",strtotime($row_usuario['Data'])) . '</td>';
      echo '<td>'. $row_usuario['Frequencia'] . '</td>';
      echo '</tr>';
    }

    
?>