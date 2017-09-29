<?php

// separa os dados de url
function separa_dados_data_site($modo, $url){

// modo true retorna sublinks
// modo false não retorna sublinks

// globals
global $codigos_especiais;

// codigo html
$html = obtem_data_url_site($url);

// passando valores iniciais
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');

// obtendo node de elemento html
$title = $nodes->item(0)->nodeValue;

// meta tags
$metas = $doc->getElementsByTagName('meta');

// obtendo dados
for($i = 0; $i < $metas->length; $i++){

	// meta data
	$meta = $metas->item($i);

	if($meta->getAttribute('name') == 'description')
	$description = $meta->getAttribute('content');
	if($meta->getAttribute('name') == 'keywords')
	$keywords = $meta->getAttribute('content');

};

// tipo de tag
$tags = $doc->getElementsByTagName('img');

// imagens
$array_imagens = extrai_imagens_html($html, $url);

// array com imagens
foreach($array_imagens as $url_imagem){
	
	// valida a url de imagem
	if($url_imagem != null){
		
		// atualiza a lista de imagens
		$lista_imagens .= $url_imagem.$codigos_especiais[12];
	
	};

};

// valida modo link
if($modo == true){

	// pegando links
	preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $html, $match);

	// filtrando links
	foreach($match as $link){
		
		// valida link
		if($link != null){
			
			// listando links
			foreach($link as $url){
				
				// valida url
				if($url != null){
					
					// atualizando lista de links
					$lista_links[] = $url;
				
				};
				
			};
			
		};
		
	};

};

// valida a codificação da página
if(converte_minusculo(mb_detect_encoding($description)) == converte_minusculo("UTF-8")){
	
	// codificando para utf-8
	$description = utf8_decode($description);
	$title = utf8_decode($title);
	$keywords = utf8_decode($keywords);
	$lista_links = utf8_decode($lista_links);

};

// codificando para utf-8
$description = mb_convert_encoding($description, 'UTF-8', mb_detect_encoding($description, 'UTF-8, ISO-8859-1', true));
$title = mb_convert_encoding($title, 'UTF-8', mb_detect_encoding($title, 'UTF-8, ISO-8859-1', true));
$keywords = mb_convert_encoding($keywords, 'UTF-8', mb_detect_encoding($keywords, 'UTF-8, ISO-8859-1', true));
$lista_links = mb_convert_encoding($lista_links, 'UTF-8', mb_detect_encoding($lista_links, 'UTF-8, ISO-8859-1', true));

// array de retorno
$array_retorno['titulo'] = $title;
$array_retorno['descricao'] = $description;
$array_retorno['keywords'] = $keywords;
$array_retorno['lista_imagens'] = $lista_imagens;
$array_retorno['lista_links'] = $lista_links;

// retorno
return $array_retorno;

};


?>