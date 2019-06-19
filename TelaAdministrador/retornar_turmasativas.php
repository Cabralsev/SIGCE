<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    $conecta = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");

    $selecao = "SELECT turma.Codigo, pessoa.Nome_Completo , pessoa.Status , professor.Matricula_pessoa FROM turma
                INNER JOIN professor ON turma.Matricula_professor = professor.Matricula_pessoa
                INNER JOIN pessoa ON professor.Matricula_pessoa = pessoa.Matricula
                WHERE pessoa.Status = 'Ativo' AND turma.Status = 'Ativo'";
                
    $professores = mysqli_query($conecta,$selecao);
    
    $retorno = array();
    while($linha = mysqli_fetch_object($professores)) {
        $retorno[] = $linha;
        }   

    echo ($callback ? $callback . '(' : '') . json_encode($retorno) . ($callback? ')' : '');
    
    // fechar conecta
    mysqli_close($conecta);
?>