<?php 
   
        //Receber o número da página
    $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);   
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
    
    //Setar a quantidade de itens por pagina
    $qnt_result_pg = 5;
    
    //calcular o inicio visualização
    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
    
      

    $result_usuarios = "SELECT Matricula,Nome_completo
                        FROM pessoa
                        INNER JOIN aluno ON pessoa.Matricula = aluno.Matricula_pessoa LIMIT $inicio, $qnt_result_pg";
    $resultado_usuarios = mysqli_query($conn, $result_usuarios);

      while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){

      
    
      echo '<tr>';
      echo '<td>'. utf8_encode($row_usuario['Matricula']) . '</td>';
      echo '<td>'. utf8_encode($row_usuario['Nome_completo']) . '</td>';
      echo '<td>'. '<input type="checkbox"></input>' ;
      echo '</tr>';

    }



     //Paginação - Somar a quantidade de usuários
    $result_pg = "SELECT COUNT(idAluno) AS num_result FROM aluno";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);
    //echo $row_pg['num_result'];
    //Quantidade de pagina 
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
    
    //Limitar os link antes depois
    $max_links = 2;
    echo "<a href='telaenturmaraluno.php?pagina=1'>Primeira</a> ";
    
    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
      if($pag_ant >= 1){
        echo "<a href='telaenturmaraluno.php?pagina=$pag_ant'>$pag_ant</a> ";
      }
    }
      
    echo "$pagina ";
    
    for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
      if($pag_dep <= $quantidade_pg){
        echo "<a href='telaenturmaraluno.php?pagina=$pag_dep'>$pag_dep</a> ";
      }
    }
    
    echo "<a href='enturmaraluno.php?pagina=$quantidade_pg'>Ultima</a>";
      

?>

