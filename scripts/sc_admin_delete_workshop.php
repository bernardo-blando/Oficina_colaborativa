<?php
session_start();
if ($_SESSION["role_oc"] == 2) {
    if (isset($_GET["id"])) {
        require_once "../connections/connection.php";
        $id = $_GET["id"];





            $link = new_db_connection();
            $stmtdel = mysqli_stmt_init($link);
            $querydel = "DELETE FROM workshops
            WHERE idWorkshops = ?";


            if (mysqli_stmt_prepare($stmtdel, $querydel)) {
                mysqli_stmt_bind_param($stmtdel, "i", $id);

                if (mysqli_stmt_execute($stmtdel)) {
                    mysqli_stmt_close($stmtdel);
                    mysqli_close($link);
                    header("location: ../index.php?page=admin_workshops&feed=3");
                } else {
                    mysqli_stmt_close($stmtdel);
                    mysqli_close($link);
                    header("location: ../index.php?page=admin_workshops&feed=0");
                }

            } else {
                echo "<p>" . mysqli_error($link) . "</p>";
            }
            mysqli_stmt_close($stmtdel);
            mysqli_close($link);





    } else {
        header("location: ../index.php?page=admin_workshops&feed=0");
    }


} else {
    //longe daqui.php
    header("Location: https://www.google.com/search?safe=active&sxsrf=ALeKk02w6485cu9yTjHREnyWNS41NHV7kg%3A1590826291972&source=hp&ei=MxXSXrz2OMisa8KLtrgK&q=longe+daqui&oq=longe+daqui&gs_lcp=CgZwc3ktYWIQAzICCAAyAggAMgUIABDLATIFCAAQywEyBQgAEMsBMgUIABDLATICCAAyAggAMgYIABAWEB4yBggAEBYQHjoECCMQJzoFCAAQgwFQsAZY_CNg1SpoAXAAeACAAXmIAeQIkgEDOS4zmAEAoAEBqgEHZ3dzLXdpeg&sclient=psy-ab&ved=0ahUKEwj8257gkdvpAhVI1hoKHcKFDacQ4dUDCAY&uact=5 ");
}
