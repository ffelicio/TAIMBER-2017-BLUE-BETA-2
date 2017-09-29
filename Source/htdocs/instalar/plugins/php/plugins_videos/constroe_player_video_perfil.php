<?php

// constroe o player que exibe o video de perfil
function constroe_player_video_perfil($dados_query){

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

// carrega as medias
$html .= recurso_medias();

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(35, null, false);
$imagem_sistema[1] = retorne_imagem_sistema(38, null, false);

// tamanho de player de video
$tamanho_player = TAMANHO_PLAYER_VIDEO_PERFIL;

// listando midias
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
	$uid = $dados[UID];
	$titulo_video = $dados[TITULO_VIDEO];
	$url_host_video = $dados[URL_HOST_VIDEO];
	$chave = $dados[CHAVE];
	$data = $dados[DATA];

	// video
	$url_midia = $url_host_video;

	// modo musica
	$modo_musica = false;

	// valida id
	if($id != null and $url_midia != null){

		// id de campos
		$idcampo[0] = retorne_idcampo_md5();
		$idcampo[1] = retorne_idcampo_md5();
		$idcampo[2] = retorne_idcampo_md5();

		// campos
		$campo_player = "<video id='$idcampo[0]' src='$url_midia' type='video/mp4' controls='controls' width='$tamanho_player' height='$tamanho_player'></video>";

		// html
		$html .= "
		<div class='classe_separa_player_perfil' id='$idcampo[1]'>

		<div class='classe_separa_player_media' id='$idcampo[2]'>

		<div class='classe_separa_player_media_player'>
		$campo_player	
		</div>
		
		</div>

		</div>

		";
	
	};
	
};

// carrega as medias
$html .= recurso_medias();

// retorno
return $html;

};

?>