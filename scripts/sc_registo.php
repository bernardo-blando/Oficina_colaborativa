<?php

require_once "../connections/connection.php";

echo(var_dump($_POST));
if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password_verify"]) && isset($_POST["apelido"]) && isset($_POST["telemovel"])) {

    if ($_POST["password"] == $_POST["password_verify"]) {


        $telemovel = $_POST["telemovel"];

        $apelido = $_POST["apelido"];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $link = new_db_connection();

        $stmt1 = mysqli_stmt_init($link);

        $query1 = "
        SELECT COUNT(email)
        FROM utilizadores
        WHERE email LIKE ?";

        if (mysqli_stmt_prepare($stmt1, $query1)) {
            mysqli_stmt_bind_param($stmt1, 's', $email);
            mysqli_stmt_bind_result($stmt1, $emailN);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_fetch($stmt1);

        } else {
            echo "error description: " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt1);

        $link = new_db_connection();

        $stmt2 = mysqli_stmt_init($link);

        $query2 = "
        SELECT COUNT(Telemovel)
        FROM utilizadores
        WHERE Telemovel LIKE ?";

        if (mysqli_stmt_prepare($stmt2, $query2)) {
            mysqli_stmt_bind_param($stmt2, 's', $telemovel);
            mysqli_stmt_bind_result($stmt2, $tlmN);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_fetch($stmt2);

        } else {
            echo "error description: " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt2);

        if ($tlmN == 0) {
            if ($emailN == 0) {

                $stmt = mysqli_stmt_init($link);
                $query = "INSERT INTO utilizadores (nome, apelido, email, password_hash, Telemovel) VALUES (?, ?, ?, ?, ?)";
                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $apelido, $email, $password_hash, $telemovel);

                    if (!mysqli_stmt_execute($stmt)) {
                        echo "verybad";
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);

                    $msg = 1;
                    echo "sucess";

                } else {
                    echo "signUp falhou";
                    $msg = 0;
                    echo "error description: " . mysqli_error($link);
                    mysqli_close($link);
                }
            } else {
                $msg = 4;
                echo "mails a mais";
                mysqli_close($link);
            }

        } else {
            $msg = 3;
            echo "O telemóvel inserido já foi usado!";
        }
    } else {
        echo "password verfy falhou";
        $msg=0;
    }
} else {
    echo "Há campos por preencher!";
    $msg = 2;
}

switch ($msg) {
    case (0):
        header("Location: ../index.php?page=registo&msg=0");
        break;
    case (1):
        header("Location: ../index.php?page=login&msg=1");
        break;
    case (3):
        header("Location: ../index.php?page=registo&msg=3");
        break;
    case (4):
        header("Location: ../index.php?page=registo&msg=4");
        break;
    default:
        header("Location: ../index.php?page=registo&msg=2");
}
