<?php

// constroe o mapa bing
function constroe_mapa_bing($latitude, $longitude, $modo){

// modo true o mapa pode aumentar zoom, andar etc
// modo false o mapa é estático

// globals
global $idioma_sistema;

// valida o modo
if($modo == true){
	
	// html
	$html = "
	<div class='classe_mapa_bing'>
	<iframe frameborder=\"0\" src=\"https://www.bing.com/maps/embed/viewer.aspx?v=3&amp;cp=$latitude~$longitude&amp;lvl=11&amp;w=500&amp;h=400&amp;sty=r&amp;typ=d&amp;pp=&amp;ps=&amp;dir=0&amp;mkt=pt-br&amp;src=SHELL&amp;form=BMEMJS\" scrolling='no'></iframe>
	</div>
	";

}else{
	
	// html
	$html = "
	<div class='classe_mapa_bing'>
	<iframe frameborder=\"0\" src=\"https://www.bing.com/maps/embed/viewer.aspx?v=3&amp;cp=$latitude~$longitude&amp;lvl=11&amp;w=500&amp;h=400&amp;sty=r&amp;typ=s&amp;pp=&amp;ps=55&amp;dir=0&amp;mkt=pt-br&amp;src=SHELL&amp;form=BMEMJS\" scrolling='no'></iframe>
	</div>
	";

};

// valida coordenadas
if($latitude == null or $longitude == null){

	// mensagem
	$mensagem[0] = mensagem_erro($idioma_sistema[582]);
	
	// html
	$html = "
	<div class='classe_mapa_bing'>
	$mensagem[0]
	</div>
	";

};

// retorno
return $html;

};

?>