<?php

// extrai as imagens de codigo html
function extrai_imagens_html($html, $url_site){

// array com imagens
$array_imagens = array();
$array_retorno = array();

// contador
$contador = 0;

// obtendo lista de imagens
if(preg_match_all('/<img\s+.*?src=[\"\']?([^\"\' >]*)[\"\']?[^>]*>/i',$html,$matches,PREG_SET_ORDER)){

	// procurando imagens...
	foreach($matches as $match){
	
		// atualizando array de retorno
		array_push($array_imagens, array($match[1], $match[2]));
		
	};
};

// extraindo imagens...
foreach($array_imagens as $url){
	
	// valida url
	if(is_array($url) == true){
		
		// valida se url é um array
		foreach($url as $endereco_imagem){

			// valida endereco de imagem
			if($endereco_imagem != null){
				
				// valida limit
				if($contador >= NUMERO_IMAGENS_CAMPO_CONTEUDO_URL){
					
					// saindo...
					break;
					
				};

				// completa a url de imagem
				$endereco_imagem = completa_url_imagem($endereco_imagem, $url_site);

				// atualiza o array de retorno
				$array_retorno[] = $endereco_imagem;
				
				// atualiza contador
				$contador++;

			};
			
		};
		
	};
	
};

// retorno
return $array_retorno;

};

?>