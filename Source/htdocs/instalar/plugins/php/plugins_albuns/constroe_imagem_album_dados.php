<?php

// constroe a imagem de album por dados
function constroe_imagem_album_dados($dados, $modo, $idcampo_1){

// modo 0 publicacao visualiza antes de publicar
// modo 1 publicacao ja publicada
// modo 2 visualizar imagem de album
// modo 3 visualiza últimas imagens postadas

// globals
global $idioma_sistema;
global $tabela_banco;

// listando dados
$id = $dados["id"];
$uid = $dados[UID];
$url_host_grande = $dados[URL_HOST_GRANDE];
$url_host_miniatura = $dados[URL_HOST_MINIATURA];
$url_host_thumbnail = $dados[URL_HOST_THUMBNAIL];
$data = $dados[DATA];

// valida id de imagem
if($id == null){
	
	// retorno nulo
	return null;
	
};

// usuario amigo
$usuario_amigo = retorne_usuario_amigo($uid);

// nome de usuario
$nome_usuario = retorne_nome_usuario(true, $uid);

// usuario dono do perfil
$usuario_dono = retorne_usuario_dono_perfil($uid);

// valida o modo
switch($modo){
	
	case 0:
    $classe[0] = "classe_div_imagens_album_div_imagem_3";
	break;
	
	case 1:
    $classe[0] = "classe_div_imagens_album_div_imagem_publicacao";
	// altera o host de imagem em thumbnail
	$url_host_thumbnail = $url_host_miniatura;
	break;

	case 2:
	$classe[0] = "classe_div_campo_album_perfil_basico_imagens_separa classe_cor_4";
	break;
	
	case 3:
	$classe[0] = "classe_ultima_imagem_album";
	break;
	
	case 4:
    $classe[0] = "classe_div_imagens_album_div_imagem_2";
	break;
	
};

// valida host de imagem
if($url_host_grande != null){

	// modo mobile
	$modo_mobile = retorne_modo_mobile();
	
    // id de dialogo
    $dialogo_id[0] = retorne_idcampo_md5();
    $dialogo_id[1] = retorne_idcampo_md5();
	$dialogo_id[2] = retorne_idcampo_md5();

	// valida id de campo
	if($idcampo_1 == null){
		
		// id de campos
		$idcampo_1 = retorne_idcampo_md5();
	
	};

	// valida o modo
	if($modo != 1){
		
		// id de classe
		$classe_id[0] = $dialogo_id[2];
		
		// proprieades css
		$propriedade_css[0] = "
		
		background-image: url(\"$url_host_thumbnail\");
		cursor: pointer;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: 50% 50%;
		
		";
		
		// css
		$css[0] = constroe_css_manual(null, $classe_id[0], $propriedade_css[0]);

	};
	
	// funcoes
	$funcao[0] = "
	restaurar_imagem_album_dados($id, \"$idcampo_1\")
	";
	
	// scripts
	$script[0] = "
	<script>
	v_array_ids_imagens_albuns_abertos[\"$idcampo_1\"] = $id;
	</script>	
	";
	
	// campo gerenciar imagem
    $campo_gerenciar_imagem = constroe_campo_gerenciar_imagem($dados, $dialogo_id);

    // campo social
    $campo_social = constroe_campo_social(2, $id, true, $uid);
    
    // campo data
    $campo_data = constroe_data_conteudo($data);

    // campo descricao de imagem
    $campo_descricao = constroe_campo_descricao_imagem($dados);

	// campo perfil
	$campo_perfil = constroe_imagem_perfil_miniatura(false, true, $uid);

	// constro o paginador slide de album
	$paginador_slide = constroe_paginador_slide_album($dados, $idcampo_1, $nome_funcao[0]);

	// imagem do album
	$imagem_album = "
	<div class='classe_imagem_unica_album'>
	<img src='$url_host_grande' class='classe_imagem_album_usuario'>
	</div>
	
	$paginador_slide
	";
	
	// campos
	$campo[0] = "
	
	<div id='$dialogo_id[1]' class='classe_div_imagem_grande_album_visualizar'>
	$imagem_album
	</div>

	$campo_gerenciar_imagem
	
	<div class='classe_data_album_imagem'>
	$campo_data
	</div>

	";
	
	// array de titulos
	$array_titulos[] = $idioma_sistema[537];
	$array_titulos[] = $idioma_sistema[538];
	
	// array de conteudos
	$array_conteudos[] = $campo_social;
	$array_conteudos[] = $campo_descricao;
	
	// array de ids
	$array_ids[] = retorne_idcampo_md5();
	$array_ids[] = retorne_idcampo_md5();
	
	// campo aba
	$campo_aba = constroe_aba(false, false, $array_titulos, $array_conteudos, $array_ids);

	// campos
	$campo[1] = "
	<div class='classe_perfil_usuario_dono_imagem_album classe_cor_13'>
	$campo_perfil
	</div>
	
	$campo_aba
	";
	
	// campos
	$campo[2] = "
	$imagem_album
	";

	// valida o modo mobile
	if($modo_mobile == true){
		
		// html
		$html = "
		$campo[0]
		$campo[1]
		";
		
	}else{
		
		// valida usuario amigo
		if($usuario_amigo == true or $usuario_dono == true){
			
			// campos
			$campo[1] = "
			
			<div class='classe_imagem_album_visualizar_social'>
			$campo[1]
			</div>
		
			";
			
		}else{
			
			// campos
			$campo[1] = retorne_imagem_sistema(46, null, false);
			
			// campos
			$campo[1] = "
			<div class='classe_imagem_album_visualizar_social_indisponivel'>
			
			<div class='classe_imagem_album_visualizar_social_indisponivel_texto'>
			$idioma_sistema[526]$nome_usuario$idioma_sistema[527]
			</div>
			
			<div class='classe_imagem_album_visualizar_social_indisponivel_imagem'>
			$campo[1]
			</div>
			
			</div>
			";
			
		};
		
		// html
		$html = "
		
		<div class='classe_imagem_album_visualizar_imagem'>
		$campo[0]
		</div>
		
		$campo[1]
	
		";

	};
	
	// valida o modo
	if($modo == 5){
		
		// retorno
		return $html;
		
	};
	
	// adiciona dialogo
	$html = constroe_dialogo_grande($html, $dialogo_id[0], $idcampo_1, true, $id, $uid);

	// adiciona script
	$html .= $script[0];
	
	// valida o modo
	if($modo != 1){
		
		// html
		$html .= "
		
			<div class='$classe[0]' id='$classe_id[0]' onclick='$funcao[0], exibe_dialogo(\"$dialogo_id[0]\");'>
			</div>

			$css[0]
			
			";

		}else{
			
			// html
			$html .= "
			
			<div class='$classe[0]' onclick='$funcao[0], exibe_dialogo(\"$dialogo_id[0]\");'>
			<img src='$url_host_thumbnail'>
			</div>

			";
		
		};
	
		// retorno
		return $html;
	
}else{
	
	// retorno
	return null;
	
};

};

?>