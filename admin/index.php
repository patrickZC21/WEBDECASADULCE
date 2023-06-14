<?php session_start(); 
include "../conex.php"; $hide="hide";$hide2="hide";$hide3="hide";
$bandera=false;

$_SESSION["nombre_web"]="";


$informativos=mysqli_fetch_array(mysqli_query($link,"select * from _informativos where id=1")); 
if (array_key_exists("cerrar", $_GET)) {
    unset($_SESSION['id_usuario_ADM']);
    unset($_SESSION['ADM_user_name']);unset($_SESSION['ADM_tipo_usuario']);
    session_destroy();
   ?><script>window.location.href='/admin/';</script><?php
}

$host= $_SERVER["HTTP_HOST"];
if (isset($_POST["btn_olvido"])){
		
		
		$USERS=mysqli_fetch_array(mysqli_query($link,"select * from _usuarios where email like '%".$_POST["password_reset_email"]."%'  and estatus='activo' "));
		
		
		
		$para  = $USERS["email"]; // atención a la coma
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
		$headers .= 'From: Recuperacion contraseña  <'.$informativos["correo1"].'>' . "\r\n";
		$message.=' <html>
					<head>
					<title></title>
				    </head>
					<body >
					<br><br><br><br>
					Hola '.$USERS["nombres"].',  tu contraseña es : <b>'.$USERS["clave"].'</b>
					<br> 
					</b>
					
					<br><br>
					Para mas informacion visita <a href="'.$host.'">'.$host.'</a>
					<br><br>
					 Este e-mail no lleva acentuacion.
					</body>
					</html>
					';
	    mail($para,"Recuperacion contraseña",$message,$headers);	
		$hide3="";

		
}
function securitymax($valores,$link) {
$_Cadena = htmlspecialchars(trim(addslashes(stripslashes(strip_tags($valores)))));
$_Cadena = str_replace(chr(160),"",$valores);
return mysqli_real_escape_string($link,$valores);
}
if (isset($_POST["iniciar_session"])){
	

$minurl = $_POST["signin_username"];
$minurla = str_replace("'", "", $minurl);
$minurlb = str_replace(";", "", $minurla);
$minurlokc = str_replace("\"", "", $minurlb);
$minurlok = securitymax($minurlokc,$link);


$minurl2 = $_POST["signin_password"];
$minurla2 = str_replace("'", "", $minurl2);
$minurlb2 = str_replace(";", "", $minurla2);
$minurlokc2 = str_replace("\"", "", $minurlb2);
$minurlok2 = securitymax($minurlokc2,$link);

	
	$query = mysqli_query($link,"SELECT * FROM `_usuarios` WHERE login ='".$minurlok."' and clave='".($minurlok2)."' and estatus='activo' ") or die(mysqli_error());
	
      
		$filas=mysqli_num_rows($query);
        if ($filas>0) {
              $result = mysqli_fetch_array($query);
			$_SESSION["id_usuario_ADM"]= $result["id"];
			$_SESSION['ADM_user_name']=$result["nombres"];$_SESSION['ADM_tipo_usuario']=$result["tipo_usuario"];
			
			$hide2="";
			?>
           
            <script>
setTimeout(function(){
  window.location = "home.php";
}, 4000);
</script>
            <?php
        } else {
	
						
						$hide="";
                
                // header("location:index.php") ;   
		}
		
		
		
	}
$informativos=mysqli_fetch_array(mysqli_query($link,"select * from _informativos where id=1")); 
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="es" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?= $informativos["nombre_pagina"] ?> :: Panel Administrativo</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Panel Administrativo de Sistema de Pedidos con QR." name="description" />
	<meta content="Mi P&aacute;gina Web Per&uacute;" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/icon/themify-icons/themify-icons.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/loader/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="inverse-mode">
	<!-- BEGIN #page-container -->
	<div id="page-container">
		<!-- BEGIN login -->
        <div class="login">
			<!-- BEGIN login-cover -->
			<?php if($informativos["fotoB"]==''){?>
							
<style>
			.login-cover {
    background: url(assets/img/login-cover.jpg) center center no-repeat fixed;
    background-size: auto;
    position: fixed;
}
</style>
							 
							
							<?php }else{?>
							<style>
			.login-cover {
    background: url(../images/<?=$informativos["fotoB"]?>) center center no-repeat fixed;
    background-size: auto;
    position: fixed;
}
			</style>
							
							<?php } ?>
			
			
			<div class="login-cover"></div>
			<!-- END login-cover -->
			<!-- BEGIN login-content -->
			<div class="login-content">
				<!-- BEGIN login-brand -->
				<div class="login-brand text-center">
					<a href="/"><img src="<?= URL ?>/images/<?= $informativos["logo"] ?>" alt="" width="240" height="86"></a>
				</div>
				<!-- END login-brand -->
				<!-- BEGIN login-desc -->
				<div class="login-desc">
					Bienvenid@, Ingresa tus Accesos
				</div>
				<!-- END login-desc -->
				<!-- BEGIN login-form -->
				<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST" name="login_form">
					<div class="form-group">
						<label class="control-label">Usuario</label>
						<input type="text" name ="signin_username" class="form-control" value="" />
					</div>
					<div class="form-group">
						<label class="control-label">Contrase&ntilde;a</label>
						<input type="password" name="signin_password" class="form-control" value="" />
					</div>
					
					<button type="submit" name="iniciar_session" class="btn btn-primary">Ingresar</button>
				</form>
				<br>
				
				<div class="alert alert-danger alert-dark <?=$hide?>">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong>Error!</strong>  al iniciar sesion , ingresa nuevamente tus accesos.
						</div>
                         <div class="alert alert-success alert-dark <?=$hide2?>">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong>Perfecto!</strong>  En breve ser&aacute;s redireccionado a la p&aacute;gina principal
						</div>
                         <div class="alert alert-success alert-dark <?=$hide3?>">
							<button type="button" class="close" data-dismiss="alert">x</button>
							<strong>Se ha enviado la solicitud!</strong>  revisa tu email.
						</div>
				<!-- END login-form -->
				
			</div>
			<!-- END login-content -->
        </div>
        <!-- END login -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="ti-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #page-container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/cookie/js/js.cookie.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugins/scrollbar/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>

</body>
</html>
