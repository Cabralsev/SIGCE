<?php 
    $callback = isset($_GET['callback']) ?  $_GET['callback'] : false;
    $conecta = mysqli_connect("mysql.hostinger.com.br","u457194965_root","123321","u457194965_tcc");

    $selecao = "SELECT idCurso, Tipo FROM curso";
    $categorias = mysqli_query($conecta,$selecao);
    
    $retorno = array();
    while($linha = mysqli_fetch_object($categorias)) {
        $retorno[] = $linha;
        } 	

    echo ($callback ? $callback . '(' : '') . json_encode($retorno) . ($callback? ')' : '');
    
    // fechar conecta
    mysqli_close($conecta);
?>