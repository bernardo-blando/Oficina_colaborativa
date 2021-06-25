<?php
echo '<br><br><nav class="navbar navbar-expand-lg navbar-light bg-light" ">
    <a class="navbar-brand" href="#"><h3>';

switch ($_GET["page"]) {
    case ("admin"):
        echo "Users";
        break;
    case ("admin_workshops"):
        echo "Workshops";
        break;
    case ("admin_exposicoes"):
        echo "Exposições";
        break;
    case ("admin_dashboard"):
        echo "Dashboard";
        break;
}
 echo '</h3></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">';

        if ($_GET["page"] != "admin_dashboard") {
            echo "<li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"?page=admin_dashboard\">Dashboard</a>
                </li>";
        }
        if ($_GET["page"] != "admin") {
            echo "<li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"?page=admin\">Users</a>
                </li>";
        }
        if ($_GET["page"] != "admin_exposicoes") {
            echo "<li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"#\">Exposições</a>
                </li>";
        }
        if ($_GET["page"] != "admin_workshops") {
            echo "<li class=\"nav-item active\">
                    <a class=\"nav-link\" href=\"?page=admin_workshops\">Workshops</a>
                </li>";
        }

        ?>

    </ul>
</div>
</nav>