<?php

extract($_REQUEST);
// print_r($_REQUEST);die;

if (file_exists("mensajes.html")) {
	$maxpeso = 7000; //500000;
	$peso =  filesize("mensajes.html");	
	if ($peso>$maxpeso) 
	{
		//echo "vaciando...";
		  $ar=fopen("mensajes.html","w+") or die("Problemas en la creacion");
		  fclose($ar);	
	}
} else {
	  $ar=fopen("mensajes.html","a+") or die("Problemas en la creacion");  
	  fclose($ar);
}


if ($action==1) {
	$ahora = time();
 $tiempo =  date("d/m/Y H:i:s",$ahora);	
  $comentario = "
  <li class='left '>
		<span class='chat-img pull-left'> <img src='images/{$ico}' alt='{$nombre}' class='img-circle' /> </span>
		<div class='chat-body clearfix'>
			<div class='header'>
				<strong class='primary-font'>{$nombre}</strong><small class='pull-right text-muted'> <span class='glyphicon glyphicon-time'></span>{$tiempo}</small>
			</div>
			<p>
				<strong>Mensaje:</strong> {$msj}
			</p>
		</div>
	</li>
    
  ";

  $ar=fopen("mensajes.html","a+") or die("Problemas en la creacion");  
  fputs($ar,$comentario);  
  fclose($ar);


}else if ($action==2){
	
	$archivo = file_get_contents("mensajes.html"); //Guardamos archivo.txt en $archivo
	$archivo = ucfirst($archivo); //Le damos un poco de formato
	$archivo = nl2br($archivo); //Transforma todos los saltos de linea en tag <br/>
	//echo "<strong>Archivo de texto archivo.txt:</strong> ";
	echo '<ul class="chat">'.$archivo.'</u>';


}
	

?>
