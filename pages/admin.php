<?php
if (isset($_SESSION) && $_SESSION["role_oc"] == 2) {
    require_once "connections/connection.php";


    if (isset($_GET["p"])) {
        $p = $_GET["p"];
    } elseif (!isset($_GET["p"])) {
        $p = 1;
    } //page


    if (isset($_POST["l"])) {                                                       //LIMIT
        if ($_POST["l"] <= 100) {
            $l = $_POST["l"];
        } else {
            $l = 10;
        }

    } else {
        if (isset($_GET["l"])) {
            if ($_GET["l"] <= 100) {
                $l = $_GET["l"];
            } else {
                $l = 10;
            }
        } else {
            $l = 10;
        }
    } //limit

    $offset = ($p - 1) * $l;


    if (isset($_POST["s"]) && $_POST["s"] != "") {                                                           //search
        $s = h($_POST["s"]);
    } else {
        if (isset($_GET["s"]) && $_GET["s"] != "") {
            $s = h($_GET["s"]);
        }
    } // search

    if (isset($_POST["t"])) {                                                           //searchtype
        if ($_POST["t"] == "i" || $_POST["t"] == "n" || $_POST["t"] == "a" || $_POST["t"] == "e" || $_POST["t"] == "t") {
            $t = $_POST["t"];
        } else {
            $t = "nome";
        }
    } else {
        if (isset($_GET["t"])) {
            if ($_GET["t"] == "i" || $_GET["t"] == "n" || $_GET["t"] == "a" || $_GET["t"] == "e" || $_GET["t"] == "t") {
                $t = $_GET["t"];


            } else {
                $t = "nome";
            }
        }
    } //search type

    if (isset($_POST["o"])) {                                                               //order
        if ($_POST["o"] == "nome" || $_POST["o"] == "apelido" || $_POST["o"] == "email" || $_POST["o"] == "ref_id_roles" || $_POST["o"] == "idUtilizadores") {
            $o = $_POST["o"];
        } else {
            $o = "idUtilizadores";
        }
    } else {
        if (isset($_GET["o"])) {
            if ($_GET["o"] == "nome" || $_GET["o"] == "apelido" || $_GET["o"] == "email" || $_GET["o"] == "ref_id_roles" || $_GET["o"] == "idUtilizadores") {
                $o = $_GET["o"];
            } else {
                $o = "idUtilizadores";
            }
        } else {
            $o = "idUtilizadores";
        }
    } //order

    if (isset($_POST["d"])) {                                                               //direction
        if ($_POST["d"] == "ASC" || $_POST["d"] == "DESC") {
            $d = $_POST["d"];
        } else {
            $d = "ASC";
        }
    } else {
        if (isset($_GET["d"])) {
            if ($_GET["d"] == "ASC" || $_GET["d"] == "DESC") {
                $d = $_GET["d"];
            } else {
                $d = "ASC";
            }
        } else {
            $d = "ASC";
        }
    } //direction

    include_once "includes/nav_admin.php";
    ?>
    <!-- Main Content -->
    <div id="content">
    <!-- Page Heading -->
   
    <style>
        input {

            background: none;
            border: none;
        }

        .divtable .material-icons {
            font-size: 24px;
        }
    </style>



        <form id="formsearch" action="?page=admin" method="post">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                <input type="search" name="s" placeholder="&#x2315;" class="form-control pesquisar">
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="textAlign">
                            <label>Procurar por:</label><select name="t" class="form-control pesquisar">
                            <option <?php if (isset($t)) {
                                if ($t == "n") {
                                    echo "selected";
                                }
                            } else {
                                echo "selected";
                            } ?> value="n">Nome
                            </option>
                            <option <?php if (isset($t)) {
                                if ($t == "e") {
                                    echo "selected";
                                }
                            } ?> value="e">Email
                            </option>

                            <option <?php if (isset($t)) {
                                if ($t == "i") {
                                    echo "selected";
                                }
                            } ?> value="i">Id
                            </option>

                            <option <?php if (isset($t)) {
                                if ($t == "r") {
                                    echo "selected";
                                }
                            } ?> value="r">Role
                            </option>
                            <option <?php if (isset($t)) {
                                if ($t == "t") {
                                    echo "selected";
                                }
                            } ?> value="t">Telemóvel
                            </option>

                        </select>


                </div> <!--form search-->

                <div class="textAlign">
                    <label>Número de Resultados:</label>

                    <select name="l" class="form-control pesquisar">
                        <option <?php if ($l == 10) {
                            echo "selected";
                        } ?> value="10">10
                        </option>
                        <option <?php if ($l == 25) {
                            echo "selected";
                        } ?> value="25">25
                        </option>
                        <option <?php if ($l == 50) {
                            echo "selected";
                        } ?> value="50">50
                        </option>
                        <option <?php if ($l == 100) {
                            echo "selected";
                        } ?> value="100">100
                        </option>
                    </select>


                </div> <!--form limit-->

                <div class="textAlign">
                    <label>Ordenar Por:</label>

                    <select name="o" class="form-control pesquisar">
                        <option <?php if ($o == "idUtilizadores") {
                            echo "selected";
                        } ?> value="idUtilizadores">Id
                        </option>
                        <option <?php if ($o == "nome") {
                            echo "selected";
                        } ?> value="nome">Nome
                        </option>
                        <option <?php if ($o == "apelido") {
                            echo "selected";
                        } ?> value="apelido">Apelido
                        </option>
                        <option <?php if ($o == "email") {
                            echo "selected";
                        } ?> value="email">Email
                        </option>
                        <option <?php if ($o == "ref_id_roles") {
                            echo "selected";
                        } ?> value="ref_id_roles">Role
                        </option>
                    </select>
                </div>
                        <div class="textAlign">
                    <label>Direção:</label>
                    <select name="d" class="form-control pesquisar">
                        <option <?php if ($d == "ASC") {
                            echo "selected";
                        } ?> value="ASC">Ascendente
                        </option>
                        <option <?php if ($d == "DESC") {
                            echo "selected";
                        } ?> value="DESC">Descendente
                        </option>
                    </select>
                        </div>
                        </div>
                        </div>
                    <button type="submit" form="formsearch" class="btn btn-lg shadow btnPesquisa">Procurar ✓</button>
        </div>

        </form>
    </div>

    <div class="divtable accordion-xs mt-5">
        <div class="tr headings">
            <div style="display:none;" class="th Id">Id</div>
            <div class="th Id">Id</div>
            <div class="th Nome">Nome</div>
            <div class="th Apelido">Apelido</div>
            <div class="th Email">E-mail</div>
            <div class="th Telemovel">Telemóvel</div>
            <div class="th Role">Role</div>
            <div class="th Accoes">Ações</div>
        </div>

        <?php
        if (isset($t)) {
            switch ($t) {
                case ("n"):
                    $type = "nome";

                case ("nome"):
                    $type = "nome";
                    break;

                case ("t"):
                    $type = "telemovel";
                    break;

                case ("a"):
                    $type = "apelido";
                    break;

                case ("e"):
                    $type = "email";
                    break;

                case ("i"):
                    $type = "idUtilizadores";
                    break;
                default:
                    $type = "nome";

            }
        }

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        if (!isset($s)) {
            $query = "SELECT nome, apelido, email, Telemovel, ref_id_roles, idUtilizadores 
                      FROM utilizadores
                      ORDER BY " . $o . " " . $d . "
                      LIMIT ? OFFSET " . $offset;
        } else {
            $search = "%" . $s . "%";
            $query = "SELECT nome, apelido, email, Telemovel, ref_id_roles, idUtilizadores 
                      FROM utilizadores
                      WHERE " . $type . " LIKE ?
                      ORDER BY " . $o . " " . $d . "
                      LIMIT ? OFFSET " . $offset;

        }


        if (mysqli_stmt_prepare($stmt, $query)) {
            if (!isset($s)) {
                mysqli_stmt_bind_param($stmt, "i", $l);
            } else {
                mysqli_stmt_bind_param($stmt, "si", $search, $l);
            }
            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt, $nome_users, $apelido_users, $email_users, $telemovel_users, $role_users, $id_users);
            while (mysqli_stmt_fetch($stmt)) {


                ?>
                <form class="" id="form<?= $id_users ?>" role="form"
                      action="scripts/sc_admin_edit_user.php?id=<?= $id_users ?>" method="post">
                    <div class="tr">
                        <div style="display:none;"
                             class="td Nome accordion-xs-toggle fundo_accordeon"><?=" Nome: " . h($nome_users) . " " . h($apelido_users) ?></div>
                        <div class="accordion-xs-collapse">
                            <div class="inner">
                                <!--<div class="td Id"><?= $id_users ?></div>-->
                                <div class="td Nome"><input class="campo_input" type="text" name="nome"
                                                            value="<?= h($nome_users) ?>">
                                </div>
                                <div class="td Apelido"><input class="campo_input" type="text" name="apelido"
                                                               value="<?= h($apelido_users) ?>"></div>
                                <div class="td Email"><input class="campo_input" type="email" name="email"
                                                             value="<?= h($email_users) ?>"></div>
                                <div class="td Telemovel"><input class="campo_input" type="number" name="telemovel"
                                                                 value="<?= h($telemovel_users) ?>"></div>
                                <div class="td Role"><select type="number" name="role">
                                        <option <?php if ($role_users == 1) echo 'selected'; ?> value="1">
                                            Normal
                                        </option>
                                        <option <?php if ($role_users == 2) echo 'selected'; ?> value="2">Admin
                                        </option>
                                    </select></div>
                                <div class="td Accoes mt-2">
                                    <button class="btn btn-dark" formtarget="_parent" type="submit"
                                            form="form<?= $id_users ?>" id="btn<?= $id_users ?>">
                                        <img src="img/iconografia/edit_branco.png">
                                    </button>
                                    <a class="btn btn-dark"
                                       href="scripts/sc_admin_delete_user.php?id=<?= $id_users ?>">
                                        <img src="img/iconografia/delete_branco.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <?php

            }
        } else {
            echo mysqli_error($link);
        }
        mysqli_stmt_close($stmt);


        $count = mysqli_stmt_init($link);
        if (!isset($search)) {
            $query = "SELECT COUNT(nome) 
                      FROM utilizadores";
        } else {
            $query = "SELECT COUNT(nome) 
                            FROM utilizadores
                            WHERE " . $type . " LIKE ?";
        }
        if (mysqli_stmt_prepare($count, $query)) {
            if (isset($search)) {
                mysqli_stmt_bind_param($count, "s", $search);
            }

            mysqli_stmt_bind_result($count, $c);
            mysqli_stmt_execute($count);
            mysqli_stmt_fetch($count);
            mysqli_stmt_close($count);
        }

        mysqli_close($link);


        $pageN = ceil($c / $l);

        ?>

    </div>
        <nav aria-label="Page navigation example ">
            <ul class="pagination m-auto justify-content-center">
                <?php if ($p == 1) {
                } else { ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin&p=<?= ($p - 1) ?>&o=<?= $o ?>&d=<?= $d ?>&l=<?= $l ?>">Previous</a>
                    </li>
                <?php }


                if ($p >= 3) {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin&p=<?= ($p - 2) ?>&o=<?= $o ?>&d=<?= $d ?>"><?= ($p - 2) ?></a>
                    </li>
                <?php }
                if ($p >= 2) {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin&p=<?= ($p - 1) ?>&o=<?= $o ?>&d=<?= $d ?>"><?= ($p - 1) ?></a>
                    </li>
                <?php } ?>

                <li class="page-item page-link"
                    style="font-weight: bolder; transform: scale(1.2); z-index: 1; color: black;"><?= $p . " <small style=' font-size: 10px; font-weight: lighter;'>/ " . $pageN . "</small>"; ?>
                </li>
                <?php if (($p + 1) <= $pageN) {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin&p=<?= ($p + 1) ?>&o=<?= $o ?>&d=<?= $d ?>"><?= ($p + 1) ?></a>
                    </li> <?php } ?>
                <?php if (($p + 2) <= $pageN) {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin&p=<?= ($p + 2) ?>&o=<?= $o ?>&d=<?= $d ?>"><?= ($p + 2) ?></a>
                    </li> <?php } ?>

                <?php if (($p + 1) <= $pageN) {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin&p=<?= ($p + 1) ?>&o=<?= $o ?>&d=<?= $d ?>">Next</a>
                    </li>
                <?php } ?>

            </ul>
        </nav>


    </div><!-- End of Main Content -->
    <?php
} else {
    header("location: ?page=login");


}

