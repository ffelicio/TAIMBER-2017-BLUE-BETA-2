<?php

// carrega a lista de albuns de imagens
function carrega_lista_albuns_imagens($modo){

// modo 1 albuns de publicações
// modo 2 albuns que não são de publicações e nem de páginas
// modo 3 albuns de pagina, publicações e do usuário

// globals
global $tabela_banco;
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;

// tabela
$tabela = $tabela_banco[4];

// id de usuario via requeste
$uid = retorne_idusuario_request();

// limit de query
$limit_query = "limit 1";

// valida o modo
switch($modo){

	case 1:
	$query[0] = "select *from $tabela where uid='$uid' and modo_chat='0' and chave!='' and pagina='' order by id desc $limit_query;";
	$query[1] = "select *from $tabela where uid='$uid' and modo_chat='0' and chave!='' and pagina='' order by id desc;";
	break;
	
	case 2:
	$query[0] = "select *from $tabela where uid='$uid' and modo_chat='0' and chave='' and pagina='' order by id desc $limit_query;";
	$query[1] = "select *from $tabela where uid='$uid' and modo_chat='0' and chave='' and pagina='' order by id desc;";
	break;
	
	case 3:
	$query[0] = "select *from $tabela where uid='$uid' and modo_chat='0' order by id asc $limit_query;";
	$query[1] = "select *from $tabela where uid='$uid' and modo_chat='0' order by id asc;";
	break;
	
};

// dados de query
$dados = retorne_dados_query($query[0]);

// separando os dados
$id = $dados["id"];
$pagina = $dados[PAGINA];
$chave = $dados[CHAVE];
$url_host_thumbnail = $dados[URL_HOST_THUMBNAIL];

// numero de imagens
$numero_imagens = retorne_numero_linhas_query($query[1]);

// valida id
if($id != null){

	// numero de imagens
	$numero_imagens_tamanho = retorne_tamanho_resultado($numero_imagens);
	
	// valida o modo
	switch($modo){

		case 1:

		// texto
		$texto[0] = $idioma_sistema[597].retorne_nome_usuario(true, $uid)." - ($numero_imagens_tamanho)";

		// urls
		$url[0] = $pagina_inicial."?$variavel_campo[5]=$uid&$variavel_campo[2]=7&$variavel_campo[58]=1";

		break;
		
		case 2:

		// texto
		$texto[0] = $idioma_sistema[598].retorne_nome_usuario(true, $uid)." - ($numero_imagens_tamanho)";

		// urls
		$url[0] = $pagina_inicial."?$variavel_campo[5]=$uid&$variavel_campo[2]=7&$variavel_campo[58]=0";

		break;
		
		case 3:

		// texto
		$texto[0] = $idioma_sistema[600].retorne_nome_usuario(true, $uid)." - ($numero_imagens_tamanho)";

		// urls
		$url[0] = $pagina_inicial."?$variavel_campo[5]=$uid&$variavel_campo[2]=7&$variavel_campo[58]=2";

		break;
		
	};
	
	// links
	$link[0] = "<a href='$url[0]' title='$texto[0]'>$texto[0]</a>";		

	// id de campo
	$idcampo[0] = retorne_idcampo_md5();

	// proprieades css
	$propriedade_css[0] = "

	background-image: url(\"$url_host_thumbnail\");
	background-size: cover;
	background-repeat: no-repeat;
	background-position: 50% 50%;

	";

	// css
	$css[0] = constroe_css_manual(null, $idcampo[0], $propriedade_css[0]);

	// html
	$html = "
	<div class='classe_separador_albuns_usuario' id='$idcampo[0]'>

	<div class='classe_separador_albuns_usuario_texto'>
	$link[0]
	</div>

	</div>
	
	$css[0]
	";

};

// retorno
return $html;

};

?>