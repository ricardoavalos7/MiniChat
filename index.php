<!-- 
     MiniChat by ricardoavalos.cl
      <project>
      
      Created by Ricardo Avalos Arias on 2014-12-16.
      Licencia de Creative Commons con Reconocimiento-CompartirIgual 4.0 Internacional License. 
      
      Los iconos usados pertenecen a sus respectivos dueños y solo han sido utilizados como ejemplo.
 -->


<?php

include_once 'routes.php';
$navegacion = new navegacion;
$html = new html();
$archivos = new archivos();
$dir_images = str_replace("ws", '', $ruta) . "images/";
$contend_dir = json_decode($archivos -> contenido_directorio($dir_images, 2), false);

$listado_fotos = array();
foreach ($contend_dir->content as $picfile) {
	$foto = $html -> crea_imagen_unica("./images/{$picfile}");
	$enlace = $html -> crea_link("javascript:load_avatar('{$picfile}');", $foto);
	$listado_fotos[] = $enlace;
}
$galeria = $html -> lista_desordenada_sin_ul($listado_fotos);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Mini Chat by ricardoavalos.cl<</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/galeria.css" rel="stylesheet">
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
		<style>
			.chat {
				list-style: none;
				margin: 0;
				padding: 0;
			}

			.chat li {
				margin-bottom: 0px;
				border-bottom: 1px dotted #B3A9A9;
				height: 100px !important;
				padding-bottom:35px;
				
			}

			.chat li.left .chat-body {
				margin-left: 10px;
				width: 350px;
				max-width: 350px;
			}

			.chat li.right .chat-body {
				margin-right: 60px;
			}

			.chat li .chat-body p {
				margin: 0;
				color: #777777;
				
			}

			.panel .slidedown .glyphicon, .chat .glyphicon {
				margin-right: 5px;
			}

			.panel-body {
				overflow-y: scroll;
				height: 400px;
			}

			::-webkit-scrollbar-track {
				-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
				background-color: #F5F5F5;
			}

			::-webkit-scrollbar {
				width: 12px;
				background-color: #F5F5F5;
			}

			::-webkit-scrollbar-thumb {
				-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
				background-color: #555;
			}
		</style>
	</head>
	<body>
		<div  id="login" align="center">
			<form role="form" class="form-horizontal" align="center">

				<div class="container" align="center">
					<div class="row">
						<div class="col-md-9">
							<div class="panel panel-primary" align="center">
								<div class="panel-heading" >
									<span class="glyphicon glyphicon-comment"></span> Mini Chat by ricardoavalos.cl
									<div class="btn-group pull-right">
										<!-- <a type="button" class="btn btn-default btn-xs" href="#collapseOne"> <span class="glyphicon glyphicon-chevron-down"></span> </a> -->
									</div>
								</div>
								<div class="panel-collapse" id="collapseOne">
									<div class="panel-body" >

										<div class="form-group">
											<label class="col-md-2" for="nombre">Nombre:</label>
											<div class="col-md-10">
												<input type="text" class="form-control loginchat" id="nombre" placeholder="Ingresa el nick con el te conocerán en el chat">
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-2" for="inputTo">Avatar:</label>
											<div class="col-md-10">
												<input type="hidden" id="avatar" name="avatar" value="" />
												<input type="text" class="form-control loginchat" id="personaje" name="personaje"  placeholder="Seleccionar tu avatar" readonly="readonly" >
												<div id="galeria">
													<ul>
														<?=$galeria; ?>
													</ul>
												</div>
											</div>
										</div>

									</div>
									<div class="panel-footer">
										<div class="form-group">

											<div class="col-md-12" align="center">
												<input type="reset" value="limpiar" class="btn btn-default" />
												<input type="button"  onclick="login();" class="btn btn-success" value="Entrar" />
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>

		</div>
		<!--/login-->

		<div id="chat">

			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<div class="panel panel-primary">

							<div class="panel-heading">
								<span class="glyphicon glyphicon-comment"></span> Mini Chat by ricardoavalos.cl
								<div class="btn-group pull-right">
									<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
										<span class="glyphicon glyphicon-chevron-down"></span>
									</button>
									<ul class="dropdown-menu slidedown">
										<li>
											<a href="#" onclick="leer();"><span class="glyphicon glyphicon-refresh"> </span>Refrescar mensajes</a>
										</li>
										<li class="divider"></li>
										<li>
											<a href="#" onclick="salir();"><span class="glyphicon glyphicon-off"></span> Salir</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="panel-collapse " id="collapseOne">
								<div class="panel-body"  id="lista">
									<ul class="chat">
										<!--
										<li class="right clearfix">
										<span class="chat-img pull-right"> <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" /> </span>
										<div class="chat-body clearfix">
										<div class="header">
										<small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
										<strong class="pull-right primary-font">Bhaumik Patel</strong>
										</div>
										<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
										dolor, quis ullamcorper ligula sodales.
										</p>
										</div>
										</li>
										<li class="left clearfix">
										<span class="chat-img pull-left"> <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" /> </span>
										<div class="chat-body clearfix">
										<div class="header">
										<strong class="primary-font">Jack Sparrow</strong><small class="pull-right text-muted"> <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
										</div>
										<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
										dolor, quis ullamcorper ligula sodales.
										</p>
										</div>
										</li>
										<li class="right clearfix">
										<span class="chat-img pull-right"> <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" /> </span>
										<div class="chat-body clearfix">
										<div class="header">
										<small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
										<strong class="pull-right primary-font">Bhaumik Patel</strong>
										</div>
										<p>
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
										dolor, quis ullamcorper ligula sodales.
										</p>
										</div>
										</li> -->
									</ul>
								</div>
								<div class="panel-footer">
									<div class="input-group">
										<div class="col-md-4">
											<img src="" id="usuario_avatar" align="left">
										</div>
										<div class="col-md-8" align="left">
											<h3 id="usuario_nombre"></h3>
											<small id="usuario_personaje"></small>
										</div>
									</div>
									<div class="input-group">
										<div class="col-md-10">
										<input id="btn-input" type="text" class="form-control col-md-10" placeholder="Escribe tu mensaje aquí..." />
										</div>
										<div class="col-md-2">
										<input id="btn-chat"  type="button" class="btn btn-warning col-md-2" value="OK">
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		</div>
		<div align="center">
		<a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Licencia de Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Mini chat AJAX</span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://ricardoavalos.cl" property="cc:attributionName" rel="cc:attributionURL">Ricardo Avalos Arias</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional License</a>.
		</br>
		 Los iconos usados pertenecen a sus respectivos dueños y solo han sido
      utilizados como ejemplo.
</div>
		<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<script>
			$(document).ready(function() {

				$("#btn-chat").on("click", function() {
					enviar();
				});
				$("#btn-input").on("keydown", function(event) {
					validatecla(event);
				});

				cargarContenido();

			});

			var enviar = function() {

				$().ajaxStart(function() {
					$('#loading').show();

				}).ajaxStop(function() {
					$('#loading').hide();

				});

				var mens = $("#btn-input").val();
				var nombre = $("#nombre").val();
				var personaje = $("#personaje").val();
				var icono = $("#usuario_avatar").attr("src");
				icono = icono.replace("images/", "");

				if (mens == "") {
					return false;
				}

				var data = "msj=" + mens + "&nombre=" + nombre + "&personaje=" + personaje + "&ico=" + icono + "&action=1";
				var message = send_ajax(data);

				document.getElementById("btn-input").value = "";
				leer();
				cargarContenido();

			}
			var validatecla = function(e) {
				var tecla;

				if (document.all) {
					tecla = window.event.keyCode || e.keyCode;
				} else {
					tecla = e.which || window.event.which;
				}

				if (tecla == 13) {
					enviar();
					return false;
				}

			}
			var leer = function() {

				$().ajaxStart(function() {
					$('#loading').show();

				}).ajaxStop(function() {
					$('#loading').hide();

				});

				var data = "action=2";
				var message = send_ajax(data);
				if (message !== "") {
					// alert(message);
					$('#lista').html("");
					$('#lista').html(message);
					document.getElementById("lista").scrollTop = 20000;
				}

			}
			var cargarContenido = function() {
				var id = setInterval("leer()", 5000);
			}
			var load_avatar = function(img) {

				var personaje = img.replace("-", " ");
				personaje = personaje.replace(".", "");
				personaje = personaje.replace("gif", "");
				personaje = personaje.replace("png", "");
				personaje = personaje.replace("jpg", "");

				$("#personaje").val(personaje);
				$("#avatar").val(img);

			}
			var login = function() {
				var nombre = $("#nombre").val();
				var avatar = $("#avatar").val();
				var personaje = $("#personaje").val();

				if (nombre == "") {
					alert("Ingresa tu nombre");
					return;
				}
				if (personaje == "") {
					alert("Selecciona tu personaje");
					return;
				}

				$("#usuario_nombre").text(nombre);
				$("#usuario_personaje").text("Alias " + personaje);
				$("#usuario_avatar").attr("src", "images/" + avatar);

				$("#login").fadeOut();
				$("#chat").show("slow");
				leer();

			}
			var send_ajax = function(cadena_datos) {

				return response = $.ajax({
					type : "GET",
					url : "process.php",
					data : cadena_datos,
					async : false
				}).responseText;
			}
			var salir = function() {
				if (confirm("Desea salir del Chat?")) {
					location.reload();
					document.getElementById("nombre").value = "";
					document.getElementById("avatar").value = "";
					document.getElementById("personaje").src = "";
				}
			}

		</script>

	</body>
</html>
