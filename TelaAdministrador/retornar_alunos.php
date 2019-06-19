<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    $conecta = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");

    $selecao  = "SELECT Matricula,Nome_completo
                    FROM pessoa
                    INNER JOIN aluno ON pessoa.Matricula = aluno.Matricula_pessoa
                        WHERE pessoa.Status = 'Aguardando Turma' OR pessoa.Status = 'Ativo'";
    
    $produtos = mysqli_query($conecta,$selecao);

    $retorno = array();
    while($linha = mysqli_fetch_object($produtos)) {
        $retorno[] = $linha;
    } 	
    echo ($callback ? $callback . '(' : '') . json_encode($retorno) . ($callback? ')' : '');
    
    // fechar conecta
    mysqli_close($conecta);
?>