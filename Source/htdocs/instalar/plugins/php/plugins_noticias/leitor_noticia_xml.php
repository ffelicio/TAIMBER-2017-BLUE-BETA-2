<?php

function leitor_noticia_xml($numero_feeds, $cadastrar){

// globals
global $url_feed_html;

// contador de feeds
$contador_feeds = 0;

// listando urls de feeds no formato html
foreach($url_feed_html as $url_feed){
	
	// valida url feed
	if($url_feed != null){

		// carregando xml
		$news = simplexml_load_file($url_feed);

		// array com feeds
		$feeds = array();

		// carregando e analisando feeds
		foreach ($news->channel->item as $item){
			
			// separando itens
			preg_match('@src="([^"]+)"@', $item->description, $match);
			
			// separando por partes
			$parts = explode('<font size="-1">', $item->description);

			// separndo titulo, link etc
			$titulo = (string) $item->title;
			$link = (string) $item->link;
			$imagem = $match[1];
			$site_title = strip_tags($parts[1]);
			$conteudo = strip_tags($parts[2]);
			$date = (string) $item->pubDate;
			
			// adicionando url em imagem
			$imagem = str_ireplace("//", "http://", $imagem);
			
			// convertendo em tag de imagem
			$imagem = "<img src='$imagem'>";
			
			// adiciona a url da imagem no conteudo
			$conteudo .= $imagem;

			// valida cadastrar noticia
			if($cadastrar == true){
			
				// cadastrando notocia
				cadastra_noticia($titulo, $link, $conteudo, $date);
		
			};

			// valida contador de feeds
			if($contador_feeds < $numero_feeds){
			
				// montando a noticia
				$html .= monta_noticia($link, $titulo, $conteudo, $date);
			
				// atualiza contador de feeds
				$contador_feeds++;
			
			};

		};

	};
	
};

// retorno
return $html;

};

?>