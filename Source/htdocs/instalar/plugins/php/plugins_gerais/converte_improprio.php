<?php

// converte palavras impróprias
function converte_improprio($conteudo){

// globals
global $chave_improprio;

// id e usuario logado
$uid = retorne_idusuario_logado();

// palavras chave a serem bloqueadas
$palavras_chave = $chave_improprio.",".retorna_configuracao_privacidade(3, $uid);

// separa as palavras impróprias da lista
$palavras = explode(",", $palavras_chave);

// buscando por palavras impróprias
foreach($palavras as $palavra){

	// valida palavra
	if($palavra != null){
	
		// remove espaco em branco
		$palavra = trim($palavra);
		
		// tooltip de palavrão
		$tooltip = "data-tooltip='$palavra'";
		
		// código para truncar palavrão
		$trunca_palavrao = TRUNCA_PALAVRAO;
		
		// nova palavra chave
		$palavra_chave = " <span class='classe_improprio span_link_3' $tooltip>$trunca_palavrao</span>";
		
		// palavras a serem substituídas
		$palavra_1 = " ".$palavra;
		$palavra_2 = $palavra." ";
		$palavra_3 = " ".$palavra." ";

		// convertendo conteúdo
		$conteudo = str_ireplace($palavra_1, $palavra_chave, $conteudo);
		$conteudo = str_ireplace($palavra_2, $palavra_chave, $conteudo);
		$conteudo = str_ireplace($palavra_3, $palavra_chave, $conteudo);

		// valida se deve substituir a palavra pela palavra chave
		if(converte_minusculo(trim($conteudo)) == converte_minusculo($palavra)){
			
			// convertendo conteúdo
			$conteudo = str_ireplace($palavra, $palavra_chave, $conteudo);

		};

	};

};

// retorna conteúdo
return $conteudo;

};

?>