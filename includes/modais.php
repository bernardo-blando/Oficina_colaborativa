<!--EDITAR PERFIL MODAL -->
<div id="editprofile" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="margin-top: 100px !important;">
            <div class="modal-header my-auto" style="background-color: #2c2d2d; color: white;">
                <h4 class="modal-title">Edita o teu perfil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="scripts/sc_editar_perfil.php" method="post">
                    <p class="mt-3 mb-1">Nome próprio:</p>
                    <input class="campo_input" type="text" name="nome" value="<?php echo h($nome); ?>">
                    <p class="mt-3 mb-1">Apelido:</p>
                    <input class="campo_input" type="text" name="apelido" value="<?php echo h($apelido); ?>">
                    <p class="mt-3 mb-1">Email:</p>
                    <input class="campo_input" type="email" name="email" value="<?php echo h($email); ?>">

                    <p class="mt-5 mb-1">Password de Verificação</p>
                    <input class="campo_input" type="password" name="password" placeholder="Password">

            </div>

            <div class="modal-footer mx-auto">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #BD5943; color: white !important;">Cancelar</button>
                <button type="submit" class="btn btn-default">Submeter</button>

                </form>
            </div>
        </div>

    </div>
</div>