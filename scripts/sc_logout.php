<?php
session_start();
echo"<h1>Algo está errado <a href='../index.php?home'>voltar</a></h1>";
if (isset($_SESSION["id_user_oc"])&&isset($_SESSION["nome_oc"])){
    session_destroy();
    header("Location: ../index.php?page=login");
}
session_destroy();