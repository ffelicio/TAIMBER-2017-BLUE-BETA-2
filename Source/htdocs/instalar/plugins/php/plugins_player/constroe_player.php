<?php

// constroe o player
function constroe_player($modo_link, $dados_query){

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
$html = recurso_medias();

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

			// source de musica
			$source_musica = "
			<source src=\"$url_host_musica\" title='$titulo_musica'></Source>
			";

			// valida modo mobile
			if($modo_mobile == true){

				// tamanho do player
				$altura_player = TAMANHO_PLAYER_AUDIO_MOBILE;		
				
			}else{
				
				// tamanho do player
				$altura_player = TAMANHO_PLAYER_AUDIO;
				
			};

			// campos
			$campo[0] = constroe_opcoes_musica($dados, null);
			
			// valida campo
			if($campo[0] != null){
				
				// campo gerenciar
				$campo_gerenciar = "
				<div class='classe_gerenciar_midia_player'>
				$campo[0]
				</div>
				";
			
			};
			
			// campos
			$html .= "
			<div class='classe_separa_player_musica'>
			
			$campo_gerenciar

			<div class='classe_separa_player_musica_player'>
			
			<audio type='audio/mp3' controls='controls' width='$largura_player' height='$altura_player'>
			$source_musica
			</audio>
			
			</div>
			
			</div>
			";
	
		}else{

			// source de video
			$source_video = "
			<source src=\"$url_host_video\" title='$titulo_video'></Source>			
			";
			
			// campos
			$campo[0] = constroe_opcoes_video($dados, null);
			
			// valida campo
			if($campo[0] != null){
				
				// campo gerenciar
				$campo_gerenciar = "
				<div class='classe_gerenciar_midia_player'>
				$campo[0]
				</div>
				";
			
			};
			
			// valida modo mobile
			if($modo_mobile == true){
				
				// tamanho de player de video
				$altura_player = TAMANHO_PLAYER_VIDEO_MOBILE;			
				
			}else{
				
				// tamanho de player de video
				$altura_player = TAMANHO_PLAYER_VIDEO;

			};
			
			// campos
			$html .= "
			<div class='classe_separa_player_video'>
			
			$campo_gerenciar
			
			<div class='classe_separa_player_video_player'>
			
			<video src='$url_midia' type='video/mp4' controls='controls' width='$largura_player' height='$altura_player'>
			$source_video
			</video>
			
			</div>
			
			</div>
			";
	
		};
	
	};
	
};

// retorno
return $html;

};

?>