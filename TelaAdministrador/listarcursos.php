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
      
    
    //Paginação - Somar a quantidade de usuários
    $result_pg = "SELECT COUNT(idCurso) AS num_result FROM curso";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);
    //echo $row_pg['num_result'];
    //Quantidade de pagina 
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
    
  //  echo "<ul class='pagination pg-blue'>";
    //Limitar os link antes depois
    $max_links = 2;
    //echo "<li class = 'page-item'><a class='page-link' href='tabelacurso.php?pagina=1'>Primeira</a></li> ";
    
    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
      if($pag_ant >= 1){
      //  echo "<li class = 'page-item'><a class='page-link' href='tabelacurso.php?pagina=$pag_ant'>$pag_ant</a></li> ";
      }
    }
      
    //echo "$pagina ";
    
    for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
      if($pag_dep <= $quantidade_pg){
      //  echo "<li class = 'page-item'><a class='page-link' href='tabelacurso.php?pagina=$pag_dep'>$pag_dep</a> </li>";
      }
    }
    
    //echo "<li class = 'page-item'> <a class='page-link' href='tabelacurso.php?pagina=$quantidade_pg'>Ultima</a>";
    //echo "</ul>";
    ?>