<div class="sidebar">
    <button class="btn  btn-link menu-btn" style="float: right;"><i class="material-icons">close</i></a></button>
    <?php

    if (isset($_SESSION["nome_oc"]) && $_SESSION["id_user_oc"]) {
        ?>
        <div class="text-center">
        <div class="figure-menu shadow">
            <figure><img src="img/users/<?= h($_SESSION['user_image_oc'])?>" alt="A sua imagem de perfil"></figure>
        </div>
        <h5 class="mb-1 "><?= h($_SESSION["nome_oc"]) ?></h5>
        <p class="text-mute small"></p>
        </div><?php
    }
    ?>
    <br>
    <div class="row mx-0">
        <div class="col">
            <div class="list-group main-menu">
                <a href="?page=procurarevento" class="list-group-item list-group-item-action"><img src="img/iconografia/lupa_branco.png" style="width: 15px; margin-right: 4px;">
                    <span class="sube">PRO</span>CURAR EVENTOS</a>
                <a href="?page=exposicoes" class="list-group-item list-group-item-action"><img src="img/iconografia/gallery_branco.png" style="width: 15px; margin-right: 4px;">
                    <span class="sube">EXP</span>OSIÇÕES </a>
                <a href="?page=perfil" class="list-group-item list-group-item-action"><img src="img/iconografia/user_branco.png" style="width: 15px; margin-right: 4px;">
                    <span class="sube">PER</span>FIL DE UTILIZADOR</a>
                <a href="?page=desconto" class="list-group-item list-group-item-action"><img src="img/iconografia/delivery_branco.png" style="width: 15px; margin-right: 4px;">
                    <span class="sube">ENT</span>REGA DE REFEIÇÕES</a>
                <a href="?page=contactos" class="list-group-item list-group-item-action"><img src="img/iconografia/phone_branco.png" style="width: 15px; margin-right: 4px;">
                    <span class="sube">CON</span>TACTOS</a>
                <?php
                if (isset($_SESSION["role_oc"]) && $_SESSION["role_oc"] == 2) {
                   echo '<a href="?page=admin_dashboard" class="list-group-item list-group-item-action"><img src="img/iconografia/admin_branco.png" style="width: 15px; margin-right: 4px;">
                    <span class="sube">ADM</span>NISTRAÇÃO</a>';
                }
                if (isset($_SESSION["nome_oc"]) && isset($_SESSION["id_user_oc"])) {
                    echo '<a href = "scripts/sc_logout.php" class="list-group-item list-group-item-action mt-4" ><img src="img/iconografia/logout_branco.png" style="width: 15px; margin-right: 4px;"> Logout</a >';
                } else {
                    echo '<a href = "?page=login" class="list-group-item list-group-item-action mt-4" ><img src="img/iconografia/lock_branco.png" style="width: 15px; margin-right: 4px;"> Login</a >';
                }

                ?>

            </div>
        </div>
    </div>
</div>