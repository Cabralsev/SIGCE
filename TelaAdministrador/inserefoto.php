<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
    </head>
<body>
<?php 
include_once("session.php");
include_once("conexao1.php");

$arquivo = $_FILES['arquivo']['name'];
$codigo = $_SESSION["UsuarioMatricula"];

//echo $arquivo;
//echo $codigo;
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
 $target_dir = "teste/";
$target_file = $target_dir . basename($_FILES["arquivo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check file size
if ($_FILES["arquivo"]["size"] > 10000000) {
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://megavirtua.com.br/sigce/Teladashboard/index.php'>
                        <script type=\"text/javascript\">
                            alert(\"Tamanho do arquivo não suportado!\");
                        </script>
                    ";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://megavirtua.com.br/sigce/Teladashboard/index.php'>
                        <script type=\"text/javascript\">
                            alert(\"Extensão de arquivo não aceita!.\");
                        </script>
                    ";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    //Tratamento SQL
   $query = mysqli_query($conn, "INSERT INTO  fotos (nome_arquivo,Matricula_pessoa) VALUES('$arquivo','$codigo') ON DUPLICATE KEY UPDATE nome_arquivo = VALUES(nome_arquivo)");

       echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://megavirtua.com.br/sigce/Teladashboard/index.php'>
                        <script type=\"text/javascript\">
                            alert(\"Imagem cadastrada com Sucesso.\");
                        </script>";
        //header('Location:register.php');
        
   //(FIM)Tratamento SQL

    if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["arquivo"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


?>
</body>
</html>