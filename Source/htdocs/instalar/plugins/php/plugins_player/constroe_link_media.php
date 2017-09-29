<?php

// constroe o link de media, video, musica etc
function constroe_link_media($dados_query, $modo_recomendar, $modo_json){

// globals
global $variavel_campo;

// contador
$contador = 0;

// numero de linhas
$linhas = $dados_query["linhas"];

// valida numero de linhas
if($linhas == 0){
	
	// retorno nulo
	return null;
	
};

// url de pagina inicial
$url_pagina_inicial = PAGINA_INICIAL;
	
// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(35, null, false);
$imagem_sistema[1] = retorne_imagem_sistema(38, null, false);

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();
	
// valida o modo recomendar
if($modo_recomendar == true){
	
	// classes
	$classe[0] = "classe_link_media_link_recomendar";
	$classe[1] = "classe_link_media_imagem_recomendar";
	$classe[2] = "classe_lista_recomendacoes_medias_recomendar";
	
}else{
	
	// classes
	$classe[0] = "classe_link_media_link";	
	$classe[1] = "classe_link_media_imagem";
	$classe[2] = "classe_lista_recomendacoes_medias";

	// funcoes
	$funcao[0] = "carrega_links_medias(\"$idcampo[0]\", \"$idcampo[1]\");";
	
	// campo paginar
	$campo_paginar = constroe_paginador_padrao($idcampo[1], $funcao[0]);
	
	// scripts
	$script[0] = "
	<script>
	$funcao[0]
	</script>
	";
	
};

// listando midias
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
	$titulo_musica = $dados[TITULO_MUSICA];
	$titulo_video = $dados[TITULO_VIDEO];
	$url_host_musica = $dados[URL_HOST_MUSICA];
	$url_host_video = $dados[URL_HOST_VIDEO];

	// valida url de musica
	if($url_host_musica != null){

		// imagem de player
		$imagem_player = $imagem_sistema[0];

		// link
		$link[0] = "<a href='$url_pagina_inicial?$variavel_campo[2]=78&$variavel_campo[42]=$titulo_musica' title='$titulo_musica'>$titulo_musica</a>";

	}else{

		// imagem de player
		$imagem_player = $imagem_sistema[1];

		// link
		$link[0] = "<a href='$url_pagina_inicial?$variavel_campo[2]=82&$variavel_campo[44]=$titulo_video' title='$titulo_video'>$titulo_video</a>";

	};

	// valida id
	if($id != null){
		
		// html
		$html .= "
		<div class='classe_link_media'>
		
		<div class='$classe[1]'>
		$imagem_player
		</div>
		
		<div class='$classe[0]'>
		$link[0]
		</div>
		
		</div>
		";	
	
	};
	
};

// valida modo json
if($modo_json == true){
	
	// retorno
	return $html;
	
};

// html
$html = "
<div class='$classe[2]' id='$idcampo[0]'>
$html
</div>

$campo_paginar
$script[0]

";

// retorno
return $html;

};

?>