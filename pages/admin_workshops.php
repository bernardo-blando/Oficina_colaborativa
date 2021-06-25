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
            $t = "n";
        }
    } else {
        if (isset($_GET["t"])) {
            if ($_GET["t"] == "i" || $_GET["t"] == "n" || $_GET["t"] == "a" || $_GET["t"] == "e" || $_GET["t"] == "t") {
                $t = $_GET["t"];

            } else {
                $t = "n";
            }
        }
    } //search type

    if (isset($_POST["o"])) {                                                               //order
        if ($_POST["o"] == "n" || $_POST["o"] == "d" || $_POST["o"] == "ins" || $_POST["o"] == "s" || $_POST["o"] == "i" || $_POST["o"] == "c") {
            switch ($_POST["o"]) {
                case ("n");
                    $o = "nome_workshop";
                    break;
                case ("ins");
                    $o = "nome";
                    break;
                case ("i");
                    $o = "idWorkshops";
                    break;
                case ("s");
                    $o = "estado";
                    break;
                case ("d");
                    $o = "data_inicio";
                    break;
                case ("c");
                    $o = "ref_idCategorias";
                    break;
            }
        } else {
            $o = "idUtilizadores";
        }
    } else {
        if (isset($_GET["o"])) {
            if ($_GET["o"] == "n" || $_GET["o"] == "d" || $_GET["o"] == "ins" || $_GET["o"] == "s" || $_GET["o"] == "i" || $_GET["o"] == "c") {
                switch ($_GET["o"]) {
                    case ("n");
                        $o = "nome_workshop";
                        break;
                    case ("ins");
                        $o = "nome";
                        break;
                    case ("i");
                        $o = "idWorkshops";
                        break;
                    case ("s");
                        $o = "estado";
                        break;
                    case ("d");
                        $o = "data_inicio";
                        break;
                    case ("c");
                        $o = "ref_idCategorias";
                        break;
                }
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

    <div>
        <form id="formsearch" action="?page=admin_workshops" method="post">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                <input class="form-control pesquisar" type="search" style="border: 2px solid black"
                                       name="s" placeholder="Procurar" <?php if (isset($s)) {
                                    echo 'value="' . $s . '"';
                                } ?>></a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="panel-body textAlign">
                            <label>Procurar por:</label><select name="t" class="form-control pesquisar">
                                <option <?php if (isset($t)) {
                                    if ($t == "n") {
                                        echo "selected";
                                    }
                                } else {
                                    echo "selected";
                                } ?> value="n">Nome do Workshop
                                </option>
                                <option <?php if (isset($t)) {
                                    if ($t == "ins") {
                                        echo "selected";
                                    }
                                } ?> value="ins">Instrutor
                                </option>

                                <option <?php if (isset($t)) {
                                    if ($t == "i") {
                                        echo "selected";
                                    }
                                } ?> value="i">Id
                                </option>

                                <option <?php if (isset($t)) {
                                    if ($t == "d") {
                                        echo "selected";
                                    }
                                } ?> value="d">Data
                                </option>

                                <option <?php if (isset($t)) {
                                    if ($t == "c") {
                                        echo "selected";
                                    }
                                } ?> value="c">Categoria
                                </option>

                                <option <?php if (isset($t)) {
                                    if ($t == "s") {
                                        echo "selected";
                                    }
                                } ?> value="s">Estado
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
                                <option <?php if ($o == "idWorkshops") {
                                    echo "selected";
                                } ?> value="i">Id
                                </option>
                                <option <?php if ($o == "nome_workshop") {
                                    echo "selected";
                                } ?> value="n">Nome
                                </option>
                                <option <?php if ($o == "nome") {
                                    echo "selected";
                                } ?> value="ins">Instrutor
                                </option>
                                <option <?php if ($o == "estado") {
                                    echo "selected";
                                } ?> value="s">Estado
                                </option>
                                <option <?php if ($o == "data_inicio") {
                                    echo "selected";
                                } ?> value="d">Data
                                </option>
                                <option <?php if ($o == "ref_idCategorias") {
                                    echo "selected";
                                } ?> value="c">Categoria
                                </option>
                            </select>

                            <br> <label>Direção:</label>
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

                <button type="submit" form="formsearch" class="btn btn-lg shadow btnPesquisa"> Filtrar</button>
        </form>

    </div><!--form order-->
    <br><br>
    <div class="divtable accordion-xs">
        <div class="tr headings">
            <div style="display:none;" class="th Id">Id</div>
            <div class="th Id">Id</div>
            <div class="th Nome">Nome</div>
            <div class="th Apelido">Instrutor</div>
            <div class="th Email">Dia</div>
            <div class="th Telemovel">Categoria</div>
            <div class="th Role">Estado</div>
            <div class="th Accoes">Ações</div>
        </div>

        <?php
        if (isset($t)) {
            switch ($t) {
                case ("n"):
                    $type = "nome_workshop";

                case ("nome"):
                    $type = "nome_workshop";
                    break;

                case ("u"):
                    $type = "nome";
                    break;

                case ("d"):
                    $type = "data_inicio";
                    break;

                case ("e"):
                    $type = "estado";
                    break;

                case ("i"):
                    $type = "idWorkshops";
                    break;
                default:
                    $type = "nome_workshop";

            }
        }

        $link = new_db_connection();

        $cats = array();
        $stmt11 = mysqli_stmt_init($link);
        $querycat = "SELECT idCategorias, categoria FROM categorias ORDER BY categoria";

        if (mysqli_stmt_prepare($stmt11, $querycat)) {
            mysqli_stmt_execute($stmt11);
            mysqli_stmt_bind_result($stmt11, $idcat, $cat);
            while (mysqli_stmt_fetch($stmt11)) {
                array_push($cats, array($idcat, $cat));
            }

        }else{
            echo mysqli_error($link);
        }
        mysqli_stmt_close($stmt11);

        $stmt = mysqli_stmt_init($link);

        if (!isset($s)) {
            $query = "SELECT idWorkshops, nome_workshop, nome, apelido, estado, data_inicio, description, categoria 
                      FROM workshops
                      INNER JOIN utilizadores ON ref_professor_principal=idUtilizadores
                      INNER JOIN categorias ON ref_idCategorias = idCategorias                      
                      ORDER BY " . $o . " " . $d . "
                      LIMIT ? OFFSET " . $offset;
        } else {
            $search = "%" . $s . "%";
            $query = "SELECT idWorkshops, nome_workshop, nome, apelido, estado, data_inicio, description, categoria 
                      FROM workshops
                      INNER JOIN utilizadores ON ref_professor_principal=idUtilizadores
                      INNER JOIN categorias ON ref_idCategorias = idCategorias   
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

            mysqli_stmt_bind_result($stmt, $id_w, $nome_w, $instrutor, $apelido, $estado, $inicio, $description, $categoria);
            while (mysqli_stmt_fetch($stmt)) {

                ?>
                <form id="form<?= $id_w ?>" role="form"
                      action="scripts/sc_admin_edit_workshop.php?id=<?= $id_w ?>" method="post">
                    <div class="tr">
                        <div style="display:none; background-color: #2c2d2d;"
                             class="td Nome accordion-xs-toggle"><?= "<span style='color:black;'></span><span style='color:#FFC62B;'>Workshop:</span> " . h($nome_w) . " <br><span style='color:#FFC62B;'>Data:</span> " . h($inicio) ?></div>
                        <div class="accordion-xs-collapse">
                            <div class="inner">
                                <div class="td Nome"><input class="campo_input"  type="text" name="nome"
                                                            value="<?= h($nome_w) ?>">
                                </div>
                                <div class="td Description"><input class="campo_input"  type="text" name="description"
                                                                   value="<?= h($description) ?>">
                                </div>
                                <div class="td Instrutor"><?= h($instrutor . " " . $apelido) ?></div>
                                <div class="td Data mt-1"><input class="campo_input"  type="text" name="data"
                                                            value="<?= h($inicio) ?>"></div>

                                <div class="td Categoria">
                                    <select type="text" name="categoria">
                                        <?php
                                        for ($i=0; $i< count($cats); $i++){
                                            echo "<option  ";
                                            if ($cats[$i][1]==$categoria){echo "selected ";}
                                            echo "value='". $cats[$i][0]."'>".$cats[$i][1]."</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="td Estado mt-2"><select type="text" name="estado">
                                        <option <?php if ($estado == "Ativo") {
                                            echo 'selected';
                                        } ?> value="Ativo">
                                            Ativo
                                        </option>
                                        <option <?php if ($estado == "Pendente") {
                                            echo 'selected';
                                        } ?> value="Pendente">Pendente
                                        </option>
                                        <option <?php if ($estado == "Cancelado") {
                                            echo 'selected';
                                        } ?> value="Cancelado">Cancelado
                                        </option>
                                    </select></div>
                                <div class="td Accoes mt-2">
                                    <button class="btn btn-dark" formtarget="_parent" type="submit"
                                            form="form<?= $id_w ?>" id="btnw<?= $id_w ?>">
                                        <img src="img/iconografia/edit_branco.png">
                                    </button>
                                    <a class="btn btn-dark"
                                       href="scripts/sc_admin_delete_workshop.php?id=<?= $id_w ?>">
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
            $query = "SELECT COUNT(idWorkshops) 
                      FROM workshops";
        } else {
            $query = "SELECT COUNT(idWorkshops) 
                            FROM workshops
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


        <nav aria-label="Page navigation example ">
            <ul class="pagination m-auto justify-content-center">
                <?php if ($p == 1) {
                } else { ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin_workshops&p=<?= ($p - 1) ?>&o=<?= $o ?>&d=<?= $d ?>&l=<?= $l ?>">Previous</a>
                    </li>
                <?php }


                if ($p >= 3) {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin_workshops&p=<?= ($p - 2) ?>&o=<?= $o ?>&d=<?= $d ?>"><?= ($p - 2) ?></a>
                    </li>
                <?php }
                if ($p >= 2) {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin_workshops&p=<?= ($p - 1) ?>&o=<?= $o ?>&d=<?= $d ?>"><?= ($p - 1) ?></a>
                    </li>
                <?php } ?>

                <li class="page-item page-link"
                    style="font-weight: bolder; transform: scale(1.2); z-index: 1; color: black;"><?= $p . " <small style=' font-size: 10px; font-weight: lighter;'>/ " . $pageN . "</small>"; ?>
                </li>
                <?php if (($p + 1) <= $pageN) {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin_workshops&p=<?= ($p + 1) ?>&o=<?= $o ?>&d=<?= $d ?>"><?= ($p + 1) ?></a>
                    </li> <?php } ?>
                <?php if (($p + 2) <= $pageN) {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin_workshops&p=<?= ($p + 2) ?>&o=<?= $o ?>&d=<?= $d ?>"><?= ($p + 2) ?></a>
                    </li> <?php } ?>

                <?php if (($p + 1) <= $pageN) {
                    ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=admin_workshops&p=<?= ($p + 1) ?>&o=<?= $o ?>&d=<?= $d ?>">Next</a>
                    </li>
                <?php } ?>

            </ul>
        </nav>


    </div><!-- End of Main Content -->
    <?php
} else {
    header("location: ?page=login");


}

