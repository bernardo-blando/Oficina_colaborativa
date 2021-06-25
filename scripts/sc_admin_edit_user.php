<?php
session_start();
echo var_dump($_POST);
if ($_SESSION["role_oc"] == 2) {
    if (isset($_GET["id"]) && isset($_POST["nome"]) && isset($_POST["apelido"]) && isset($_POST["email"]) && isset($_POST["telemovel"]) && isset($_POST["role"])) {
        require_once "../connections/connection.php";
        echo "<p>im in</p>";
        $idget = $_GET["id"];
        $nome = $_POST["nome"];
        $telemovel = $_POST["telemovel"];
        $apelido = $_POST["apelido"];
        $email = $_POST["email"];
        $user_id = $_SESSION["id_user_oc"];
        $role = $_POST["role"];
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "SELECT Telemovel, nome, apelido, ref_id_roles, idUtilizadores FROM Utilizadores
            WHERE idUtilizadores = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $idget);
            mysqli_stmt_bind_result($stmt, $telemovelbd, $nomebd, $apelidobd, $rolebd, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_fetch($stmt);

        } else {
            mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);

        function update($types, $column, $update, $idup)
        {
            $link = new_db_connection();
            $stmtup = mysqli_stmt_init($link);
            $query = "UPDATE Utilizadores
            SET " . $column . " = ?
            WHERE idUtilizadores =" . $idup;


            if (mysqli_stmt_prepare($stmtup, $query)) {
                mysqli_stmt_bind_param($stmtup, $types, $update);
                if (mysqli_stmt_execute($stmtup)) {
                    echo "<p>nice" . $column . "</p>";
                    return true;
                } else {
                    return false;
                }

            } else {
                echo "<p>" . mysqli_error($link) . "</p>";
            }
            mysqli_stmt_close($stmtup);
            mysqli_close($link);
        }


        $link = new_db_connection();
        $stmt1 = mysqli_stmt_init($link);
        $query1 = "SELECT count(email) FROM Utilizadores
            WHERE email = ? ";

        if (mysqli_stmt_prepare($stmt1, $query1)) {
            mysqli_stmt_bind_param($stmt1, "s", $email);
            mysqli_stmt_bind_result($stmt1, $emailCount);
            mysqli_stmt_execute($stmt1);
            if (!mysqli_stmt_fetch($stmt1)) {
                echo "wtf";
            };

        } else {
            mysqli_error($link);
        }
        mysqli_stmt_close($stmt1);
        mysqli_close($link);


        $link = new_db_connection();
        $stmt1 = mysqli_stmt_init($link);
        $query1 = "SELECT count(Telemovel) FROM Utilizadores
            WHERE Telemovel = ? ";

        if (mysqli_stmt_prepare($stmt1, $query1)) {
            mysqli_stmt_bind_param($stmt1, "i", $telemovel);
            mysqli_stmt_bind_result($stmt1, $teleCount);
            mysqli_stmt_execute($stmt1);
            if (!mysqli_stmt_fetch($stmt1)) {
                echo "wtf";
            };

        } else {
            mysqli_error($link);
        }
        mysqli_stmt_close($stmt1);
        mysqli_close($link);
        if ($emailCount == 0) {

            if (update("s", "email", $email, $id)) {
                echo "email";
            }
        } else {
            echo "já existe este email";
        }

        if ($teleCount == 0) {
            if (update("i", "Telemovel", $telemovel, $id)) {
                echo "telemovel";
            }


        } else {
            echo "já existe este telemovel";
        }

        if ($nome != $nomebd) {

            if (update("s", "nome", $nome, $id)) {

            }
        }

        if ($apelido != $apelidobd) {
            if (update("s", "apelido", $apelido, $id)) {
                echo "apelido";
            }
        }

        if ($role != $rolebd) {

            if (update("i", "ref_id_roles", $role, $id)) {
                echo "<p> role changed</p>";
            }
        }

        header("location: ../index.php?page=admin&feed=3");
    }else{
         header("location: ../index.php?page=admin&feed=0");
    }

} else {
     header("Location: https://www.google.com/longedaqui.php");
}