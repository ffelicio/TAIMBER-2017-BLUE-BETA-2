<?php

// constroe os links de navegacao lateral
function constroe_links_navegacao_lateral(){

// globals
global $idioma_sistema;
global $variavel_campo;

// id de usuario
$uid = retorne_idusuario_logado();

// url de index
$url_index[0] = PAGINA_INDEX_INICIO."?".$variavel_campo[5]."=$uid&".$variavel_campo[2];
$url_index[1] = PAGINA_INDEX_INICIO;

// links
$urls[] = "$url_index[1]"; 
$urls[] = "$url_index[0]=2"; 
$urls[] = "$url_index[0]=25"; 
$urls[] = "$url_index[0]=3"; 
$urls[] = "$url_index[0]=9"; 
$urls[] = "$url_index[0]=22"; 
$urls[] = "$url_index[0]=104"; 
$urls[] = "$url_index[0]=90"; 
$urls[] = "$url_index[0]=7"; 
$urls[] = "$url_index[0]=78"; 
$urls[] = "$url_index[0]=82"; 
$urls[] = "$url_index[0]=107"; 
$urls[] = "$url_index[0]=111";

// array com titulos
$array_titulos[] = $idioma_sistema[94];
$array_titulos[] = $idioma_sistema[603];
$array_titulos[] = $idioma_sistema[103];
$array_titulos[] = $idioma_sistema[473];
$array_titulos[] = $idioma_sistema[339];
$array_titulos[] = $idioma_sistema[93];
$array_titulos[] = $idioma_sistema[474];
$array_titulos[] = $idioma_sistema[475];
$array_titulos[] = $idioma_sistema[167];
$array_titulos[] = $idioma_sistema[368];
$array_titulos[] = $idioma_sistema[381];
$array_titulos[] = $idioma_sistema[321];
$array_titulos[] = $idioma_sistema[583];

// contador
$contador = 0;

// construindo links de navegacao
foreach($urls as $url){
	
	// valida url
	if($url != null){

		// titulo
		$titulo = $array_titulos[$contador];
		
		// url
		$url = $urls[$contador];
		
		// atualizando lista
		$lista .= "
		<div class='classe_link_atalho_navegacao_lateral'>
		<a href='$url' title='$titulo'>$titulo</a>
		</div>
		";
		
		// atualizando lista
		$contador++;
		
	};
	
};

// html
$html = "
<div class='classe_links_navegacao_lateral classe_cor_8'>
$lista
</div>
";

// retorno
return $html;

};

?>