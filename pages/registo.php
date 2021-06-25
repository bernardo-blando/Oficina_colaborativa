<div class="row no-gutters vh-100 proh bg-template">
        <img src="img/apple.png" alt="logo" class="apple right-image align-self-center">
        <div class="col align-self-center px-3  text-center">
            <img src="img/logo.png" alt="logo" class="mt-3 logo-small">
          
            <form class="form-signin" method="post" action="scripts/sc_registo.php">
                 <div class="form-group float-label">
                    <input type="text" class="form-control" name="nome" required  >
                    <label class="form-control-label">Nome	</label>
                </div>
				
				<div class="form-group float-label">
                    <input type="text" class="form-control" name="apelido" required  >
                    <label class="form-control-label">Apelido	</label>
                </div>

				<div class="form-group float-label">
                    <input type="text" name="telemovel" class="form-control" required  >
                    <label class="form-control-label">Telemóvel	</label>
                    <?php
                    if(isset($_GET["msg"])) {
                        if ($_GET["msg"] == 3) {
                            echo "<span class='red-warning'> O telemóvel inserido já existe! </span>";
                        }
                    }
                    ?>
                </div>
                <div class="form-group float-label">
                    <input type="email" id="inputEmail" name="email" class="form-control" required>
                    <label for="inputEmail" class="form-control-label">E-mail</label>
                    <?php
                    if(isset($_GET["msg"])) {
                        if ($_GET["msg"] == 4) {
                            echo "<span class='red-warning'> O e-mail inserido já existe! </span>";
                        }
                    }
                    ?>
                </div>

                <div class="form-group float-label">
                    <input type="password" id="inputPassword" name="password" class="form-control" required>
                    <label for="inputPassword" class="form-control-label">Password</label>
                </div>

                <div class="form-group float-label">
                    <input type="password" id="inputPassword" name="password_verify" class="form-control" required>
                    <label for="inputPassword" class="form-control-label">Confirma a Password</label>
                    <?php
                    if(isset($_GET["msg"])) {
                        if ($_GET["msg"] == 0) {
                            echo "<span class='red-warning'> As passwords não correspondem! </span>";
                        }
                    }
                    ?>
                </div>

                <div class="form-group my-4 text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="rememberme">
                        <label class="custom-control-label" for="rememberme">Concordo com os <a style="color: none!important" href="#">Termos e Condições</a></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-lg3 btn-default ">Concluir registo</button>
                    </div>
                </div>
            </form>
            <p class="text-center text-black">
                Já tens conta?<br>
                <a href="?page=login">Log In</a>
            </p>
        </div>
    </div>



 