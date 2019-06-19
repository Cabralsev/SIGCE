<?php 

    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    $conecta = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");

$selecao = "SELECT Codigo as Codigo_Turma, pessoa.Nome_Completo, turma.Status as Status_Turma, Periodo_Letivo, nivel, nome_turma, curso.Tipo
             FROM nome_turma
              INNER JOIN turma ON idNome = NomeTurma
              INNER JOIN curso ON turma.idCurso = curso.idCurso
              INNER JOIN pessoa ON turma.Matricula_professor = pessoa.Matricula
               WHERE turma.Status = 'Ativo'";
    
    $produtos = mysqli_query($conecta,$selecao);

   

    $retorno = array();
    while($linha = mysqli_fetch_object($produtos)) {
        $retorno[] = $linha;
    } 	

    echo ($callback ? $callback . '(' : '') . json_encode($retorno) . ($callback? ')' : '');
    
    // fechar conecta
    mysqli_close($conecta);
?>