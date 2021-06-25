<?php
session_start();
require_once "../connections/connection.php";
if (isset($_POST['email']) && isset($_POST['password'])) {
    $link=new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT password_hash, ref_id_roles, idUtilizadores, nome, user_image  FROM utilizadores WHERE email LIKE ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_bind_result($stmt, $password_hash, $role, $id_user, $nome, $image);

        mysqli_stmt_execute($stmt);


        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $password_hash)) {
                $_SESSION['role_oc'] = $role;
                $_SESSION["nome_oc"] = $nome;
                $_SESSION["id_user_oc"] = $id_user;
                $_SESSION["user_image_oc"] = $image;
                $msg = 3;

            } else {
                $msg = 2;
            }
        } else {
            $msg = 2;
        }
        mysqli_stmt_close($stmt);

    }else{
        echo "erro: ".mysqli_error($link);
    }
    mysqli_close($link);
}
echo ($msg);
switch ($msg) {
    case (3);
        header("Location: ../index.php?page=home");
        break;
    default:
        header("Location: ../index.php?page=login");
}