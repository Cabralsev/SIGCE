<?php
// Array with names
$a[] = "aluno";
$a[] = "Turmas";
$a[] = "funcionario";
$a[] = "professor";
$a[] = "relatorios";
$a[] = "materialdeapoio";
$a[] = "notas";

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = '<a href = "'.$name.'.php">'.$name.'</a>';
            } else {
                $hint .=' , <a href = "'.$name.'.php">'.$name.'</a>';
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "Sem sugestões" : $hint;
?>