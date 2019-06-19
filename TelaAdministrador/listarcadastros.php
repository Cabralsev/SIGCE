<?php 
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

    $result_usuarios = "SELECT curso.Tipo, curso.Descricao , nome_turma.nome_turma 
                        FROM curso
                        INNER JOIN nome_turma ON curso.idCurso = nome_turma.idCurso 
                        LIMIT $inicio, $qnt_result_pg";
    $resultado_usuarios = mysqli_query($conn, $result_usuarios);

      while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){    
    
      echo '<tr>';
      echo '<td>'. $row_usuario['Tipo'] . '</td>';
      echo '<td>'. $row_usuario['Descricao'] . '</td>';
      echo '<td>'. $row_usuario['nome_turma']. '</td>';
      echo '</tr>';

    }

?>