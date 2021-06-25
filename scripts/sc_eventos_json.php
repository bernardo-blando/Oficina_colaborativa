<?php

require_once "../connections/connection.php";


$link = new_db_connection();

$stmt = mysqli_stmt_init($link);

$query = "SELECT `idWorkshops`, `nome_workshop`, `ref_professor_principal`, `Comentarios_idComentarios`, `oficinas_idOficinas`, `estado`, `data_inicio`, `data_fim`, `ref_idCategorias` FROM `workshops`";

$return_arr =  array();
if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_workshop, $nome_workshop, $id_prof, $id_coment, $id_oficina, $state,$date_begin,$date_end,$id_cat);
    while (mysqli_stmt_fetch($stmt)) {

        $phpdatebegin = strtotime( $date_begin );
        $phpdatefinish= strtotime( $date_end );
        $DiaInicio = date( 'd', $phpdatebegin );
        $MesInicio = date( 'm', $phpdatebegin );
        $AnoInicio = date( 'Y', $phpdatebegin );
        $HorasInicio = date( 'H:i:s', $phpdatebegin );
        $HorasFim = date( 'H:i:s', $phpdatefinish);
        $row_array['idevent'] = $id_workshop;
        $row_array['occasion'] = $nome_workshop;
        $row_array["horasstart"] = $HorasInicio;
        $row_array["horasfinish"] =  $HorasFim;
        $row_array["year"] =  $AnoInicio;
        $row_array["month"] =   $MesInicio;
        $row_array["day"] =  $DiaInicio;
        $row_array["cancelled"] =  $state;
        $row_array["space"] = $id_cat;



        array_push($return_arr,$row_array);
    }




    $coise = json_encode($return_arr);

   print_r ($coise);
    /*file_put_contents('../js/agenda.json', $json_data);*/


} else {
    echo mysqli_error($link);
}
mysqli_stmt_close($stmt);
mysqli_close($link);

?>
