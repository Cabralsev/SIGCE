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

    $result_usuarios = "SELECT atividade.Nota_1 , atividade.Nota_2 , atividade.Nota_3 , atividade.Media ,
    						   atividade.data_lancamento , atividade.Situacao , atividade.Turma_idTurma , pessoa.Nome_Completo ,pessoa.Matricula ,nome_turma.nome_turma
								FROM atividade
								INNER JOIN pessoa ON atividade.Matricula_aluno = pessoa.Matricula
								INNER JOIN turma ON atividade.Turma_idTurma = turma.Codigo
								INNER JOIN nome_turma ON turma.Nometurma = nome_turma.idNome 
                        		LIMIT $inicio, $qnt_result_pg";

    $resultado_usuarios = mysqli_query($conn, $result_usuarios);

      while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){    
    
      echo '<tr>';
      echo '<td>'. $row_usuario['Matricula'] . '</td>';
      echo '<td>'. $row_usuario['Nome_Completo'] . '</td>';
      echo '<td>'. $row_usuario['nome_turma']. '</td>';
      echo '<td>'. $row_usuario['Turma_idTurma']. '</td>';
      echo '<td>'. $row_usuario['Nota_1']. '</td>';
      echo '<td>'. $row_usuario['Nota_2']. '</td>';
      echo '<td>'. $row_usuario['Nota_3']. '</td>';
      echo '<td>'. $row_usuario['Media']. '</td>';
      echo '<td>'. $row_usuario['Situacao']. '</td>';
      echo '</tr>';

    }
      
    
    //Paginação - Somar a quantidade de usuários
    $result_pg = "SELECT COUNT(idAtividade) AS num_result FROM atividade";
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