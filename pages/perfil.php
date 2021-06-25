<?php
if (isset($_SESSION["nome_oc"])&&isset($_SESSION["id_user_oc"])&&isset($_SESSION["role_oc"])){

?>
   <div class="container-fluid ">
      <div class="row no-gutters">

<?php
$id=$_SESSION["id_user_oc"];
require_once "connections/connection.php";
$link=new_db_connection();
$stmt=mysqli_stmt_init($link);
$query="SELECT nome, apelido, user_image, email FROM utilizadores
WHERE idUtilizadores =".$id;

if (mysqli_stmt_prepare($stmt, $query)){

    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nome, $apelido, $imagem, $email);
    mysqli_stmt_fetch($stmt);


}else{
    echo mysqli_error($link);
}
mysqli_stmt_close($stmt);
mysqli_close($link);
          ?>
         <div class="col-6">
            <div style="margin-bottom: 34px; border:none!important;" class="figure-profile">
               <figure><img src="img/users/<?php echo h($imagem)?>" class="img-fluid" alt=""></figure>
            </div>
         </div>
         <div class="col-6">
            <div class="card-block text-center">
               <br>
               <h4 class="card-title text-uppercase mt-3 "><?php echo h($nome)." ".h($apelido);?></h4>
               <button type="button" data-toggle="modal" data-target="#editprofile" class="btn btn-xs btn-default" style="height: 40px;"><img src="img/iconografia/edit-user_cinza.png" style="margin: 4px 0 4px 0;"><span>  editar perfil</span></button>
            </div>
         </div>
         <br>
         <div class="col-12 col-xs-12 mt-n5">
            <div style=" min-height: 60vh!important; margin-top: 30px;" class="card">
               <div class="card-header p-0">
                  <ul style="" class="nav nav-tabs tabs-md nav-justified profile-tab" role="tablist">
                     <li role="presentation" class="nav-item">
                        <a href="#step13" class="nav-link active" data-toggle="tab" aria-controls="step13" role="tab" title="Step 1" style="font-size: large;">Eventos</a>
                     </li>
                     <li role="presentation" class="nav-item">
                        <a href="#step23" class="nav-link " data-toggle="tab" aria-controls="step23" role="tab" title="Step 2" style="font-size: large;">Favoritos</a>
                     </li>
                     <li role="presentation" class="nav-item">
                        <a href="#step33" class="nav-link " data-toggle="tab" aria-controls="step33" role="tab" title="Step 3" style="font-size: large;">Histórico</a>
                     </li>
                  </ul>
               </div>
               <div class="card-body" style="background-color: #2C2D2D!important;">
                  <div class="tab-content">
                     <div class="tab-pane active" role="tabpanel" id="step13">
						 <a href="home.php" class="btn btn-xs btn-default float-right" style="height: 40px;"><i style="font-size: 27px;" class="material-icons">add</i> <span>Criar evento</span></a>
						 <br>
						 <br>
						<div class="card mt-2">
                           <div class="card-body">
                              <div class="row no-gutters">
                                 <div class="col-8">
                                    <h5 class="card-title">Explicações de PHP</h5>
                                     <p>10H00 | 4 Junho 2020</p>
									Mercado de Santiago
                                 </div>
                                <div class="col-2">
                                    <a href="" class="btn"><img style="width: 50px !important;" src="img/iconografia/share_cinza.png"></a>
                                 </div>
								  <div class="col-2	">
                                    <a href="" class="btn"><img src="img/iconografia/delete_cinza.png"></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" role="tabpanel" id="step23">
                        <div class="card">
                           <div class="card-body card_perfil_user">
                              <div class="row no-gutters">
                                 <div class="col-10">
                                    <h5 class="card-title">WORKSHOP CULINÁRIA</h5>
                                    18H00 - Mercado de Santiago 
                                 </div>
                                <div class="col-2">
                                    <a href="" class="btn"><img src="img/iconografia/delete_cinza.png"></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" role="tabpanel" id="step33">
                      <div class="card">
                           <div class="card-body">
                              <div class="row no-gutters">
                                 <div class="col-12">
                                    <h5 class="card-title">Explicações Javascript</h5>
                                    <p>18H00 | 12 Fevereiro 2020</p>
									Mercado de Santiago
                                 </div>
                               </div>
                           </div>
                        </div>
						<br>
						<div class="card">
                           <div class="card-body">
                              <div class="row no-gutters">
                                  <div class="col-12">
                                    <h5 class="card-title">Repair Café</h5>
                                     <p>15H00 | 21 Fevereiro 2020
									Mercado de Santiago
                                 </div>
                              </div>
                           </div>
                        </div>
					</div>
                     <div class="clearfix"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php
}else {
    include_once "erro.php";
}

