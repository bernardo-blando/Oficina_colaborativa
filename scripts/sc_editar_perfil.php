<?php

session_start();
echo "<p>".htmlspecialchars(var_dump($_POST))."</p>";
echo "<p>".htmlspecialchars(var_dump($_SESSION))."</p>";
if (isset($_POST["nome"]) && isset($_POST["apelido"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_SESSION["id_user_oc"])) {
    echo "in";
    require_once "../connections/connection.php";
    $nome = $_POST["nome"];
    $apelido = $_POST["apelido"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user_id = $_SESSION["id_user_oc"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "SELECT password_hash, nome, apelido, email FROM Utilizadores
            WHERE idUtilizadores =" . $user_id;

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_result($stmt, $password_hash, $nomebd, $apelidobd, $emailbd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_fetch($stmt);

    } else {
        mysqli_error($link);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);

    if (password_verify($password, $password_hash)) {
        function update($types, $column, $update)
        {
            $link = new_db_connection();
            $stmtup = mysqli_stmt_init($link);
            $query = "UPDATE Utilizadores
            SET ".$column." = ?
            WHERE idUtilizadores =" . $_SESSION["id_user_oc"];


            if (mysqli_stmt_prepare($stmtup, $query)) {
                mysqli_stmt_bind_param($stmtup, $types, $update);
                if (mysqli_stmt_execute($stmtup)) {
                    echo "<p>nice". $column."</p>";
                    return true;
                }else{
                    return false;
                }

            } else {
                echo "<p>".mysqli_error($link)."</p>";
            }
            mysqli_stmt_close($stmtup);
            mysqli_close($link);
        }

        if ($nome != $nomebd) {
            if(update("s", "nome", $nome)){
                $_SESSION["nome_oc"]=$nome;
            }
        }

        if($apelido!= $apelidobd){
            if(update("s", "apelido", $apelido)){
                echo "apelido";
            }
        }

        $link = new_db_connection();
        $stmt1 = mysqli_stmt_init($link);
        $query1 = "SELECT count(email) FROM Utilizadores
            WHERE email = ? ";

        if (mysqli_stmt_prepare($stmt1, $query1)) {
            mysqli_stmt_bind_param($stmt1, "s", $email);
            mysqli_stmt_bind_result($stmt1, $emailCount);
            mysqli_stmt_execute($stmt1);
            if(!mysqli_stmt_fetch($stmt1)){
                echo "wtf";
            };

        } else {
            mysqli_error($link);
        }
        mysqli_stmt_close($stmt1);
        mysqli_close($link);

        if ($emailCount==0){

            if(update("s", "email", $email)){
                echo "email";
            }
        }


    }else{
        echo "wrong password";
    }

}
