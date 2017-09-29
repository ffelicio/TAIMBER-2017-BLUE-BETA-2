<?php

// carrega a lista de albuns de imagens somente da pagina
function carrega_lista_albuns_imagens_pagina(){

// globals
global $tabela_banco;
global $idioma_sistema;
global $pagina_inicial;
global $variavel_campo;

// tabela
$tabela = $tabela_banco[4];

// id de usuario via requeste
$uid = retorne_idusuario_request();

// valida o numero de paginas de usuario
if(retorne_numero_paginas_usuario($uid) == 0){
	
	// retorno nulo
	return null;
	
};

// query
$query = "select *from $tabela where uid='$uid' and pagina!='' order by id desc;";

// dados de query
$dados_query = plugin_executa_query($query);

// numero de linhas
$linhas = $dados_query["linhas"];

// contador
$contador = 0;

// listando albuns
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados de query
	$dados = $dados_query["dados"][$contador];

	// separando os dados
	$id = $dados["id"];
	$pagina = $dados[PAGINA];
	$chave = $dados[CHAVE];
	$url_host_thumbnail = $dados[URL_HOST_THUMBNAIL];

	// valida id e evita duplicatas
	if($id != null and $pagina_anterior != $pagina){

		// numero de imagens
		$numero_imagens = retorne_tamanho_resultado(retorne_numero_imagens_album_usuario($uid, $pagina));
	
		// urls
		$url[0] = $pagina_inicial."?$variavel_campo[25]=$pagina&$variavel_campo[2]=7";
		
		// texto
		$texto[0] = $idioma_sistema[596].retorne_titulo_pagina_id($pagina)." - ($numero_imagens)";

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
		$html .= "
		
		<div class='classe_separador_albuns_usuario' id='$idcampo[0]'>

		<div class='classe_separador_albuns_usuario_texto'>
		$link[0]
		</div>

		</div>

		$css[0]
		
		";

		// atualiza a pagina anterior
		$pagina_anterior = $pagina;

	};

};

// retorno
return $html;

};

?>