<?php
if (isset($_GET["feed"])) {
    $msg_show = true;
    switch ($_GET["feed"]) {
        case 0:
            $message = "Ocorreu um erro! ";
            $class = "alert-warning alerta_erro";
            break;
        case 1:
            $message = "Password Incorreta!";
            $class = "alert-warning alerta_erro";
            break;
        case 2:
            $message = "O email já está a ser utilizado!";
            $class = "alert-warning alerta_erro";
            break;
        case 3:
            $message = "Alteração efectuada com sucesso!";
            $class = "alert-success alerta_sucesso";
            break;
        case 4:
            $message = "O Telemovel inserido já está a ser utilizado!";
            $class = "alert-warning alerta_erro";
            break;
        case 5:
            $message = "Não pode eliminar outro admin!";
            $class = "alert-warning alerta_erro";
            break;

        default:
            $msg_show = false;

    }

    if ($msg_show) {
        echo "
<div class=\"alert mt-4 $class alert-dismissible fade show\" role=\"alert\">" . $message . "
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">X</span>
</button>
</div>";
    }
}