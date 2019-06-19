<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    $conecta = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");

    $selecao = "SELECT pessoa.Matricula,pessoa.Nome_Completo
                FROM pessoa
                INNER JOIN professor ON pessoa.Matricula = professor.Matricula_pessoa;";
    $professores = mysqli_query($conecta,$selecao);
    
    $retorno = array();
    while($linha = mysqli_fetch_object($professores)) {
        $retorno[] = $linha;
        } 	

    echo ($callback ? $callback . '(' : '') . json_encode($retorno) . ($callback? ')' : '');
    
    // fechar conecta
    mysqli_close($conecta);
?>