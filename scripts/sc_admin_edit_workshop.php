<?php
session_start();
echo var_dump($_POST);
if ($_SESSION["role_oc"] == 2) {
    if (isset($_GET["id"]) && isset($_POST["nome"]) && isset($_POST["description"]) && isset($_POST["data"]) && isset($_POST["categoria"]) && isset($_POST["estado"])) {
        require_once "../connections/connection.php";
        echo "<p>im in</p>";
        $idget = $_GET["id"];
        $nome_w = $_POST["nome"];
        $estado = $_POST["estado"];
        $data = $_POST["data"];
        $description = $_POST["description"];
        $categoria = $_POST["categoria"];

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "SELECT idWorkshops, nome_workshop, estado, data_inicio, description, ref_idCategorias 
                  FROM workshops
                  INNER JOIN categorias ON ref_idCategorias = idCategorias   
                  WHERE idWorkshops = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $idget);
            mysqli_stmt_bind_result($stmt, $id, $nomebd, $estadobd, $databd, $descriptionbd, $categoriabd);

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
            $query = "UPDATE workshops
            SET " . $column . " = ?
            WHERE idWorkshops =" . $idup;


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









        if ($nome_w != $nomebd) {

            if (update("s", "nome_workshop", $nome_w, $id)) {

            }
        }

        if ($estado != $estadobd && ($estado == "Ativo" || $estado == "Pendente" || $estado == "Cancelado" || $estado == "Finalizado")  ) {
            if (update("s", "estado", $estado, $id)) {
                echo "estado";
            }
        }

        if ($categoriabd != $categoria) {

            if (update("i", "ref_idCategorias", $categoria, $id)) {
                echo "<p> cat changed</p>";
            }
        }
        if ($description != $descriptionbd) {

            if (update("s", "description", $description, $id)) {
                echo "<p> description changed</p>";
            }
        }
        if ($data != $databd) {

            if (update("s", "description", $description, $id)) {
                echo "<p> date changed</p>";
            }
        }


        header("location: ../index.php?page=admin_workshops&feed=3");
    }else{
        header("location: ../index.php?page=admin_workshops&feed=0");
    }

} else {
    header("Location: https://www.google.com/longedaqui.php");
}