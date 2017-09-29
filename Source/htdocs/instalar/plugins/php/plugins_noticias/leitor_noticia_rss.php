<?php

// leitor de noticias via rss
function leitor_noticia_rss($url, $numero_feeds, $cadastrar){

// carregando rss
$rss = new DOMDocument();
$rss->load($url);
$feed = array();

// analisando rss
foreach($rss->getElementsByTagName('item') as $node){
	
	// array com itens de rss
	$item = array(
	'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
	'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
	'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
	'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
	);

	// atualizando array
	array_push($feed, $item);
	
};

// contador de avanco
$contador = 0;

// contador de feeds
$contador_feeds = 0;

// construindo noticias
for($contador == $contador; $contador <= count($feed); $contador++){
	
	// obtendo informações de rss
	$title = str_ireplace(' & ', ' &amp; ', $feed[$contador]['title']);
	$link = $feed[$contador]['link'];
	$description = $feed[$contador]['desc'];
	$date = date('l F d, Y', strtotime($feed[$contador]['date']));

	// valida link
	if($link != null){
		
		// valida cadastrar noticia
		if($cadastrar == true){
			
			// cadastrando notocia
			cadastra_noticia($title, $link, $description, $date);
		
		};
		
		// valida contador de feeds
		if($contador_feeds < $numero_feeds){
			
			// montando a noticia
			$html .= monta_noticia($link, $title, $description, $date);
		
			// atualiza contador de feeds
			$contador_feeds++;
			
		};
		
	};
	
};

// retorno
return $html;

};

?>