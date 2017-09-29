<?php

// constroe o player em formato de playlist
function constroe_player_playlist($modo_link, $dados_query){

// globals
global $variavel_campo;
global $idioma_sistema;

// modo mobile
$modo_mobile = retorne_modo_mobile();

// numero de linhas
$linhas = $dados_query["linhas"];

// valida numero de linhas
if($linhas == 0){
	
	// retorno nulo
	return null;
	
};

// largura do player
$largura_player = "100%";

// contador
$contador = 0;

// carrega as medias
$html = recurso_medias_playlist();

// id de campos
$idcampo[0] = "mejs";

// listando midias
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
	$uid = $dados[UID];
	$titulo_musica = $dados[TITULO_MUSICA];
	$titulo_video = $dados[TITULO_VIDEO];
	$url_host_musica = $dados[URL_HOST_MUSICA];
	$url_host_video = $dados[URL_HOST_VIDEO];
	$chave = $dados[CHAVE];
	$data = $dados[DATA];

	// valida id
	if($id != null){
		
		// valida modo musica
		if($url_host_musica != null){
		
			// modo musica
			$modo_musica = true;
		
			// playlist
			$playlist_musicas .= "
			<Source src=\"$url_host_musica\" title='$titulo_musica'></Source>
			";

		}else{
			
			// modo musica
			$modo_musica = false;			
			
			// playlist
			$playlist_videos .= "
			<Source src=\"$url_host_video\" title='$titulo_video'></Source>			
			";
			
		};
	
	};
	
};

// valida url de musica
if($modo_musica == true){

	// valida modo mobile
	if($modo_mobile == true){

		// tamanho do player
		$altura_player = TAMANHO_PLAYER_AUDIO_MOBILE;		
		
	}else{
		
		// tamanho do player
		$altura_player = TAMANHO_PLAYER_AUDIO;
		
	};

	// campos
	$campo_player = "

	<audio id='$idcampo[0]' type='audio/mp3' controls='controls' width='$largura_player' height='$altura_player'>
	$playlist_musicas
	</audio>

	";

}else{

	// valida modo mobile
	if($modo_mobile == true){
		
		// tamanho de player de video
		$altura_player = TAMANHO_PLAYER_VIDEO_MOBILE;			
		
	}else{
		
		// tamanho de player de video
		$altura_player = TAMANHO_PLAYER_VIDEO;

	};
	
	// campos
	$campo_player = "
	
	<video id='$idcampo[0]' src='$url_midia' type='video/mp4' controls='controls' width='$largura_player' height='$altura_player'>
	$playlist_videos
	</video>
	
	";

};

// html
$html .= "
<div class='classe_playlist_usuario'>
$campo_player
</div>
";

// retorno
return $html;

};

?>