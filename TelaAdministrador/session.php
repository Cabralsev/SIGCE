<?php
session_start();

if (empty($_SESSION['UsuarioNivel'])) {
    header("Location: http://megavirtua.com.br/sigce/Telainicial/");
}

?>