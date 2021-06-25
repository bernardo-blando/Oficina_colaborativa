<div class="footer">
    <div class="no-gutters">
        <div class="col-12 mx-auto">
            <div class="row no-gutters justify-content-center">
                <div class="col-3">
                    <a href="?page=home" class="btn btn-link-default m-auto active">
                        <?php
                        if ($_GET["page"] == 'home') {
                            echo '<img id="icons" src="img/iconografia/home_cinza.png">';

                        } else {
                            echo '<img id="icons" src="img/iconografia/home_outline.png">';

                        }
                        ?>

                    </a>
                </div>
                <div class="col-3">
                    <a href="?page=desconto" class="btn btn-link-default m-auto">
                        <?php
                        if ($_GET["page"] == 'desconto') {
                            echo '<img id="icons" src="img/iconografia/uber_cinza.png">';

                        } else {
                            echo '<img id="icons" src="img/iconografia/uber_outline.png">';

                        }
                        ?>


                    </a>
                </div>
                <div class="col-3">
                    <a href="?page=agenda" class="btn btn-link-default m-auto">
                        <?php
                        if ($_GET["page"] == 'agenda') {
                            echo '<img id="icons" src="img/iconografia/calendar_cinza.png">';

                        } else {
                            echo '<img id="icons" src="img/iconografia/calendar_outline.png">';
                        }
                        ?>

                    </a>
                </div>
                <div class="col-3">
                    <a href="?page=perfil" class="btn btn-link-default m-auto">
                        <?php
                        if ($_GET["page"] == 'perfil') {
                            echo '<img id="icons" src="img/iconografia/user_cinza.png">';

                        } else {
                            echo '<img id="icons" src="img/iconografia/user_outline.png">';

                        }
                        ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>