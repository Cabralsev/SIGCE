<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
    </head>
</body>
<?php

include_once("conexao1.php");
$arquivo = str_replace(" ", "_", $_FILES["arquivo"]["name"]);
$codigo = $_POST["hosting-plan"];
$descricao = $_POST["descricao"];

//echo $arquivo;
//echo $codigo;
//echo $descricao;
//die;

/*
//Tratamento da imagem
if ($_FILES['arquivo']['size'] > 0 && $_FILES['arquivo']['size'] < 5971520) {

    $tipo_imagem = '.' . strtolower(end(explode('.', $_FILES['imagem_upload']['name'])));
    $nome_final = time() . '.jpg';
    $codigo = $_POST["hosting-plan"];
    $descricao = $_POST["descricao"];

    $nome_imagem = $_FILES['arquivo']['name'];
    $nome_imagem_temp = $_FILES['arquivo']['tmp_name'];

    $pasta_imagem = 'teste/';
    $local = $pasta_imagem . $nome_imagem;
    move_uploaded_file($nome_imagem_temp, $local);
    rename($pasta_imagem . $nome_imagem, $pasta_imagem . $nome_final . $tipo_imagem);
    //(FIM)Tratamento da imagem
    
    //Tratamento SQL
   $query = mysqli_query($conn, "INSERT INTO materialdeapoio (Nome_arquivo, Descricao, idTurma) VALUES('$nome_final','$descricao','$codigo')");

        echo '<script language="javascript">';
        echo 'alert("Material cadastrado com sucesso!")';
        echo '</script>';
        //header('Location:register.php');
        header("Refresh: 2, materialdeapoio.php");
        exit;

    //(FIM)Tratamento SQL
}
*/
$target_dir = 'teste/';
$target_file = $target_dir . $arquivo;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check file size
if ($_FILES["arquivo"]["size"] > 20971520) { // 20 MB
    echo '<script language="javascript">';
    echo 'alert("O tamanho do arquivo: '. basename( $_FILES["arquivo"]["name"]).' não é suportado!")';
    echo '</script>';
    header("Refresh: 2, materialdeapoio.php");
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" ) {
    echo '<script language="javascript">';
    echo 'alert("A extensão do arquivo: '. basename( $_FILES["arquivo"]["name"]).' não aceita!")';
    echo '</script>';
    header("Refresh: 2, materialdeapoio.php");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    //Tratamento SQL
   $query = mysqli_query($conn, "INSERT INTO materialdeapoio (Nome_arquivo, Descricao, idTurma) VALUES('$arquivo','$descricao','$codigo')");        
    //(FIM)Tratamento SQL

    if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
        echo '<script language="javascript">';
        echo 'alert("O arquivo '. basename( $_FILES["arquivo"]["name"]).' foi cadastrado com sucesso!")';
        echo '</script>';
        header("Refresh: 2, materialdeapoio.php");

    } else {
        echo "Houve um erro ao cadastrar seu arquivo.";
    }
}


?>

</body>
</html>